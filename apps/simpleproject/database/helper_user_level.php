<?php 
namespace Framework; 

class helper_user_level{

public $table_name='user_level';

public $table_alias='ul12';

public $user_level_id_sql='ul12.user_level_id';

public $user_level_description_sql='ul12.user_level_description';

public $level_sql='ul12.level';

public $select_columns_sql='ul12.user_level_id,ul12.user_level_description,ul12.level';


public $insert_into_sql='INSERT INTO user_level VALUES (:user_level_id, :user_level_description, :level)';

public $update_base_sql='UPDATE user_level SET ';

public $update_user_level_id_sql='user_level_id=:user_level_id';

public $update_user_level_description_sql='user_level_description=:user_level_description';

public $update_level_sql='level=:level';

}?>