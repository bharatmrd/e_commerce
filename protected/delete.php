<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php if(!login_check($mysqli)) { ?>
	<p>Please <a href="../index.php">login</a> to see your items in cart.</p>
	<?php } else {
		if($stmt = $mysqli->prepare("DELETE FROM cart_details
								WHERE item_number = ?")) {
			$stmt->bind_param('i', $_GET['item']);
			if($stmt->execute()) {
				echo "Deleted successfully";
			} else {
				echo "Please try again";
			}
		}
	} ?>
</body>
</html>