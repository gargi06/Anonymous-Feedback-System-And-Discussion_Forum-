<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">

<head>
	<title>Register page</title>
</head>

<body>
	<div class="box">



		<form method="post">
			<h1>Register Form</h1>
			<h2>Email id:</label></h2>
			<input type="text" name="uname" placeholder="Enter your username">
			<h2>Password:</h2>
			<input type="password" name="pass" placeholder="Enter your password">
			<input type="submit" name="register" value="Register">

			<a class="links" href="index.php">You can login here</a>
			<h3>To register your organisation, contact database administrator.</h3>
		</form>
	</div>



	<?php

	require("includes/connect.php");
	session_start();
	if (isset($_POST["register"])) {
		$usn = trim($_POST["uname"]);
		$pass = trim($_POST["pass"]);

		$hashed_usn = password_hash($usn, PASSWORD_DEFAULT);

		$insert_q = "INSERT INTO `user`(`email`, `password`) VALUES ('$hashed_usn','$pass')";
		$result = mysqli_query($conn, $insert_q);
		if ($result == 0) {

			echo(mysqli_error($conn));
		} else {
			?>
			<script type="text/javascript">
				alert("Profile Created successfully!!!");
			</script>
	<?php
			header("location: index.php");
		}
	}
	?>


</body>

</html>