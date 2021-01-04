<!DOCTYPE html>
<html>

<head>
	<title>Give Feedback</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box" style="margin-top: 50%; width:50%">
		<?php
		include("../includes/connect.php");
		include("../includes/is_logged_in.php");

		$org_id = $_SESSION["org_id"];
		$form_id = $_GET["form_id"];

		//fetching questions from database
		$select_questions = "SELECT `question_id`,`Question`,`option1`,`option2`,`option3`,`option4` FROM `forms` WHERE `form_id`='$form_id' ORDER BY `question_id` ASC";
		$select_questions_result = mysqli_query($conn, $select_questions);

		$qid_array = array();

		if ($select_questions_result) {

			//fetching the form details from `form_description` table
			$select_description = "SELECT * FROM `form_description` WHERE `form_id`='$form_id'";
			$select_description_result = mysqli_query($conn, $select_description);

			if ($select_description_result) {

				while ($row = mysqli_fetch_array($select_description_result)) {

					echo ("Form name: " . $row["form_name"]);
					echo ("<hr>");
					echo ("Form description: <br>" . $row["form_description"]);
					echo ("<hr>");
				}
			}


			echo "<form method='post'>";
			echo "<table style=\"margin-left:10px\">";
			echo "<tr><th><p style=\"color:black\">Questions</p></th></tr>";

			//warning, do not delete $i below 
			$i = 0;
			while ($row = mysqli_fetch_array($select_questions_result)) {
				array_push($qid_array, $row["question_id"]);
				echo "<tr>";
				$u = $i + 1;
				echo "<td><p style=\"color:black;\">" . "Question" . $u . ":</p></td>";
				echo "<td><p style=\"color:black\">" . $row["Question"] . "</p></td>";
				echo "</tr>";


				for ($j = 1; $j <= 4; $j++) {
					echo "<tr>";
					echo "<td><p style=\"color:black\">Option" . $j . "</p></td>";
					echo "<td><p style=\"color:black\"><input type='radio' name='ans" . $i . "' value='" . $j . "'/>" . $row["option$j"] . "</p></td>";
					echo "</tr>";
				}
				// echo "<input type='hidden' name='qid".$i."' value='' />";
				$i++;

				echo "<tr><td colspan='2'><hr style=\"margin-left:40%\"></td></tr>";
			}
			echo "<tr><td><input style=\"margin-left:40%\" type='submit' name='submit' value='submit responses'/></td></tr><tr><td colspan='2'></td></tr>";
			echo "</table></form>";
		} else {
			echo mysqli_error($conn);
		}
		if (isset($_POST["submit"])) {
			for ($i = 0; $i < count($qid_array); $i++) {
				if (isset($_POST["ans$i"])) {
					$response = $_POST["ans$i"];

					$fetch_count = "Select `response_count` FROM `responses` WHERE `form_id`='$form_id' AND `qid` ='$qid_array[$i]' AND `option_no`='$response' ";

					//$insert_response="INSERT INTO `form_response`(`form_id`, `qid`, `response`) VALUES ('$form_id','$qid_array[$i]','$response')";

					$fetch_count_result = mysqli_query($conn, $fetch_count);
					$count;
					if ($fetch_count_result) {
						while ($row = mysqli_fetch_array($fetch_count_result)) {
							$count = $row["response_count"] + 1;
						}
						$update_response = "UPDATE `responses` SET `response_count`='$count' WHERE `form_id`='$form_id' AND `qid`='$qid_array[$i]' AND `option_no`='$response'";
						$update_response_result = mysqli_query($conn, $update_response);
						if (!$update_response_result) {
							echo (mysqli_error($conn));
						}
					} else {
						echo (mysqli_error($conn));
					}
				}
			}
			header("location: user_profile.php?org_id=$org_id");
		}

		?>
	</div>
</body>
<script>
	var height = document.getElementById("box").clientHeight;
	height += 150;
	document.getElementById("box").style = "margin-top:" + height / 2 + "px; width:50%";
</script>

</html>