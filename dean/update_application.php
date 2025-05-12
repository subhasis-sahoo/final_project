<?php
// Getting the stringfy data
// $applicationData = json_encode(json_decode(file_get_contents('php://input'), true));
// echo $applicationData;

$applicationID = json_decode(file_get_contents('php://input'), true)['applicationId'];
// print_r($applicationID);
$statusLog = json_encode(json_decode(file_get_contents('php://input'), true)['statusLog']);
// print_r($statusLog);
$status = json_decode(file_get_contents('php://input'), true)['status'];
// print_r($status);

$response = [];

require_once "functions.php";
$studentSic = getApplicationDeatils($applicationID)->fetch_assoc()['student_sic'];
// $applicationReason = getApplicationDeatils($applicationID)->fetch_assoc()['application_reason'];
// // print_r($applicationReason);


$res1 = 1;
// if($status == 'Approve' && $applicationReason == 'Request for Exam Registration (Unpaid Dues Issue)') {
//     // echo "Entered";
//     $accountsSectionApproval = 'Completed';
//     $res2 = updateExamRegistrationApprovalStatus($accountsSectionApproval, $studentSic);
// }

// if($status == 'Approve' && $applicationReason == 'Request For Admit card (Unpaid Dues Issue)') {
//     $accountsSectionApproval = 'Completed';
//     $res2 = updateAdmitCardApprovalStatus($accountsSectionApproval, $studentSic);
// }

$currentStage = 'accounts section';
$isChecked = 0;

if ($status == 'Reject') {
    // echo "entered";
    $currentStage = 'dean';
    $isChecked = 1;
}

if ($status == 'Approve') {
    $deanApproval = 'Completed';
    $studentAdmitCardID = getStudentAdmitCardID($studentSic)->fetch_assoc()['admit_card_id'];
    // print_r($studentAdmitCardID);
    $res1 = updateAdmitCardApprovalStatus($deanApproval, $studentAdmitCardID);
}


if ($res1) {
    $res2 = updateApplicationStatus($statusLog, $currentStage, $isChecked, $applicationID);

    if ($res1 && $res2) {
        $response = [
            "status" => "success",
            "data" => "",
            "msg" => "Application updated successfully."
        ];
    } else {
        $response = [
            "status" => "fail",
            "data" => "",
            "msg" => "Internal server error!!!"
        ];
    }
}


echo json_encode($response);
