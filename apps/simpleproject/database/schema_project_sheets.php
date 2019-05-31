<?php 
namespace Framework; 
require DBFOLDER.'helper_project_sheets.php'; 

class schema_project_sheets extends helper_project_sheets {

public $project_slot_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $slot_title_validation = array('required','string','max'=>50,'min'=>1);

public $created_updated_validation = array('required','timestamp');

public $insert_sql_statement;

public $update_sql_statement;

public $project_slot_id;

public $slot_title;

public $created_updated;

public $columns = array('project_slot_id','slot_title','created_updated');

}?>