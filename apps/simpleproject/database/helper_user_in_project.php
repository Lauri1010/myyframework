<?php 
namespace Framework; 

class helper_user_in_project{

public $table_name='user_in_project';

public $table_alias='uip11';

public $user_project_id_sql='uip11.user_project_id';

public $user_id_ref_sql='uip11.user_id_ref';

public $project_id_ref_sql='uip11.project_id_ref';

public $project_access_ref_sql='uip11.project_access_ref';

public $select_columns_sql='uip11.user_project_id,uip11.user_id_ref,uip11.project_id_ref,uip11.project_access_ref';

public $project_join_sql=' project p1 ON(uip11.project_id_ref=p1.project_id)';
public $project_access_join_sql=' project_access pa2 ON(uip11.project_access_ref=pa2.project_access_id)';
public $user_join_sql=' user u10 ON(uip11.user_id_ref=u10.user_id)';

public $insert_into_sql='INSERT INTO user_in_project VALUES (:user_project_id, :user_id_ref, :project_id_ref, :project_access_ref)';

public $update_base_sql='UPDATE user_in_project SET ';

public $update_user_project_id_sql='user_project_id=:user_project_id';

public $update_user_id_ref_sql='user_id_ref=:user_id_ref';

public $update_project_id_ref_sql='project_id_ref=:project_id_ref';

public $update_project_access_ref_sql='project_access_ref=:project_access_ref';

}?>