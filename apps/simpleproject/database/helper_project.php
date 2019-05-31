<?php 
namespace Framework; 

class helper_project{

public $table_name='project';

public $table_alias='p1';

public $project_id_sql='p1.project_id';

public $project_name_sql='p1.project_name';

public $project_description_sql='p1.project_description';

public $project_type_ref_sql='p1.project_type_ref';

public $created_upated_sql='p1.created_upated';

public $status_sql='p1.status';

public $select_columns_sql='p1.project_id,p1.project_name,p1.project_description,p1.project_type_ref,p1.created_upated,p1.status';

public $project_access_join_sql=' project_access pa2 ON(p1.project_id=pa2.project_id_ref)';
public $project_work_task_join_sql=' project_work_task pwt7 ON(p1.project_id=pwt7.project_id_ref)';
public $user_in_project_join_sql=' user_in_project uip11 ON(p1.project_id=uip11.project_id_ref)';
public $project_types_join_sql=' project_types pt4 ON(p1.project_type_ref=pt4.project_type_id)';

public $insert_into_sql='INSERT INTO project VALUES (:project_id, :project_name, :project_description, :project_type_ref, :created_upated, :status)';

public $update_base_sql='UPDATE project SET ';

public $update_project_id_sql='project_id=:project_id';

public $update_project_name_sql='project_name=:project_name';

public $update_project_description_sql='project_description=:project_description';

public $update_project_type_ref_sql='project_type_ref=:project_type_ref';

public $update_created_upated_sql='created_upated=:created_upated';

public $update_status_sql='status=:status';

}?>