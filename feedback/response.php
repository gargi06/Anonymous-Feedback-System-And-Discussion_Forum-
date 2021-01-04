<!DOCTYPE html>
<html>

<head>
	<title>Responses</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		include("../includes/connect.php");
		include("../includes/is_logged_in.php");

		$form_id = $_GET['form_code'];
		$total_count = "SELECT SUM(response_count), `qid` FROM `responses` WHERE `form_id`='$form_id' GROUP BY `qid`";
		$total_count_result = mysqli_query($conn, $total_count);

		echo ("<table>");
		if ($total_count_result) {
			// $var1=0;
			// $var2=0;
			while ($row = mysqli_fetch_array($total_count_result)) {

				// echo ("<hr>");

				$sum = $row["SUM(response_count)"];
				$qid = $row["qid"];

				$percentage_array = array();
				for ($i = 1; $i <= 4; $i++) {
					$get_option_count = "SELECT `response_count` FROM `responses` WHERE `qid`='$qid' AND `option_no`='$i'";
					$get_option_count_result = mysqli_query($conn, $get_option_count);

					if ($get_option_count_result) {
						while ($row2 = mysqli_fetch_array($get_option_count_result)) {
							if ($sum == 0) {
								$percentage = 0;
							} else {
								$percentage = $row2["response_count"] / $sum;
							}
							array_push($percentage_array, $percentage);
						}
					} else {
						echo (mysqli_error($conn));
					}
				}


				$fetch_question = "SELECT * FROM `forms` WHERE `question_id`='$qid'";
				$fetch_question_result = mysqli_query($conn, $fetch_question);
				if ($fetch_question_result) {
					while ($row3 = mysqli_fetch_array($fetch_question_result)) {


						echo ("<tr>");
						echo ("<td><p style=\"color:black; margin-left:20%\">" . $row3['Question'] . ":" . "</p></td>");
						echo ("</tr>");

						for ($j = 1; $j <= 4; $j++) {
							echo ("<tr>");
							echo ("<td><p style=\"color:black;\">" . $row3["option$j"] . ":" . number_format((float) $percentage_array[$j - 1] * 100, 2, '.', '') . "%" . " </td></td>");
							echo ("</tr>");
						}

						echo("<tr><td><hr width=80% height=20px></td></tr>");
					}
				} else {
					echo (mysqli_error($conn));
				}
				// echo("<hr>");
			}
		}

		echo ("</table>");


		?>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>
	</div>
</body>
<script>
	var height = document.getElementById("box").clientHeight;
	height += 150;
	document.getElementById("box").style = "margin-top:" + height / 2 + "px; width: 30%";
</script>

</html>