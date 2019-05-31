<?php 
namespace Framework; 
require DBFOLDER.'helper_task_labels.php'; 

class schema_task_labels extends helper_task_labels {

public $label_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $label_description_validation = array('required','string','max'=>200,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $label_id;

public $label_description;

public $columns = array('label_id','label_description');

}?>