<?php 
namespace Framework; 
require DBFOLDER.'helper_user.php'; 

class schema_user extends helper_user {

public $user_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $email_validation = array('required','string','max'=>200,'min'=>1);

public $password_validation = array('required','string','max'=>200,'min'=>1);

public $token_validation = array('string','max'=>200,'min'=>1);

public $salt_validation = array('string','max'=>200,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $user_id;

public $email;

public $password;

public $token;

public $salt;

public $columns = array('user_id','email','password','token','salt');

}?>