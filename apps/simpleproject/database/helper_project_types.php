<?php 
namespace Framework; 

class helper_project_types{

public $table_name='project_types';

public $table_alias='pt4';

public $project_type_id_sql='pt4.project_type_id';

public $project_type_desc_sql='pt4.project_type_desc';

public $select_columns_sql='pt4.project_type_id,pt4.project_type_desc';

public $project_join_sql=' project p1 ON(pt4.project_type_id=p1.project_type_ref)';

public $insert_into_sql='INSERT INTO project_types VALUES (:project_type_id, :project_type_desc)';

public $update_base_sql='UPDATE project_types SET ';

public $update_project_type_id_sql='project_type_id=:project_type_id';

public $update_project_type_desc_sql='project_type_desc=:project_type_desc';

}?>