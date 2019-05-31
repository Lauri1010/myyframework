<?php 
namespace Framework; 

class helper_project_work{

public $table_name='project_work';

public $table_alias='pw5';

public $project_work_id_sql='pw5.project_work_id';

public $project_work_desc_sql='pw5.project_work_desc';

public $created_sql='pw5.created';

public $select_columns_sql='pw5.project_work_id,pw5.project_work_desc,pw5.created';


public $insert_into_sql='INSERT INTO project_work VALUES (:project_work_id, :project_work_desc, :created)';

public $update_base_sql='UPDATE project_work SET ';

public $update_project_work_id_sql='project_work_id=:project_work_id';

public $update_project_work_desc_sql='project_work_desc=:project_work_desc';

public $update_created_sql='created=:created';

}?>