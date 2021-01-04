<!DOCTYPE html>
<html>

<head>
	<title>Enter Form Details</title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div id="box" class="box">
		<?php
		require("../includes/connect.php");
		require("../includes/is_logged_in.php");

		$no = $_GET["length"];
		$form_code = $_GET["form_id"];


		?>

		<table>
			<tr>
				<th colspan="2"><label>Form Details</label></th>
			</tr>

			<form method="post">
				<tr>
					<td><label>Form Name: </label></td>
					<td><input type="text" name="form_name" placeholder="Enter form name"></td>
				</tr>

				<tr>
					<td><label>Form Details: </label></td>
					<td><input type="text" name="form_details" placeholder="Enter form details"></td>
				</tr>

				<tr>
					<td><input style="margin-left:90%" type="submit" name="submit" value="Create"></td>
				</tr>
			</form>
		</table>
		<?php
		if (isset($_POST["submit"])) {
			$form_name = $_POST["form_name"];
			$form_details = $_POST["form_details"];

			$insert_q = "INSERT INTO `form_description`(`form_id`, `form_name`, `form_description`) VALUES ('$form_code','$form_name','$form_details')";
			$result = mysqli_query($conn, $insert_q);

			if ($result) {
				header("location: generate_feedback_form3.php?form_id=$form_code&length=$no");
			} else {
				echo (mysqli_error($conn));
			}
		}
		?>
	</div>
</body>

</html>