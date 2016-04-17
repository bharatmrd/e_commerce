<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete item from your cart.</title>
	<script type="text/javascript" src="cartfunction.js"></script>
</head>
<body>
	<form action="delete.php" method="get">
		Enter your cart number: <input type="text" name="item" />
		<input type="button" value="Delete" onclick="this.form.submit();" />
	</form>
</body>
</html>