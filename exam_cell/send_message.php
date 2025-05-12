<?php
require_once "functions.php";
$date = $_POST['apply_date'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];

$response = [];
$sender_role = "examination cell";



// echo $date . "" . $receiver . "" . $message . "" . $doc;
$new_name = "";
if ($_FILES['documents']['name'] != "") {
  $document = $_FILES['documents'];
  $new_name = time() . "-" . $document['name'];
  $upload_path = "../public/dms_document/" . $new_name;
  move_uploaded_file($document['tmp_name'], $upload_path);
  // echo $new_name;
} else {
  // echo "no document attached";
}

$res = add_message($sender_role, $receiver, $message, $date, $new_name);
if ($res) {
  // echo "hello";
  $response = [
    "status" => "success",
    "data" => "",
    "msg" => "sending the message"
  ];
} else {
  $response = [
    "status" => "fail",
    "data" => "",
    "msg" => "failed"
  ];
}

echo json_encode($response);