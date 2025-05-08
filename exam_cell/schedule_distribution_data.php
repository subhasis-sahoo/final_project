<?php

require_once "functions.php";

$year = $_POST['year'];
$month = date('m', strtotime("1 " . $_POST['month'])); // Converts "March" to "03"
$startDay = str_pad($_POST['start_day'], 2, '0', STR_PAD_LEFT);
$endDay = str_pad($_POST['end_day'], 2, '0', STR_PAD_LEFT);

$response = [];

if ((int) $startDay > (int) $endDay) {
    $response = [
        "status" => "fail",
        "data" => "",
        "msg" => "Start date must be smaller than end date."
    ];
} else {
    $startDate = date("Y-m-d", strtotime("$year-$month-$startDay"));
    $endDate = date("Y-m-d", strtotime("$year-$month-$endDay"));

    $scheduleRegistrationDeadline = scheduleDistributionDeadline($startDate, $endDate);

    if ($scheduleRegistrationDeadline) {
        $response = [
            "status" => "success",
            "data" => "",
            "msg" => "Deadline for admit card distribution is scheduled successfully."
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