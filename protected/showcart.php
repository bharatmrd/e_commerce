<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

sec_session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Your cart</title>
</head>
<body>
	<?php if(!login_check($mysqli)) { ?>
	<p>Please <a href="../index.php">login</a> to see your items in cart.</p>
	<?php } else {
		if($stmt = $mysqli->prepare("SELECT item_number 
								FROM cart_details
								WHERE id = ?")) {
			$stmt->bind_param('i', $_SESSION['user_id']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($item);

			while ($stmt->fetch()) {
				echo $item . "<br/>";
			}
			$stmt->close();
			?>
			<p>If you wish to delete some items from your cart.<a href="delete_cart.php">Click here</a></p>
			<p>Go to <a href="../protected_page.php">main page</a>.</p>
			<?php
		} else {
			echo "There is some error";
			?>
			<p>Go to <a href="addtocart.php">main page</a>.</p>
			<?php
			exit();
		}
	} 
	?>
</body>
</html>