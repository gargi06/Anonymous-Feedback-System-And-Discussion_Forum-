<!DOCTYPE html>
<html>

<head>
	<title>Organisation Feedback</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		require("../includes/is_logged_in.php");
		require("../includes/connect.php");

		$org_id = $_GET["org_id"];

		$get_feedback = "SELECT * FROM `user_feedback` WHERE `org_id`='$org_id'";
		$get_feedback_result = mysqli_query($conn, $get_feedback);

		if ($get_feedback_result) {
			while ($row = mysqli_fetch_array($get_feedback_result)) {
				echo ($row["feedback"]);
				echo ("<hr>");
			}
		} else {
			echo (mysqli_error($conn));
		}
		?>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>
	</div>
</body>

</html>