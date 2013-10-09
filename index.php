<?php 
$title="Start";
$desc="DBA02 - Die Beste Antwort";
include_once($_SERVER['DOCUMENT_ROOT'].'/class/Datenbank.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/class/SQL.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/class/User.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); 
 
if (isset($_GET["show"])){
	$show=$_GET["show"];
} else {
	$show="frage";
}
?>
<div class="row">
	<div class="col-md-8">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/pages/'. $show . '.php'); ?> 
	</div>
	<div class="col-md-4">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'); ?>
	</div>	  
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
