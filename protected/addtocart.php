<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add to cart</title>
	<script type="text/javascript" src="cartfunction.js"></script>
</head>
<body>
	<?php if(!login_check($mysqli)) { ?>
	<p>Please <a href="../index.php">login</a> first to add items to cart.</p>
	<?php } else { ?>
		<form action="add_process.php" method="get">
			Item number: <input type="text" name="itemno" />
			<input type="button" value="Add to cart" onclick="validateitem(this.form, this.itemno)">
		</form>
	<?php } ?>
</body>
</html>