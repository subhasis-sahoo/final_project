<?php
    session_start();
    
    $sic = $_SESSION['sic'];

    // Getting the stringfy data
    $examRegistrationData = json_encode(json_decode(file_get_contents('php://input'), true));
    $data = json_decode(file_get_contents('php://input'), true);
    // print_r($data['student_due']);

    $data['student_due'] == 0 ? $accountsSectionApproval = 'completed' : $accountsSectionApproval = 'pending';
    // echo $accountsSectionApproval;

    $response = [];

    require_once "functions.php";
    require_once "../generate_random_string.php";

    // Function to generate random string for IDs
    $registrationID = generateSecureRandomString(8);
    // $admitCardID = generateSecureRandomString(8);

    // Check if the student is already registerd
    $is_registred = isStudnetRegistered($sic);

    // Get today's date in 23 Jan, 2025 formate
    $applyDate = date('d M, Y');
    
    if($is_registred) {
        $response = [
            "status" => "fail",
            "data" => "",
            "msg" => "Your exam registration is already done. So you can't register again!!!"
        ];
    } else {
        // add examRegistration data into exam_registration table
        $res1 = addExamRegistrationData($registrationID, $sic, $accountsSectionApproval, $examRegistrationData, $applyDate);
        // $res2 = addAdmitCardDetails($admitCardID, $registrationID);

        if($res1) {
            $response = [
                "status" => "success",
                "data" => "",
                "msg" => "Your exam registration is successfully complete."
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
?>