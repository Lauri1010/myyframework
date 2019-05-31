<?php
namespace Framework;
if(Appdata::get('fReq')){
$title = "Test";
$metad = "Test";
require SNIPPLETS . 'head.php';
}
require SNIPPLETS.'menu.php';
?>
<div class="pure-u-1-5"></div>
<div class="pure-u-3-5">
<h1>Submit user</h1>
<div><?php $this->af->processSubmit('user','user/index'); ?></div>
<form enctype="multipart/form-data" class="pure-form pure-form-stacked" action="" method="POST">
<label>User email</label>
<?php 
echo $this->af->inputField('user','email');
?>
<label>User password</label>
<?php 
echo $this->af->inputField('user','password');
?>
<br/><br/>
<button type="submit" class="pure-button pure-button-primary">Submit</button>
</form>
</div>
<?php
if(Appdata::get('fReq')){require SNIPPLETS.'bottom.php';}