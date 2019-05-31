<?php 
namespace Framework; 

class helper_assignee{

public $table_name='assignee';

public $table_alias='a0';

public $assignee_id_sql='a0.assignee_id';

public $firstname_sql='a0.firstname';

public $lastname_sql='a0.lastname';

public $nickname_sql='a0.nickname';

public $user_id_ref_sql='a0.user_id_ref';

public $select_columns_sql='a0.assignee_id,a0.firstname,a0.lastname,a0.nickname,a0.user_id_ref';

public $project_access_join_sql=' project_access pa2 ON(a0.assignee_id=pa2.assignee_id_ref)';
public $project_work_task_join_sql=' project_work_task pwt7 ON(a0.assignee_id=pwt7.assignee_id_ref)';
public $user_join_sql=' user u10 ON(a0.user_id_ref=u10.user_id)';

public $insert_into_sql='INSERT INTO assignee VALUES (:assignee_id, :firstname, :lastname, :nickname, :user_id_ref)';

public $update_base_sql='UPDATE assignee SET ';

public $update_assignee_id_sql='assignee_id=:assignee_id';

public $update_firstname_sql='firstname=:firstname';

public $update_lastname_sql='lastname=:lastname';

public $update_nickname_sql='nickname=:nickname';

public $update_user_id_ref_sql='user_id_ref=:user_id_ref';

}?>