<?php 
namespace Framework; 

class helper_project_work_task{

public $table_name='project_work_task';

public $table_alias='pwt7';

public $project_work_task_id_sql='pwt7.project_work_task_id';

public $project_id_ref_sql='pwt7.project_id_ref';

public $priority_sql='pwt7.priority';

public $label_id_ref_sql='pwt7.label_id_ref';

public $due_date_sql='pwt7.due_date';

public $esimate_in_hours_sql='pwt7.esimate_in_hours';

public $realised_hours_sql='pwt7.realised_hours';

public $task_description_sql='pwt7.task_description';

public $task_comments_ref_sql='pwt7.task_comments_ref';

public $assignee_id_ref_sql='pwt7.assignee_id_ref';

public $select_columns_sql='pwt7.project_work_task_id,pwt7.project_id_ref,pwt7.priority,pwt7.label_id_ref,pwt7.due_date,pwt7.esimate_in_hours,pwt7.realised_hours,pwt7.task_description,pwt7.task_comments_ref,pwt7.assignee_id_ref';

public $assignee_join_sql=' assignee a0 ON(pwt7.assignee_id_ref=a0.assignee_id)';
public $project_join_sql=' project p1 ON(pwt7.project_id_ref=p1.project_id)';
public $task_comments_join_sql=' task_comments tc8 ON(pwt7.task_comments_ref=tc8.task_comments_id)';
public $task_labels_join_sql=' task_labels tl9 ON(pwt7.label_id_ref=tl9.label_id)';

public $insert_into_sql='INSERT INTO project_work_task VALUES (:project_work_task_id, :project_id_ref, :priority, :label_id_ref, :due_date, :esimate_in_hours, :realised_hours, :task_description, :task_comments_ref, :assignee_id_ref)';

public $update_base_sql='UPDATE project_work_task SET ';

public $update_project_work_task_id_sql='project_work_task_id=:project_work_task_id';

public $update_project_id_ref_sql='project_id_ref=:project_id_ref';

public $update_priority_sql='priority=:priority';

public $update_label_id_ref_sql='label_id_ref=:label_id_ref';

public $update_due_date_sql='due_date=:due_date';

public $update_esimate_in_hours_sql='esimate_in_hours=:esimate_in_hours';

public $update_realised_hours_sql='realised_hours=:realised_hours';

public $update_task_description_sql='task_description=:task_description';

public $update_task_comments_ref_sql='task_comments_ref=:task_comments_ref';

public $update_assignee_id_ref_sql='assignee_id_ref=:assignee_id_ref';

}?>