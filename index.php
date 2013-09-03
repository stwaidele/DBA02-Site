<?php 
$title="Start";
$desc="DBA02 - Die Beste Antwort";
include($_SERVER['DOCUMENT_ROOT'].'/includes/header.php'); 
?>
<div class="row">
	<div class="col-md-8">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/pages/'. $_GET["show"] . '.php'); ?> 
	</div>
	<div class="col-md-4">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'); ?>
	</div>	  
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'); ?>
