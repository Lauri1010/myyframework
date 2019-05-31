<?php 
namespace Framework; 
require DBFOLDER.'helper_task_comments.php'; 

class schema_task_comments extends helper_task_comments {

public $task_comments_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $task_comment_validation = array('required','string','max'=>1000,'min'=>1);

public $task_comment_date_time_validation = array('timestamp');

public $insert_sql_statement;

public $update_sql_statement;

public $task_comments_id;

public $task_comment;

public $task_comment_date_time;

public $columns = array('task_comments_id','task_comment','task_comment_date_time');

}?>