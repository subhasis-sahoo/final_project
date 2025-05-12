<?php
require_once "../dbconnect.php";

// Returns a patterened random string for application ID
function generateApplicationID($sic, $studentName, $program)
{
    // First 2 letters of SIC
    $sicPrefix = substr($sic, 0, 2);

    // Program in uppercase
    $branch = strtoupper($program);

    // Split the name by space and take first letter of first and last word
    $nameParts = preg_split('/\s+/', trim($studentName));
    $firstInitial = strtoupper(substr($nameParts[0], 0, 1));
    $lastInitial = strtoupper(substr(end($nameParts), 0, 1));

    // Generate secure 4-digit random number
    $randomNumber = random_int(1000, 9999);

    // Construct the ID
    return $sicPrefix . $branch . $firstInitial . $lastInitial . $randomNumber;
}


// Retruns a studnet's faculty advisor name using their sic
function getFAName($sic)
{
    $conn = getConnection();
    // print_r($conn);

    try {
        $qry = "SELECT u.full_name AS faculty_name FROM students s JOIN faculty_advisors AS fa ON s.sic = fa.student_sic JOIN users AS u ON fa.user_sic = u.u_sic WHERE s.sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Return student's semester from the students table
function getSemester($sic)
{
    $conn = getConnection();
    // print_r($conn);

    try {
        $qry = "SELECT semester FROM students WHERE sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Return all the subjects list from the subjects table according to the semester
function getSubjects($searched_semester)
{
    $conn = getConnection();

    try {
        $qry = "SELECT subject_code, subject_name FROM subjects WHERE semester=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("i", $searched_semester);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Return exam registration last date from the exam_registrations table
function getExamRegistrationLastDate()
{
    $conn = getConnection();

    try {
        $qry = "SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'project_x' AND TABLE_NAME = 'exam_registrations' AND COLUMN_NAME = 'registration_end_date'";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns student's exam registration all details form exam_registration table
function getExamRegistrationDetails($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM exam_registrations WHERE student_sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Return due of the student from student_dues table
function getStudentDue($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT amount FROM student_dues WHERE student_sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns true if the student is already registerd for the exam else flase
function isStudnetRegistered($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT registration_id FROM exam_registrations WHERE student_sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// add examRegistration data into exam_registration table
function addExamRegistrationData($registrationID, $sic, $accountsSectionApproval, $examRegistrationData, $applyDate)
{
    $conn = getConnection();

    try {
        $qry = "INSERT INTO exam_registrations(registration_id, student_sic, accounts_section_approval, registration_data, apply_date) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sssss", $registrationID, $sic, $accountsSectionApproval, $examRegistrationData, $applyDate);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// add admit card details into admit_cards table
function addAdmitCardDetails($admitCardID, $registrationID)
{
    $conn = getConnection();

    try {
        $qry = "INSERT INTO admit_cards(admit_card_id, registration_id ) VALUES(?, ?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $admitCardID, $registrationID);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns detils of a student form students table
function getStudentsDetails($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM students WHERE sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns student's accounts details form student_dues table
function getStudentAccountsDetails($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT account_details FROM student_dues WHERE student_sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}



//Ranjeet's functions

// Function to add an application details to the applications table
function submitApplication($applicationID, $sic, $name, $document_path, $reason, $statusLog, $currentStage, $applyDate)
{
    $conn = getConnection();

    try {
        $qry = "INSERT INTO applications(application_id, student_sic, student_name, supporting_documents, application_reason, status_logs, current_stage, apply_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssssssss", $applicationID, $sic, $name, $document_path, $reason, $statusLog, $currentStage, $applyDate);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns a specific student's applications from applications table
function getAllApplications($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM applications WHERE student_sic = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}


// Returns all applications from applications table
function getApplicationStatus($applicationId)
{
    $conn = getConnection();

    try {
        $qry = "SELECT 	status_logs FROM applications WHERE application_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $applicationId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}


function cheack_admitcard_eligibility($sic)
{
    $conn = getConnection();
    // print_r($conn);

    try {
        $qry = "SELECT ad.exam_cell_approval AS is_approve FROM admit_cards ad JOIN exam_registrations AS er ON er.registration_id = ad.registration_id  WHERE er.student_sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}


function getStudentsDetails_by_sic($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM students WHERE sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

function fetch_messages()
{
    $conn = getConnection();
    try {

        $qry = "SELECT * FROM dms";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } finally {
        $conn->close();
    }
}