<?php 
namespace Framework; 
require DBFOLDER.'helper_project_work_dependencies.php'; 

class schema_project_work_dependencies extends helper_project_work_dependencies {

public $project_work_dependency_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $project_work_task_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_work_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $dependency_description_validation = array('string','max'=>75,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $project_work_dependency_id;

public $project_work_task_id_ref;

public $project_work_id_ref;

public $project_id_ref;

public $dependency_description;

public $columns = array('project_work_dependency_id','project_work_task_id_ref','project_work_id_ref','project_id_ref','dependency_description');

}?>