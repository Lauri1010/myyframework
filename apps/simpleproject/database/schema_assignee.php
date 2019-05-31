<?php 
namespace Framework; 

require DBFOLDER.'helper_assignee.php'; 

class schema_assignee extends helper_assignee{

public $assignee_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $firstname_validation = array('string','max'=>200,'min'=>1);

public $lastname_validation = array('string','max'=>200,'min'=>1);

public $nickname_validation = array('required','string','max'=>50,'min'=>1);

public $user_id_ref_validation = array('required','intiger','max'=>10,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $assignee_id;

public $firstname;

public $lastname;

public $nickname;

public $user_id_ref;

public $columns = array('assignee_id','firstname','lastname','nickname','user_id_ref');

}?>