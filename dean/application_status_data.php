<?php
require_once "functions.php";

$applicationId = json_decode(file_get_contents('php://input'), true)['applicationId'];

$response = [];

$status = getApplicationStatus($applicationId)->fetch_assoc()['status_logs'];
// print_r($status);

$formatedStatus = json_decode($status, true);
// print_r($formatedStatus);

if($status) {
    $response = [
        "status" => "success",
        "data" => $formatedStatus,
        "msg" => "Status fetched successfully"
    ];
} else {
    $response = [
        "status" => "fail",
        "data" => "",
        "msg" => "Internal server error!!!"
    ];
}

echo json_encode($response);
?>