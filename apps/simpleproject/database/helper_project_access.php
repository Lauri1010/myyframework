<?php 
namespace Framework; 

class helper_project_access{

public $table_name='project_access';

public $table_alias='pa2';

public $project_access_id_sql='pa2.project_access_id';

public $description_sql='pa2.description';

public $write_access_sql='pa2.write_access';

public $read_access_sql='pa2.read_access';

public $update_access_sql='pa2.update_access';

public $manage_access_sql='pa2.manage_access';

public $assignee_id_ref_sql='pa2.assignee_id_ref';

public $project_id_ref_sql='pa2.project_id_ref';

public $select_columns_sql='pa2.project_access_id,pa2.description,pa2.write_access,pa2.read_access,pa2.update_access,pa2.manage_access,pa2.assignee_id_ref,pa2.project_id_ref';

public $user_in_project_join_sql=' user_in_project uip11 ON(pa2.project_access_id=uip11.project_access_ref)';
public $assignee_join_sql=' assignee a0 ON(pa2.assignee_id_ref=a0.assignee_id)';
public $project_join_sql=' project p1 ON(pa2.project_id_ref=p1.project_id)';

public $insert_into_sql='INSERT INTO project_access VALUES (:project_access_id, :description, :write_access, :read_access, :update_access, :manage_access, :assignee_id_ref, :project_id_ref)';

public $update_base_sql='UPDATE project_access SET ';

public $update_project_access_id_sql='project_access_id=:project_access_id';

public $update_description_sql='description=:description';

public $update_write_access_sql='write_access=:write_access';

public $update_read_access_sql='read_access=:read_access';

public $update_update_access_sql='update_access=:update_access';

public $update_manage_access_sql='manage_access=:manage_access';

public $update_assignee_id_ref_sql='assignee_id_ref=:assignee_id_ref';

public $update_project_id_ref_sql='project_id_ref=:project_id_ref';

}?>