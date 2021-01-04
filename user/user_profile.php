<!DOCTYPE html>
<html>
<link rel="stylesheet" href="../style.css">

<head>
	<title>User Profile</title>
</head>

<body style="color:#222222">
	<?php
	require("../includes/is_logged_in.php");
	require("../includes/connect.php");
	// session_start(); session already started in included file: is_logged_in.php
	$username = $_SESSION["username"];
	$org_id = $_SESSION['org_id'];

	?>

	<div id="box" class="box" style="padding-left:20%; padding-right:20%;margin-top:26%">
		<?php
		//fetching the name of the organisation
		$get_org_name = "SELECT * FROM `organisation` WHERE `id`=$org_id";
		$get_org_name_result = mysqli_query($conn, $get_org_name);
		if ($get_org_name_result) {
			while ($row = mysqli_fetch_array($get_org_name_result)) {
				$org_name = $row["org_name"];
			}
		} else {
			echo ("Invalid id entered!");
		}

		echo ("<h1>Welcome to " . $org_name . "</h1>");
		echo ("<hr>");

		//fetching the levels of that particular organisation
		$fetch_outer_issues = "SELECT * FROM `level` WHERE `org_id`=$org_id";
		$fetch_outer_issues_result = mysqli_query($conn, $fetch_outer_issues);

		if ($fetch_outer_issues_result) {
			while ($row = mysqli_fetch_array($fetch_outer_issues_result)) {
				$level_id = $row["lid"];
				$level_name = $row["lname"];
				echo ("<a href='../levels/level.php?lid=$level_id' style=\"font-size:25px\" class=\"links\">$level_name</a>");
			}
		} else {
			echo (mysqli_error($conn));
		}
		?>
		<hr>
		<table style="margin-left:100px">
			<tr>
				<th colspan="2">
					<br><br>
					<label style="color:#222222; padding-left:25%; font-size:25px">Create a category</label>
				</th>
			</tr>

			<form method="post">
				<tr>
					<td><label style="font-size:25px; margin-left:-50px">Category Name: </label></td>
					<td><input type="text" name="level" placeholder="Enter the category"></td>
					<td><input type="submit" name="create_level" value="Create"> </td>
				</tr>
			</form>
		</table>

		<?php
		if (isset($_POST["create_level"])) {

			$level = $_POST["level"];
			$insert_level = "INSERT INTO `level`(`org_id`, `lname`) VALUES ('$org_id','$level')";
			$insert_level_result = mysqli_query($conn, $insert_level);
			if ($insert_level_result) {

				// echo("$$$$$$$$$$");

				header("location: user_profile.php?org_id=$org_id");
			} else {
				echo (mysqli_error($conn));
			}
		}
		?>

		<table style="margin-left:100px">

			<form method="post">
				<tr>
					<td><label style="font-size:25px">Enter Code: </label></td>
					<td><input type="text" name="code" placeholder="Enter the code"></td>
					<td><input type="submit" name="give_feedback" value="Fill Form"></td>
				</tr>
			</form>
		</table>

		<?php
		if (isset($_POST["give_feedback"])) {
			$code = $_POST["code"];

			$check_validity = "SELECT `form_id` FROM `form_description` WHERE `form_id`='$code'";
			$check_validity_result = mysqli_query($conn, $check_validity);

			if ($check_validity_result) {
				while ($row2 = mysqli_fetch_array($check_validity_result)) {

					header("location: give_feedback.php?form_id=$code");
				}
			}
		}
		?>
		<br><br>
		<form style="margin-left:-150px" method="post">
			<label style="position:absolute;margin-top:-25px;margin-left:50px;color:#222222; font-size:20px; font-weight:500">Give Feedback to Organisation: </label>
			<textarea class="subject" name="org_feedback" placeholder="Your feedback is valuable to us!"></textarea>
			<input style="position: absolute; margin-top: 4%; margin-left: 1%;" type="submit" name="user_feedback" value="Send">
		</form>

		<?php
		$org_id = $_GET["org_id"];

		if (isset($_POST["org_feedback"])) {
			$text = $_POST["org_feedback"];

			$send_user_feedback = "INSERT INTO `user_feedback`(`org_id`, `feedback`) VALUES ('$org_id','$text')";
			$send_user_feedback_result = mysqli_query($conn, $send_user_feedback);

			if (!$send_user_feedback_result) {
				echo (mysqli_error($conn));
			}
		}
		?>
		<hr>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>

	</div>
</body>
<script>
	var height = document.getElementById("box").clientHeight;
	height -= 20;
	document.getElementById("box").style = "margin-top:" + height / 2 + "px; width: 50%";
</script>

</html>