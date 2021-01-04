<?php
require("../includes/connect.php");
require("../includes/is_logged_in.php");


$issue_id = $_GET["iid"];
$sid = $_GET["sid"];

$select_msg = "SELECT * FROM `discussion` WHERE `sid`='$sid'";
$select_msg_result = mysqli_query($conn, $select_msg);

if ($select_msg_result) {
	while ($row = mysqli_fetch_array($select_msg_result)) {
		$upvote_count = $row["upvote"];
	}
} else {
	echo (mysqli_error($conn));
}

$upvote_count++;
// echo($upvote_count);

$update_count = "UPDATE `discussion` SET `upvote`='$upvote_count' WHERE `sid`='$sid'";
$update_count_result = mysqli_query($conn, $update_count);
if ($update_count_result) {
	//redirect
	header("location: solution.php?iid=$issue_id&read_more=false");
} else {
	echo (mysqli_error($conn));
}
