<?php
require_once "functions.php";
$sic = $_POST['sic'];
$is_approve = cheack_admitcard_eligibility($sic)->fetch_assoc()['is_approve'];

// print_r($is_approve);
if (strcmp($is_approve, "completed") === 0) {
  $response = [
    "status" => "success",
    "data" => "",
    "msg" => "Your can download your admitcard"
  ];
} else {
  $response = [
    "status" => "fail",
    "data" => "",
    "msg" => "You are not eligible to download admit card !!!!"
  ];
}

// $response = [];

echo json_encode($response);