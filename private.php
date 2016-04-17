<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Secure Login: Welcome</title>
</head>
<body>
	<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
</body>
</html>