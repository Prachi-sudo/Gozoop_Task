<?php
session_start();

require_once( $_SERVER["DOCUMENT_ROOT"] . "/database/config.php" );

$output = array();

$error = 0;
$errorMessage = "";
$errorCode = 0;

$rewardPoints = $_POST["rewardPoints"];
$loggedIn_user = $_SESSION['username'];

if( ! $rewardPoints){
    $error = 1;
    $errorMessage = "No rewardPoints";
    $errorCode = 1;
}

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$query = "SELECT rewards FROM gozoop_users WHERE username = '$loggedIn_user'";
$data = mysqli_query($db, $query);
$result = mysqli_fetch_assoc($data);

$previous_rewards = $result['rewards'];

$totalRewards = $rewardPoints + $previous_rewards;

$sql = "UPDATE gozoop_users SET rewards='$totalRewards' WHERE username = '$loggedIn_user'";

if ($db->query($sql) === TRUE) {
    $errorMessage = "Record updated successfully";
} else {
    $errorMessage = "Error updating record: " . $db->error;
}

$db->close();

$output["username"] = $loggedIn_user;
$output["error"] = $error;
$output["errorCode"] = $errorCode;
$output["errorMessage"] = $errorMessage;
$output["totalRewards"] = $totalRewards;
echo json_encode($output);

?>