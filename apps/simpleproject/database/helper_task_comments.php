<?php 
namespace Framework; 

class helper_task_comments{

public $table_name='task_comments';

public $table_alias='tc8';

public $task_comments_id_sql='tc8.task_comments_id';

public $task_comment_sql='tc8.task_comment';

public $task_comment_date_time_sql='tc8.task_comment_date_time';

public $select_columns_sql='tc8.task_comments_id,tc8.task_comment,tc8.task_comment_date_time';

public $project_work_task_join_sql=' project_work_task pwt7 ON(tc8.task_comments_id=pwt7.task_comments_ref)';

public $insert_into_sql='INSERT INTO task_comments VALUES (:task_comments_id, :task_comment, :task_comment_date_time)';

public $update_base_sql='UPDATE task_comments SET ';

public $update_task_comments_id_sql='task_comments_id=:task_comments_id';

public $update_task_comment_sql='task_comment=:task_comment';

public $update_task_comment_date_time_sql='task_comment_date_time=:task_comment_date_time';

}?>