<?php 
namespace Framework; 
require DBFOLDER.'helper_user_level.php'; 

class schema_user_level extends helper_user_level {

public $user_level_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $user_level_description_validation = array('required','string','max'=>200,'min'=>1);

public $level_validation = array('required','intiger','max'=>10,'min'=>1);

public $columns = array('user_level_id','user_level_description','level');

public $user_level_id;

public $user_level_description;

public $level;

public $insert_sql_statement;

public $update_sql_statement;

}?>

