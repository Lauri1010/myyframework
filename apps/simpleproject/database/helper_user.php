<?php 
namespace Framework; 

class helper_user{

public $table_name='user';

public $table_alias='u10';

public $user_id_sql='u10.user_id';

public $email_sql='u10.email';

public $password_sql='u10.password';

public $token_sql='u10.token';

public $salt_sql='u10.salt';

public $select_columns_sql='u10.user_id,u10.email,u10.password,u10.token,u10.salt';

public $assignee_join_sql=' assignee a0 ON(u10.user_id=a0.user_id_ref)';
public $user_in_project_join_sql=' user_in_project uip11 ON(u10.user_id=uip11.user_id_ref)';

public $insert_into_sql='INSERT INTO user VALUES (:user_id, :email, :password, :token, :salt)';

public $update_base_sql='UPDATE user SET ';

public $update_user_id_sql='user_id=:user_id';

public $update_email_sql='email=:email';

public $update_password_sql='password=:password';

public $update_token_sql='token=:token';

public $update_salt_sql='salt=:salt';

}?>