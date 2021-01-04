<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="../style.css">
</head>

<body>
	<div class="box">
		<?php
		require("../includes/is_logged_in.php");
		require("../includes/connect.php");
		$lid = $_GET["lid"];
		$usn = $_SESSION['username'];

		$fetch_issues = "SELECT * from `issues` WHERE `level_id`='$lid'";
		$x = mysqli_query($conn, $fetch_issues);

		if ($x) {
			while ($r = mysqli_fetch_array($x)) {

				?>
				<a style="font-size:25px" class="links" href="../discussion/solution.php?iid=<?php echo ($r['iid']); ?>&read_more=false"><?php echo ($r["name"]); ?></a>
		<?php
			}
			echo ("<hr>");
		} else {
			echo ("Unable to fetch the issues!<br>");
			echo ("Error description: " . mysql_error());
		}
		//}
		?>
		<br>
		<table>
			<tr>
				<th colspan="2"><label style="margin-left:25px;font-size: 20px">Create a subcategory</label></th>
			</tr>

			<form method="post">
				<tr>
					<td><input type="text" name="issue" placeholder="Enter the issue">
						<input type="submit" name="submit">
					</td>
				</tr>
			</form>
		</table>
		<?php

		$uid = $_SESSION["username"];

		if (isset($_POST["submit"])) {

			$issue = $_POST["issue"];
			$insert_i = "INSERT INTO `issues`(`name`, `level_id`, `user_id`) VALUES ('$issue','$lid','$uid')";
			$result = mysqli_query($conn, $insert_i);
			if ($result) {
				$fetch_issue_id = "SELECT * from `issues` WHERE `name`='$issue' AND `level_id`='$lid' AND `user_id`='$uid'";
				$result2 = mysqli_query($conn, $fetch_issue_id);
				if ($result2) {
					while ($row = mysqli_fetch_array($result2)) {
						$xyz = $row["iid"];
						$read_more = false;
						header("location: ../discussion/solution.php?iid=$xyz");
					}
				} else {
					//error
					echo ("Unable to redirect to solution page!!<br>");
					echo ("Error description: " . mysql_error());
				}
			} else {
				//error
				echo ("Unable to insert the issue in table");
				echo ("Error description: " . mysql_error());
			}
		}
		?>
		<a class="links" href="../includes/logout.php" style="text-decoration: none; font-size:20px">Logout</a>
	</div>
</body>

</html>