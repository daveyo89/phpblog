<?php
	session_start();
	include("db.php");


	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}

	if (isset($_POST['post'])) {
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);
		$author = strip_tags($_SESSION['username']);
		


		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		$author = mysqli_real_escape_string($db, $author);


		$date = date('l jS \of F Y h:i:s A');

		$sql = "INSERT into posts (title, content, date, author) VALUES ('$title', '$content', '$date', '$author')";

		if ($title == "" || $content == "") {
			echo "Please complete your post!";
			return;
		}	

		mysqli_query($db, $sql);

		header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>New Post</title>
</head>
<body>
	<form id="post_form" action="post.php" method="post" enctype="multipart/form-data">
	<input placeholder="Title" name="title" type="text" autofocus size="48"><br /><br />
	<textarea placeholder="Content" name="content" rows="25" cols="57"></textarea><br />
	<input name="post" type="submit" value="Post">
	</form>

	<a id="cancel_post" href="index.php">Cancel</a>

</body>
</html>


