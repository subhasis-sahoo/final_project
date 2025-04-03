<?php
    // Set the content type to JSON
    // header('Content-Type: application/json');
    
    $semester = $_POST['semester'];

    require_once "functions.php";

    $subjects = getSubjects($semester);

    forEach($subjects as $sub) {
        print_r($sub);
    }
    // echo json_encode($subjects);
?>