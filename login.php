<?php
	session_start();

	if (isset($_POST['login'])) {
		include_once("db.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);

		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysqli_real_escape_string($db, $username);
		$password = mysqli_real_escape_string($db, $password);

		$password = md5($password);

		$sql = "SELECT * FROM users WHERE username= '$username' LIMIT 1";
		$query = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($query);

		$id = $row['id'];
		$db_password = $row['password'];
		$admin = $row['admin'];



		if ($password == $db_password) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			if ($admin == 1) {
				$_SESSION['admin'] = 1;
			}
			if ($admin == 2) {
				$_SESSION['admin'] = 2;
			}
			header("Location: index.php");
		} else {
			echo "Incorrect username or password!";
		}
	}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="introduction/form.css" >
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
    </style>
</head>
<body class="w3-light-grey">
	<h1 style="font-family: Roboto;">Login</h1>
	<div class="container">
	<form action="login.php" method="post" enctype="multipart/form-data">
		<input placeholder="Username" name="username" type="text" autofocus>
		<input placeholder="Password" name="password" type="password">
		<input name="login" type="submit" value="Login">
	</form>
</div>
	<h5 id="login_register">If you dont have an account yet, please <a href="register.php">Register</a> here!</h5>

</body>
</html>