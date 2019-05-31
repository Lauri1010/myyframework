<?php 
namespace Framework; 

class helper_project_work_dependencies{

public $table_name='project_work_dependencies';

public $table_alias='pwd6';

public $project_work_dependency_id_sql='pwd6.project_work_dependency_id';

public $project_work_task_id_ref_sql='pwd6.project_work_task_id_ref';

public $project_work_id_ref_sql='pwd6.project_work_id_ref';

public $project_id_ref_sql='pwd6.project_id_ref';

public $dependency_description_sql='pwd6.dependency_description';

public $select_columns_sql='pwd6.project_work_dependency_id,pwd6.project_work_task_id_ref,pwd6.project_work_id_ref,pwd6.project_id_ref,pwd6.dependency_description';


public $insert_into_sql='INSERT INTO project_work_dependencies VALUES (:project_work_dependency_id, :project_work_task_id_ref, :project_work_id_ref, :project_id_ref, :dependency_description)';

public $update_base_sql='UPDATE project_work_dependencies SET ';

public $update_project_work_dependency_id_sql='project_work_dependency_id=:project_work_dependency_id';

public $update_project_work_task_id_ref_sql='project_work_task_id_ref=:project_work_task_id_ref';

public $update_project_work_id_ref_sql='project_work_id_ref=:project_work_id_ref';

public $update_project_id_ref_sql='project_id_ref=:project_id_ref';

public $update_dependency_description_sql='dependency_description=:dependency_description';

}?>