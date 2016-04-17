<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Secure Login: Protected Page</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
</head>
<body>
	<?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                Here comes my cart mechanism ^_^.
            </p>
            <p><a href="protected/addtocart.php">Add</a> item to cart.</p>
            <p><a href="protected/showcart.php">Show</a> my cart items.</p>
            <p><a href="includes/logout.php">logout</a></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
</body>
</html>