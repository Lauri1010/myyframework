<?php
namespace Framework;

/**
 *
 * @author Lauri Turunen
 *        
 */
class sql_service_base
{

    public $pdo;

    public $select = '';

    public $join;

    public $condition;

    public $conditionBindList;

    public $limitAndOffset;

    public $groupBy;

    public $orderBy;

    public $limit;

    public $offset;

    public $sqlQuery;

    public $sqlUpdate;

    public $validation_errors;

    public $validation_errors_exists;

    public $validations;

    protected $aBindCount;

    protected $previousTable;

    // The first row of column selection
    protected $firstRow;
    
    public $q;

    function __construct($ipdo = false,$sqo=true)
    {
        if ($ipdo) {
            $this->initiatePdo();
        }
        if($sqo){
            $this->setSqlObject();
        }
        
        $this->validation_errors_exists = false;
        
        $this->previousTable = null;
        $this->firstRow = true;
        $this->validation_errors = array();
        $this->aBindCount = 0;
    }

    public function setSqlObject($type = 'sql_query_object', $validations = null)
    {
        if(!isset($this->q)){
            $className = $type;
            $fullClassName = 'Framework\\' . $className;
            
            $rt = ROOT . DS . FRFOLDER . DS . 'layerDatabase' . DS .'objects'. DS . $className . '.php';
            
            if (is_file($rt)) {
                if ($validations != null) {
                    if (is_array($validations)) {
                        $this->validations = $validations;
                    }
                }
                require $rt;
                $this->q=new $fullClassName();
            } else {
                trigger_error("Class does not exist with path " . $rt, E_USER_ERROR);
            }
        }
    }

    public function getFromAPCu($key)
    {
        if (is_string($key)) {
            
            if (extension_loaded('apcu')) {
                
                if (apcu_exists($key)) {
                    return apcu_fetch($key);
                } else {
                    return false;
                }
            }
        } else {
            trigger_error("Key has to be a string", E_USER_ERROR);
        }
    }

    public function removeFromAPCu($key){
        if (extension_loaded('apcu')) {
                if (apcu_exists($key)) {
                    apcu_delete($key);
                }
        }
    }
    
    public function setToAPCu($key, $value, $update = false)
    {
        if (is_string($key)) {
            
            if (extension_loaded('apcu')) {
                if ($update) {
                    if (apcu_exists($key)) {
                        apcu_delete($key);
                    }
                }
                return apcu_store($key, $value);
            }
        } else {
            trigger_error("Key has to be a string", E_USER_ERROR);
        }
    }

    public function ifInAPCu($key)
    {
        if (extension_loaded('apcu')) {
            return apcu_exists($key);
        } else {
            return false;
        }
    }
    
    public function storeSignatures(){
        

    }

    public function setAfterLoginSecurity(){
        if(!session_regenerate_id()){
            
        }

    }
    
    public function authenticate(&$validations, $email, $password,$redirectAddress)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $qo = $this->getsql_object('sql_object');
            
            if ($qo instanceof sql_object) {
                
                $validations = $qo->validate();
                
                if (sizeof($validations) > 0) {
                    return $validations;
                } else {
                    
                    if (empty($this->pdo)) {
                        $this->initiatePdo();
                    }
                    
                    $this->pdo->prepare('SELECT user_id, email, password, salt, token FROM user WHERE email = :email AND password=:password');
                    
                    $this->pdo->bind(':email', $email);
                    $this->pdo->bind(':password', $password);
                    $row = $this->pdo->single();
                    
                    $dbUsername = $row['email'];
                    $dbPassword = $row['password'];
                    
                    if ($password == $dbPassword) {
                        $_SESSION["authenticated"]=true;
                        header('Location: '.$redirectAddress);
                    } else {
                        return false;
                    }
                }
            } else {
                trigger_error("Query object must be type sql_object ", E_USER_ERROR);
            }
        } else {
            return false;
        }
    }

    /**
     * When updating the database the updating function will call this and set empty arrays for isUpdated function,
     * which is called in logic functions
     *
     * @param array $tables
     */
    public function setUpdated($tables)
    {
        if (is_array($tables)) {
            foreach ($tables as $table) {
                if (is_string($table)) {
                    $dc = array();
                    $this->setToAPCu($table, $dc);
                }
            }
        }
    }

    /**
     * *
     * Checking if the tables have been updated.
     * Updated is determined by an empty array for the key
     * Update propagated for the key already: there is a key (value 1) in the table array
     */
    public function isUpdated($tables, $key)
    {
        if (is_array($tables) && is_string($key)) {
            $result = false;
            foreach ($tables as $table) {
                $updated = $this->getFromAPCu($table);
                if (is_array($updated)) {
                    if (isset($updated[$key])) {
                        $result = true;
                    } else {
                        // This update has been done for the spesified cache key. When update is done again. the key is removed
                        $updated[$key] = 1;
                        $result = $this->setToAPCu($table, $updated, true);
                    }
                }
            }
            return $result;
        }
    }

    protected function initiatePdo()
    {
        if (empty($this->pdo)) {
            require ROOT . DS . FRFOLDER . DS . 'layerDatabase' . DS . 'lib' . DS .'database.php';
            $this->pdo = new database();
            $this->pdo->conncect();
        }
    }

    public function queryDo($sq = false)
    {
        if ($this->q instanceof sql_query_object) {
            
            if (empty($this->pdo)) {
                $this->initiatePdo();
            }
            $sql = $this->q->getQuerySql();
            $binds = $this->q->getBinds();
            
            if (! empty($sql)) {
                
                $this->pdo->prepare($sql);
                if (! empty($binds)) {
                    if (sizeof($binds) > 0) {
                        
                        foreach ($binds as $bKey => $bValue) {
                            $this->pdo->bind($bKey, $bValue);
                        }
                    }
                }
                if ($sq) {
                    return $this->pdo->single();
                } else {
                    return $this->pdo->resultset();
                }
            } else {
                trigger_error("Sql data object does not contain data!", E_USER_ERROR);
            }
        } else {
            trigger_error("Improper data set", E_USER_ERROR);
        }
    }

    public function queryRs($sql, $binds = array())
    {
        if (is_sring($sql) && strlen($sql) > 0 && is_array($binds)) {
            if (empty($this->pdo)) {
                $this->initiatePdo();
            }
            $this->pdo->prepare($sql);
            if (sizeof($binds) > 0) {
                
                foreach ($binds as $bKey => $bValue) {
                    $this->pdo->bind($bKey, $bValue);
                }
            }
            
            return $this->pdo->resultset();
        } else {
            trigger_error("Sql needs to be set", E_USER_ERROR);
        }
    }

    public function insert($tableName)
    {
        if ($this->q instanceof sql_query_object && !empty($tableName)) {
            $insertSql=$this->q->getRowFromSchema($tableName,'insert_into_sql');
            if(!empty($insertSql)){;
                if(!empty($this->q->binds)){
                    if (empty($this->pdo)) {
                        $this->initiatePdo();
                    }
                    $this->pdo->prepare($insertSql);
                    foreach($this->q->binds as $bKey => $bValue) {
                        $this->pdo->bind($bKey, $bValue);
                    }
                    return $this->pdo->execute();
                }else{
                    trigger_error("Insert binds is empty", E_USER_ERROR);
                }
            }else{
                trigger_error("Insert sql is empty ", E_USER_ERROR);
            }
            
        }
    }
}