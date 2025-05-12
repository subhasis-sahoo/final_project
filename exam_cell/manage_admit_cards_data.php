<?php
    require_once "functions.php";


    $admitCardID = json_decode(file_get_contents('php://input'), true)['admitCardID'];
    // print_r($sic);
    $examCellAapproval = "completed";

    $response = [];

    $res = allowToDownlaodAdmitCard($examCellAapproval, $admitCardID);
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