<?php
	if (isset($_GET['error'])) {
	$error = $_GET['error'];
?>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<style>
			.holder {
				padding:3px;
				margin-left:auto;
				margin-right:auto;
				margin-top:10%;
				display:table;
				border:solid 1px #cccccc;
				border-width: thin;
			}
		</style>
	</head>
	<body>
	<div class="holder">
		<label for="errormsg">Note: </label><label for="error"><?php echo $error; ?></label>
	</div>	
	</body>
</html>
<?php } ?>