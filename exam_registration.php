<?php
    session_start();
    header('Content-Type: application/json');
    
    $sic = $_SESSION['sic'];

    // Getting the stringfy data
    $examRegistrationData = json_encode(json_decode(file_get_contents('php://input'), true));

    $response = [];

    require_once "functions.php";

    // Check if the student is already registerd
    $is_registred = isStudnetRegistered($sic);
    
    if($is_registred) {
        $response = [
            "status" => "fail",
            "data" => "",
            "msg" => "Your exam registration is already done. So you can't register again!!!"
        ];
    } else {
        // add examRegistration data into exam_registration table
        $res = addExamRegistrationData($sic, $examRegistrationData);

        if($res) {
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