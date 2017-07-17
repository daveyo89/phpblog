<?php

	session_start();
	
	ini_get('tmp');
	ini_set('session_save_path()', 'tmp');
	if (!isset($_SESSION['id'])) {
		header("Location: login.php");
		exit();
	}
	include("db.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dave Blog</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/mobile.js" type="text/javascript"></script>
	<style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Alex Brush", sans-serif; font-size: 120%;}
    </style>


</head>
<header class="w3-container w3-teal w3-center w3-margin-top">
	<div class="header_button">
		<a href='index.php' class='logo' style="color: white"><h3> Home </h3></a>
	</div>
	<div class="header_button">
		<a href='logout.php' class='logo' style="color: white"><h3> Logout </h3></a>
	</div>
	<div class="header_button"> 
		<a href='admin.php' class='logo' style="color: white"><h3> Admin </h3></a>
	</div>
</header>
<body class="w3-light-grey">

<div class="w3-content w3-margin-top" style="max-width:1400px;">
<div class="w3-row-padding">
<div class="w3-white w3-text-grey w3-card-4">

	<?php
	require_once("nbbc/nbbc.php");



	$bbcode = new BBCode;

	$sql = "SELECT * FROM posts ORDER BY id DESC";

	$res = mysqli_query($db, $sql) or die(mysql_error());

	$posts = "";

	$mypic = '<div class="w3-container"><div class="float_right">
	                             <img src="introduction/pictures/imapony.jpg" class="w3-circle" alt="Norway" style="width:10%"> 
	                            <h4 style="color:white">Welcome to my Blog, feel free to browse!</h4>
	                            </div>
	                        </div></div>';

	$logo = "<a href='index.php' class='logo'><img src='images/warlock.png' alt='logo' style='width:15%'></a>";

    

	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$date = $row['date'];
			$author = $row['author'];

			$output = $bbcode->Parse($content);
			$posts .= "<div class='w3-twothird'><div id='index_div'><h2 id='index_header'><a href='view_post.php?pid=$id'>$title</a></h2><p id='post_text'>$output</p><hr /><h3 id='post_date'>$date</h3><h5>Written by: $author</h5></div></div>";
			}
		
			echo $logo;
			echo $mypic;
		
			echo $posts;
		
}

	

	if (isset($_SESSION['admin']) && $_SESSION['admin'] == 2) {
		echo "<a href='admin.php'>Admin</a> | <a href='logout.php'>Logout</a>";
	}

	if (!isset($_SESSION['username'])) {
		echo "<a href='login.php'>Login</a>";
	}
	if (isset($_SESSION['username']) && !isset($_SESSION['admin'])) {
		echo "<a class='logout_button' href='logout.php'>Logout</a>";
	}

	?>
</div>
</div>
</div>

</div>
						

		<footer class="w3-container w3-teal w3-center w3-margin-top">
            <p>Find me on social media.</p>
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
            <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </footer>
</body>
</html>