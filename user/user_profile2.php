<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../style.css">

<head>
	<title>User Profile</title>
</head>

<body>
	<?php
	require("../includes/is_logged_in.php");
	require("../includes/connect.php");
	// session_start(); session already started in included file: is_logged_in.php
	$username = $_SESSION["username"];
	?>
	<div class="box">
		<tr>
			<th colspan="2"><label>SELECT THE ORGANISATION</label></th>
		</tr>

		<form method="post">
			<tr>
				<td><label>Enter organisation id: </label></td>
				<td><input type="number" name="org_id" placeholder="Enter organisation id"></td>
			</tr>

			<tr>
				<td><input type="submit" name="go" value="GO"></td>
			</tr>
		</form>
	</div>

	<?php
	if (isset($_POST["go"])) {
		$org_id = $_POST["org_id"];
		$_SESSION["org_id"] = $org_id;
		header("location: user_profile.php?org_id=$org_id");
	}
	?>
	<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>
</body>

</html>