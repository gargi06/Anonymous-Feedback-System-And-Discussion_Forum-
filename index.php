<!-- id name username password email number role -->

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">

<head>
	<title>Login page</title>
</head>

<body>
	<div class="box">


		<form method="post">
			<h1>Login Form</h1>
			<h2>Username:</h2>
			<input type="text" name="uname" placeholder="Enter your username">
			<h2>Password:</h2>
			<input type="password" name="pass" placeholder="Enter your password">
			<h6></h6>
			<input type="submit" name="login" value="login">
			<h3><a class="links" href="register.php">You can register here</a></h3>

		</form>

	</div>


	<?php
	require("includes/connect.php");
	session_start();
	if (isset($_POST["login"])) {
		$usn = trim($_POST["uname"]);
		$pass = trim($_POST["pass"]);

		if ($usn == "" || $pass == "") {
			?>
			<script type="text/javascript">
				alert("Please enter all the details");
			</script>
	<?php
			header("location: index.php");
		}

		$select_q = "SELECT * FROM `user` WHERE `password`='$pass'";
		$result = mysqli_query($conn, $select_q);
		if (!$result) {
			mysqli_error($conn);
		}

		while ($row = mysqli_fetch_array($result)) {
			$role = $row['role'];

			if ($role) {

				if ($usn == $row['email']) {
					$_SESSION["username"] = $row["uid"];
					$_SESSION["user_id"] = $row["uid"];

					header("location: admin/admin_profile.php");
				}
			} else {
				if (password_verify($usn, $row['email'])) {
					$_SESSION["username"] = $row["uid"];
					$_SESSION["user_id"] = $row["uid"];

					header("location: user/user_profile2.php");
				}
			}
		}
		echo ("Invalid username or password!");
	}
	?>


</body>

</html>