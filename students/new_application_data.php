<?php
require_once "functions.php";

$name = $_POST['name'];
$sic = $_POST['sic'];
$applyDate = $_POST['apply_date'];
$reason = $_POST['reason'];
$statusLog = $_POST['statusLog'];
$document = $_FILES['documents'];

$response = [];

$sic = getStudentsDetails($sic)->fetch_assoc()['sic'];
$studentName = getStudentsDetails($sic)->fetch_assoc()['full_name'];
// print_r($studentName);
$program = getStudentsDetails($sic)->fetch_assoc()['program'];

// Generate a patterened applicationId
$applicationID = generateApplicationID($sic, $studentName, $program);


$document_new_name = time() . "--" . $document['name'];
$document_path = "../public/application_documents/" . $document_new_name;


if (move_uploaded_file($document['tmp_name'], $document_path)) {
    $res = submitApplication($applicationID, $sic, $name, $document_path, $reason, $statusLog, $applyDate);
    if($res) {
        $response = [
            "status" => "success",
            "data" => "",
            "msg" => "Application submited successfully."
        ];
    } else {
        $response = [
            "status" => "fail",
            "data" => "",
            "msg" => "Internal server error!!!"
        ];
    }
} else {
    $response = [
        "status" => "fail",
        "data" => "",
        "msg" => "Error while uploading document!!!"
    ];
}

echo json_encode($response)
?>