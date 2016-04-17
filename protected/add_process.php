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
	<?php
		if($stmt = $mysqli->prepare("INSERT INTO cart_details 
								(id, item_number) VALUES
								(?, ?)")) {
			$stm = $mysqli->prepare("SELECT id FROM cart_details
									WHERE item_number = ?");
			$stm->bind_param('i', $_GET['itemno']);
			$stm->execute();
			$stm->store_result();

			$stm->bind_result($did);
			$stm->fetch();
			if($did != $_SESSION['user_id']) {
				$stmt->bind_param('ii', $_SESSION['user_id'], $_GET['itemno']);
				if($stmt->execute()) {
					echo "Congrats! Item added successfully.";
				} else {
					echo "Sorry! Please try again.";
				}
			} else {
				echo "this is already in your cart.";
			}
			$stmt->close();
		} else {
			echo "There is some error";
			?>
			<p>Go to <a href="addtocart.php">main page</a>.</p>
			<?php
		}
	?>
</body>
</html>