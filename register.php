<?php
	if (isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	if (isset($_POST['register'])) {
		include_once("db.php");

		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password_confirm = strip_tags($_POST['password_confirm']);
		$email = strip_tags($_POST['email']);


		$username = stripslashes($username);
		$password = stripslashes($password);
		$password_confirm = stripslashes($password_confirm);
		$email = stripslashes($email);



		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);
		$password_confirm = mysqli_real_escape_string($db, $password_confirm);
		$email = mysqli_real_escape_string($db, $email);


		$password = md5($password);
		$password_confirm = md5($password_confirm);

		$sql_store = "INSERT into users (username, password, email) VALUES ('$username', '$password', '$email')";

		$sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
		$sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";

		$query_username = mysqli_query($db, $sql_fetch_username);
		$query_email = mysqli_query($db, $sql_fetch_email);

		if (mysqli_num_rows($query_username)) {
			echo "Username already in use!";
			return;
		}
		if ($username == "") {
			echo "Please insert a username!";
			return;
		}
		if ($password == "" || password_confirm == "") {
			echo "Please insert your password!";
			return;
		}
		if ($password != $password_confirm) {
			echo "Passwords does not match!";
			return;
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL || $email == "")) {
			echo "This email is not valid!";
			return;
		}

		if (mysqli_num_rows($query_email)) {
			echo "Email already in use!";
			return;
		}
		
		mysqli_query($db, $sql_store);

		header("Location: index.php");

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
</head>
<body>
	<div id="form_background_div">
		<div>
			<form id="register_form" action="register.php" method="post" enctype="multipart/form-data"><br />
				<input placeholder="Username" name="username" type="text" autofocus><br />
				<input placeholder="Password" name="password" type="password"><br />
				<input placeholder="Confirm Password" name="password_confirm" type="password"><br />
				<input placeholder="E-mail Address" name="email" type="text"><br />
				<input id="register_button" name="register" type="submit" value="Register"><br />
			</form>
		</div>
	</div>

</body>
</html>