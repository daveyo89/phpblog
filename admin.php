<?php
	session_start();
	include("db.php");

	if (!isset($_SESSION['admin']) && $_SESSION['admin'] != 2) {
		header("Location: index.php");
		return;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dave Blog</title>
</head>
<body>
	<?php


	$sql = "SELECT * FROM posts ORDER BY id DESC";

	$res = mysqli_query($db, $sql) or die(mysql_error());

	$posts = "";

	if (mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_assoc($res)) {
			$id = $row['id'];
			$title = $row['title'];
			
			$date = $row['date'];

			$admin = "<div id='post_admin_div'><a id='post_delete' href='del_post.php?pid=$id'>Delete</a>&nbsp;<a id='post_edit' href='edit_post.php?pid=$id'>Edit</a></div>";

			$posts .= "<div id='posts_div'><h2 id='post_title'><a href='edit_post.php?pid=$id' target ='_blank'>$title</a></h2><h3 id='post_date'>$date</h3>$admin<hr id='admin_hr' /></div>";

			
		}

		echo $posts;
	} else {
		echo "There are no posts to display, sorry! &nbsp;";

	}

	?>
	<a id="post" href='post.php'>Post</a>
	<a id="logout" href="logout.php">Logout</a>
	<a id="intro" href="introduction/intro.html">Introduction</a>
	<a id="return" href="index.php">Return</a>



</body>
</html>