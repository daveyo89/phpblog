<?php
	session_start();
	include("db.php");

	if (!isset($_SESSION['id'])) {
		header("Location: login.php");	
	}
	if ($_SESSION['admin'] > 0) {
		header("Location: index.php");
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
</head>
<body>
	<?php

	require_once("nbbc/nbbc.php");

	$bbcode = new BBCode;

	$pid = $_GET['pid'];

	$sql = "SELECT * FROM posts WHERE id=$pid LIMIT 1";

	$res = mysqli_query($db, $sql) or die(mysql_error());


	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {

			$id = $row['id'];
			$title = $row['title'];
			$date = $row['date'];
			$content = $row['content'];
			$author = $row['author'];

			if ($_SESSION['admin'] == 2) {
				$admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
			} else {
				$admin = "";
			}
			

			$output = $bbcode->Parse($content);
			echo "<div id='view_post_content_div'><h2 id='view_title'>$title</h2><p id='view_content'>$output</p><h4 id='view_date'>$date</h4><h5 id='author_name'>$author</h5>$admin<hr /></div>";
			
		}

	} else {
		echo "There are no posts to display, sorry! &nbsp;";

	}

	?>

		<a id="view_return" href="index.php">Return</a>


</body>
</html>