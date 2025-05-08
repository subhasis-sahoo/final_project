<?php
$HOST = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DB_NAME = "project_x";

$conn = new mysqli($HOST, $USERNAME, $PASSWORD, $DB_NAME);

if ($conn->connect_error) {
  die($conn->connect_error);
}
?>