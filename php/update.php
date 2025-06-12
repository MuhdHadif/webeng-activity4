<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once("dbconnect.php");

$id = $_POST['id'];
$name = $_POST["name"];
$email = $_POST["email"];
$race = $_POST["race"];
$gender = $_POST["gender"];

$sql = "UPDATE `student` SET `name` = '$name', `email` = '$email', `race` = '$race', `gender` = '$gender' WHERE `id` = $id";
$result = $conn->query($sql);

try {
	if ($conn->query($sql) === TRUE) {
		$response = array('status' => 'success', 'data' => $sql);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed_query', 'data' => $sql);
		sendJsonResponse($response);
	}
}
catch(Exception $e) {
    $response = array('status' => 'failed_exception', 'data' => null);
    sendJsonResponse($response);
    die;
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}