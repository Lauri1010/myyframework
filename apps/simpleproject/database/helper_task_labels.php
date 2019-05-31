<?php 
namespace Framework; 

class helper_task_labels{

public $table_name='task_labels';

public $table_alias='tl9';

public $label_id_sql='tl9.label_id';

public $label_description_sql='tl9.label_description';

public $select_columns_sql='tl9.label_id,tl9.label_description';

public $project_work_task_join_sql=' project_work_task pwt7 ON(tl9.label_id=pwt7.label_id_ref)';

public $insert_into_sql='INSERT INTO task_labels VALUES (:label_id, :label_description)';

public $update_base_sql='UPDATE task_labels SET ';

public $update_label_id_sql='label_id=:label_id';

public $update_label_description_sql='label_description=:label_description';

}?>