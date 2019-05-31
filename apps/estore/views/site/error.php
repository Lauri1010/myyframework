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
		<h1>Error occured in saving data</h1>
		<h2></h2>
	</div>
	<div class="content">
		<a href="http://localhost">Main page</a>
	</div>
</div>
<?php
if(Appdata::get('fReq')){require SNIPPLETS.'bottom.php';}