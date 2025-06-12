<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include_once("dbconnect.php");

$sql = "SELECT * FROM `student`";
$result = $conn->query($sql);

try{
    if ($result->num_rows > 0) {
        $sentArray = array();
        while ($row = $result->fetch_assoc()) {
            $sentArray[] = $row;
        }
        $response = array('status' => 'success', 'data' => $sentArray);
        sendJsonResponse($response);
    } else {
        $response = array('status'=> 'failed_query', 'data' => null);
        sendJsonResponse($response);
    }
} catch(Exception $e) {
    $response = array('status' => 'failed_exception', 'data' => null);
    sendJsonResponse($response);
    die;
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}