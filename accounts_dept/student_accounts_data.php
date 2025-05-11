<?php
$studentSIC = $_POST['sic'];
$response = [];

require_once "functions.php";

$res = getStudentAccountsDetails($studentSIC)->fetch_assoc()['account_details'];

if ($res) {
    $accountsDetails = json_decode($res);
    $response = [
        "status" => 'success',
        "data" => $accountsDetails,
        "msg" => "Accounts details fetched successfully."
    ];
} else {
    $response = [
    "status" => 'fail',
    "data" => "",
    "msg" => "Internal server error!!!"
];
}

echo json_encode($response);
?>