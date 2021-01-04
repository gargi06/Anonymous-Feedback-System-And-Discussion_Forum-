<!DOCTYPE html>
<html>

<head>
	<title>Discussions</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php

		require("../includes/connect.php");
		require("../includes/is_logged_in.php");
		//session started in is_logged_in.php

		$read_more = $_GET["read_more"];
		$issue_id = $_GET["iid"];

		echo ("<h2>Recent Messages:</h2>" . "<hr>");


		if ($read_more == "true") {
			$select_all = "SELECT * FROM `discussion` WHERE `issueid`='$issue_id'";
			$select_all_result = mysqli_query($conn, $select_all);

			if ($select_all_result) {
				while ($row = mysqli_fetch_array($select_all_result)) {
					$solution_id = $row["sid"];
					$upvote_count = $row["upvote"];
					$report_count = $row["report"];

					echo ("<p style=\"position:relative; width:100%\">User ID :" . $row['userid'] . ": " . $row["message"] . "</p><br>" . "<a class=\"links\" href='upvote.php?sid=$solution_id&iid=$issue_id'>Upvote\t :" . $upvote_count . "\t" . "</a><a class=\"links\" href='report.php?sid=$solution_id&iid=$issue_id'>Report\t :" . $report_count . "</a><hr>");
				}

				echo ("<a class=\"links\" href='solution.php?iid=$issue_id&read_more=false'>Read Less</a>");
			} else {
				echo (mysqli_error($conn));
			}
		} else {

			$query1 = "SELECT * FROM (SELECT * FROM `discussion` WHERE `issueid`='$issue_id' ORDER BY `sid` DESC LIMIT 5)var1 ORDER BY `sid` ASC ";
			$result = mysqli_query($conn, $query1);

			if ($result) {
				while ($row = mysqli_fetch_array($result)) {
					$solution_id = $row["sid"];
					$upvote_count = $row["upvote"];
					$report_count = $row["report"];

					echo ("<p style=\"position:relative; width:100%\">User ID :" . $row['userid'] . ": " . $row["message"] . "</p><br>" . "<a class=\"links\" href='upvote.php?sid=$solution_id&iid=$issue_id'>Upvote\t :" . $upvote_count . "\t" . "</a><a class=\"links\" href='report.php?sid=$solution_id&iid=$issue_id'>Report\t :" . $report_count . "</a><hr>");
				}
				echo ("<a class=\"links\" href='solution.php?iid=$issue_id&read_more=true'>Read More</a>");
			} else {
				echo ("Error description1: " . mysqli_error($conn));
			}

			echo ("<hr><hr><hr>");
		} //end of else of $read_more
		?>

		<table style="margin-left:25%">
			<tr>
				<th colspan="2"><label>Post a message</label></th>
			</tr>

			<form method="post">
				<tr>
					<td><label>Message: </label></td>
					<td><input type="text" name="message" placeholder="Enter your message"></td>
				</tr>


				<tr>
					<td><input style="margin-left:100%" type="submit" name="submit" value="POST"></td>
				</tr>
			</form>
		</table>

		<hr>
		<hr>
		<hr>

		<h2>Important Messages:</h2>

		<?php
		if (isset($_POST["submit"])) {
			$message = $_POST["message"];
			$uid = $_SESSION["username"];

			$insert_msg = "INSERT INTO `discussion`(`issueid`, `userid`, `message`) VALUES ('$issue_id','$uid','$message')";
			$res = mysqli_query($conn, $insert_msg);

			if (!$res) {
				echo ("Error description2: " . mysqli_error($conn));
			}
			// $get_issue_id="SELECT * FROM `discussion` WHERE `userid`"

			header("location: solution.php?iid=$issue_id&read_more=false");
		}
		?>

		<?php

		if ($read_more == "true") {

			$select_all_upvote = "SELECT * FROM `discussion` WHERE `issueid`=$issue_id ORDER BY `upvote` DESC ";
			$select_all_upvote_result = mysqli_query($conn, $select_all_upvote);

			if ($select_all_upvote_result) {
				while ($row = mysqli_fetch_array($select_all_upvote_result)) {
					$solution_id = $row["sid"];
					$upvote_count = $row["upvote"];
					$report_count = $row["report"];

					echo ("<p style=\"position:relative; width:100%\">User ID :" . $row['userid'] . ": " . $row["message"] . "</p><br>" . "<a class=\"links\" href='upvote.php?sid=$solution_id&iid=$issue_id'>Upvote :" . $upvote_count . "\t" . "</a><a class=\"links\" href='report.php?sid=$solution_id&iid=$issue_id'>Report:" . $report_count . "</a><hr>");
				}

				echo ("<a class=\"links\" href='solution.php?iid=$issue_id&read_more=false'>Read Less</a>");
			} else {
				echo (mysqli_error($conn));
			}
		} else { //read_more=false

			$select_all_upvote = "SELECT * FROM `discussion` WHERE `issueid`=$issue_id ORDER BY `upvote` DESC LIMIT 5";
			$select_all_upvote_result = mysqli_query($conn, $select_all_upvote);

			if ($select_all_upvote_result) {
				while ($row = mysqli_fetch_array($select_all_upvote_result)) {
					$solution_id = $row["sid"];
					$upvote_count = $row["upvote"];
					$report_count = $row["report"];

					echo ("<p style=\"position:relative; width:100%\">User ID :" . $row['userid'] . ": " . $row["message"] . "</p><br>" . "<a class=\"links\" href='upvote.php?sid=$solution_id&iid=$issue_id'>Upvote:" . $upvote_count . "\t" . "</a><a class=\"links\" href='report.php?sid=$solution_id&iid=$issue_id'>Report:" . $report_count . "</a><hr>");
				}

				echo ("<a class=\"links\" href='solution.php?iid=$issue_id&read_more=true'>Read More</a>");
			}
		}

		?>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>
	</div>
</body>
<script>
	var height = document.getElementById("box").clientHeight;
	height += 150;
	document.getElementById("box").style = "margin-top:" + height / 2 + "px; width: 50%";
</script>

</html>