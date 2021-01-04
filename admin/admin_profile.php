<!DOCTYPE html>
<html>

<head>
	<title>Admin Profile</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		require("../includes/is_logged_in.php");
		require("../includes/connect.php");

		$username = $_SESSION["username"];
		$admin_id = $_SESSION["user_id"];

		// echo ("Welcome " . $username . "<hr>");

		echo ("<a class='links' href='../feedback/generate_feedback_form1.php'>Create Form</a>");

		?>
		<hr>

		<!-- taking form code as input from user -->

		<table>
			<form method="post">
				<tr>
					<td><label style="margin-left:-25%">Enter form code: </label></td>
					<td><input style=" margin-left:-55%" type="text" name="form_code" placeholder="Enter form code"></td>
				</tr>

				<tr>
					<td><input style=" margin-left:35%" type="submit" name="form_response" value="Get Form Response"></td>
				</tr>
			</form>
		</table>

		<?php
		if (isset($_POST["form_response"])) {
			$form_code = $_POST["form_code"];

			header("location: ../feedback/response.php?form_code=$form_code");
		}
		?>

		<hr>

		<table>
			<form method="post">
				<tr>
					<!-- <td><label>Get organisation Feedback: </label></td> -->
					<td><input style="margin-left:50px" type="submit" name="org_feedback" value="Get Organisation Feedback"></td>
				</tr>
			</form>
		</table>

		<?php
		if (isset($_POST["org_feedback"])) {

			//get the organisation id:
			$get_org_query = "SELECT * FROM `organisation` WHERE `admin_id`='$admin_id'";
			$get_org_query_result = mysqli_query($conn, $get_org_query);

			if ($get_org_query_result) {
				while ($row = mysqli_fetch_array($get_org_query_result)) {
					$org_id = $row["id"];
				}
			} else {
				echo (mysqli_error($conn));
			}


			header("location: ../feedback/org_feedback.php?org_id=$org_id");
		}
		?>
		<hr>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>

	</div>
</body>

</html>