<?php
namespace Framework;
if(Appdata::get('fReq')){
$title = "Test";
$metad = "Test";
require SNIPPLETS . 'head.php';
}
require SNIPPLETS.'menu.php';
?>
<div id="main">
	<div class="header">
		<h1>Next page</h1>
		<h2></h2>
	</div>
	<div class="content">
		<a href="http://localhost">Back</a>
	</div>
</div>
<?php
if(Appdata::get('fReq')){require SNIPPLETS.'bottom.php';}