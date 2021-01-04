<!DOCTYPE html>
<html>

<head>
	<title>Generate Feedback Form</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		//including important files
		require("../includes/connect.php");
		require("../includes/is_logged_in.php");

		//Getting important variables
		$no = $_GET["length"];
		$form_code = $_GET["form_id"];
		$user_id = $_SESSION["user_id"];


		//To get the organisation id to be inserted in DB table
		$get_org_id = "SELECT * FROM `organisation` WHERE `admin_id`=$user_id";
		$get_org_id_result = mysqli_query($conn, $get_org_id);

		if ($get_org_id_result) {
			while ($row = mysqli_fetch_array($get_org_id_result)) {
				$org_id = $row["id"];
			}
		}


		// to insert into DB table 
		function insertData($conn, $ques, $o1, $o2, $o3, $o4, $org_id, $form_code)
		{

			$i = 1;
			$insert_q = "INSERT INTO `forms`(`organisation_id`, `form_id`, `Question`, `option1`, `option2`, `option3`, `option4`) VALUES ('$org_id','$form_code','$ques','$o1','$o2','$o3','$o4')";
			if (mysqli_query($conn, $insert_q)) {
				$fetch_qid = "SELECT `question_id` FROM `forms` WHERE `organisation_id`='$org_id' AND `form_id`='$form_code' AND `Question`='$ques' ";
				$fetch_qid_result = mysqli_query($conn, $fetch_qid);
				if ($fetch_qid_result) {
					while ($row = mysqli_fetch_array($fetch_qid_result)) {
						$qid = $row["question_id"];
						//echo $qid;
					}
					for ($i = 1; $i <= 4; $i++) {
						$set_response_cnt = "INSERT INTO `responses`(`form_id`, `qid`, `option_no`, `response_count`) VALUES ('$form_code','$qid','$i','0')";
						if (!mysqli_query($conn, $set_response_cnt)) {
							echo "$$$$$$" . mysqli_error($conn);
						}
					}
				} else {
					echo "#####" . mysqli_error($conn);
				}
				return true;
			} else {
				echo mysqli_error($conn);
				return false;
			}
		}

		//To get the question and options from user
		function getQuestion($count)
		{
			echo "<hr>";
			echo "<input type='text' name='q" . $count . "' placeholder='Question " . $count . "'>";
			echo "<br>";
			for ($i = 1; $i < 5; $i++) {
				if ($i == 3)
					echo ("<br>");
				echo "<input  type='text' name='q" . $count . "op" . $i . "' placeholder='Option " . $i . "'>";
				echo ("               ");
			}

			echo "<br>";
			// echo "<hr>";
		}


		if (!(isset($_POST["create"]))) {

			echo ("<h3>The form code is: " . $form_code . "</h3>");
			echo ("<h4>Please note this form code<h4>");

			echo "<form method='post'>";

			for ($i = 1; $i <= $no; $i++) {
				getQuestion($i);
			}
			echo "<input type='submit' name='create' value='Create'>";
			echo "</form>";
			echo ("<h4>You cannot log out at this stage</h4>");
		}

		//When user selects "create" then the questions and corresponding options must be uploaded to DB
		if (isset($_POST["create"])) {
			for ($i = 1; $i <= $no; $i++) {
				$ques = $_POST["q" . $i];
				$op1 = $_POST["q" . $i . "op1"];
				$op2 = $_POST["q" . $i . "op2"];
				$op3 = $_POST["q" . $i . "op3"];
				$op4 = $_POST["q" . $i . "op4"];

				if (!insertData($conn, $ques, $op1, $op2, $op3, $op4, $org_id, $form_code)) {
					echo "<br>";
					echo "Question " . $i . " could not be inserted.";
					echo "<br>";
				}
			}

			header("location: ../admin/admin_profile.php");
		}

		?>

	</div>
</body>
<script>
	var height = document.getElementById("box").clientHeight;
	height -= 500;
	document.getElementById("box").style = "margin-top:" + height / 2 + "px; width: 50%";
</script>

</html>