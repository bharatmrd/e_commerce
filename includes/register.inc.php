<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if(isset($_POST['username'], $_POST['email'], $_POST['p'])) {
	// Sanitize and validate the data passed in
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Not a valid email
		$error_msg .= '<p class="error">The email address you entered is not valid.</p>';
	}

	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if(strlen($password) != 128) {
		// The hashed pwd should be 128 character long.
		// If it's not, something really odd has happened.
		$error_msg .= '<p class="error">Invalid password configuration.</p>';
	}

	$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
	$stmt = $mysqli->prepare($prep_stmt);

	// Checking existing email
	if($stmt) {
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows == 1) {
			// User with this email address already exists.
			$error_msg .= '<p class="error">A user with this email address already exists.</p>';
			$stmt->close();
		} /* else {
			$error_msg .= '<p class="error">Database error line 39.</p>';
			$stmt->close();
		} */

		// Check existing username.
		$prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
		$stmt = $mysqli->prepare($prep_stmt);

		if($stmt) {
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
				// user with this username already exists.
				$error_msg .= '<p class="error">A user with this username address already exists.</p>';
				$stmt->close();
			} /* else {
				$error_msg .= '<p class="error">Database error line 55.</p>';
			} */
			if(empty($error_msg)) {
				$password = password_hash($password, PASSWORD_BCRYPT);

				// Insert the new user into the database.
				if($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password) VALUES (?, ?, ?)")) {
					$insert_stmt->bind_param('sss', $username, $email, $password);
					if(!$insert_stmt->execute()) {
						header("Location: ../error.php?err=Registration failure: INSERT");
					}
				}
				header("Location: register_success.php");
			}
		}
	}
}

?>