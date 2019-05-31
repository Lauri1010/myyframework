<?php 
namespace Framework; 
require DBFOLDER.'helper_user_in_project.php'; 

class schema_user_in_project extends helper_user_in_project {

public $user_project_id_validation = array('required','intiger','max'=>10,'min'=>1);

public $user_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_access_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $user_project_id;

public $user_id_ref;

public $project_id_ref;

public $project_access_ref;

public $columns = array('user_project_id','user_id_ref','project_id_ref','project_access_ref');

}?>