<?php
    session_start();
    
    $searched_semester = $_POST['semester'];
    $sic = $_SESSION['sic'];
    $response = [];

    require_once "functions.php";

    $student_semester = getSemester($sic)->fetch_assoc();

    if($student_semester['semester'] != $searched_semester) {
        $response = [
            "status" => "false",
            "data" => "",
            "msg" => "Your semester is not matched with the semester you searched for!!!"
        ];
    } else {
        // Getting all subject list of the semester that student entered in the search bar
        $subjects = getSubjects($searched_semester);

        foreach($subjects as $subject) {
            $newArray[] = array_merge($subject, ["amount" => 0, "registration_date" => "16-9-2025", "isChecked" => "false"]);
        }
        $response = array_merge($response, $newArray);
    }
    
    echo json_encode($response);
?>