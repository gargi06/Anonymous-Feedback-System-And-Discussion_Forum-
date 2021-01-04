<!DOCTYPE html>
<html>

<head>
	<title>Create Feedback Form</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		require("../includes/connect.php");
		require("../includes/is_logged_in.php");
		?>

		<form method="post">
			<label>Enter number of questions to be inserted: </label>
			<input type="number" name="no" placeholder="Enter a number">
			<input type="submit" name="submit" value="Create">
		</form>


		<?php
		if (isset($_POST["submit"])) {

			//Generate the code for feedback form
			define("LENGTH", 8);
			$str = rand();
			$encrypted_string = md5($str);

			$code = "";

			for ($i = 0; $i < LENGTH; $i++) {
				$index = rand(0, strlen($encrypted_string) - 1);
				$code .= $encrypted_string[$index];
			}

			// echo($code);

			$number = $_POST['no'];

			header("location: generate_feedback_form2.php?form_id=$code&length=$number");
		}
		?>
	</div>
</body>

</html>