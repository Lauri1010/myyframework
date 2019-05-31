<?php 
namespace Framework; 
require DBFOLDER.'helper_project_work_task.php'; 

class schema_project_work_task extends helper_project_work_task {

public $project_work_task_id_validation = array('required','intiger','max'=>10,'min'=>1);

public $project_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $priority_validation = array('intiger','max'=>3,'min'=>1);

public $label_id_ref_validation = array('intiger','max'=>10,'min'=>1);

public $due_date_validation = array('datetime');

public $esimate_in_hours_validation = array('intiger','max'=>10,'min'=>1);

public $realised_hours_validation = array('intiger','max'=>10,'min'=>1);

public $task_description_validation = array('string','max'=>1000,'min'=>1);

public $task_comments_ref_validation = array('intiger','max'=>10,'min'=>1);

public $assignee_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $project_work_task_id;

public $project_id_ref;

public $priority;

public $label_id_ref;

public $due_date;

public $esimate_in_hours;

public $realised_hours;

public $task_description;

public $task_comments_ref;

public $assignee_id_ref;

public $columns = array('project_work_task_id','project_id_ref','priority','label_id_ref','due_date','esimate_in_hours','realised_hours','task_description','task_comments_ref','assignee_id_ref');

}?>