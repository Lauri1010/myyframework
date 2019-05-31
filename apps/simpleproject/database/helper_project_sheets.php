<?php 
namespace Framework; 

class helper_project_sheets{

public $table_name='project_sheets';

public $table_alias='ps3';

public $project_slot_id_sql='ps3.project_slot_id';

public $slot_title_sql='ps3.slot_title';

public $created_updated_sql='ps3.created_updated';

public $select_columns_sql='ps3.project_slot_id,ps3.slot_title,ps3.created_updated';


public $insert_into_sql='INSERT INTO project_sheets VALUES (:project_slot_id, :slot_title, :created_updated)';

public $update_base_sql='UPDATE project_sheets SET ';

public $update_project_slot_id_sql='project_slot_id=:project_slot_id';

public $update_slot_title_sql='slot_title=:slot_title';

public $update_created_updated_sql='created_updated=:created_updated';

}?>