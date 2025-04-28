<?php
    session_start();

    $searched_semester = $_POST['semester'];
    $sic = $_SESSION['sic'];
    $response = [];

    require_once "functions.php";

    $student_semester = getSemester($sic)->fetch_assoc();

if ($student_semester['semester'] != $searched_semester) {
    $response = [
        "status" => "false",
        "data" => "",
        "msg" => "Your semester is not matched with the semester you searched for!!!"
    ];
} else {
    // Getting all subject list of the semester that student entered in the search bar
    $subjects = getSubjects($searched_semester);
    
    // Deatils about how I get exam registration last date
    // getExamRegistrationLastDate() gives mysqli_result Object ( [current_field] => 0 [field_count] => 1 [lengths] => [num_rows] => 1 [type] => 0 ) []
    // getExamRegistrationLastDate()->fetch_assoc() gives Array ( [COLUMN_DEFAULT] => '2025-09-16' ) []
    // getExamRegistrationLastDate()->fetch_assoc()['COLUMN_DEFAULT'] gives '2025-09-16'[]
    // trim(getExamRegistrationLastDate()->fetch_assoc()['COLUMN_DEFAULT'], "'") gives 2025-09-16[]
    
    // Getting exam registration last date
    $registration_last_date = trim(getExamRegistrationLastDate()->fetch_assoc()['COLUMN_DEFAULT'], "'");
    $date = new DateTime($registration_last_date);
    $registration_last_date = $date->format('d/m/Y'); 
    // print_r($registration_last_date);

    foreach ($subjects as $subject) {
        $newArray[] = array_merge($subject, ["amount" => 0, "registration_last_date" => $registration_last_date, "is_checked" => "false"]);
    }
    $response = array_merge($response, $newArray);

    // Check dues of the student
    $studentDue = getStudentDue($sic)->fetch_assoc()['amount'];
    // print_r($studentDue);

    $response = ['subject_list' => $response, 'student_due' => $studentDue];
    // print_r($response);
    
}

echo json_encode($response);
?>