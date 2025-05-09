<?php
    require_once "functions.php";


    $sic = json_decode(file_get_contents('php://input'), true)['sic'];
    // print_r($sic);
    $is_approved = "completed";
    $approval_date = date("Y-m-d");

    $response = [];

    $res = completeExamRegistration($is_approved, $approval_date, $sic);
    // echo $res;

    if($res) {
        $response = [
            "status" => "success",
            "data" => "",
            "msg" => "Exam registration is completed"
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