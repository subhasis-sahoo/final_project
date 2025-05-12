<?php
require_once "../dbconnect.php";
require_once "../generate_random_string.php";

// Funcation that generate admit cards for the exam registered students
function addAdmitCards()
{
    $deleteData = deleteTableData();

    if ($deleteData) {
        $res = '';
        $accountsSectionApproval = '';
        $deanApproval = '';
        $registredStudentsDetails = getAllApprovedExamRegistrationDetails();
        // print_r($registredStudentsDetails->num_rows);

        while ($data = $registredStudentsDetails->fetch_assoc()) {
            $sic = $data['student_sic'];
            $registrationID = $data['registration_id'];

            $studentDue = getStudentDue($sic)->fetch_assoc()['amount'];

            $studentAttendance = getStudentsDetails($sic)->fetch_assoc()['is_attendance_low'];

            $studentAttendance == 'yes' ? $deanApproval = 'pending' : $deanApproval = 'completed';

            if ($studentDue != 0) {
                $accountsSectionApproval = 'pending';
            } else {
                $accountsSectionApproval = 'completed';
            }

            // $deanApproval = 'pending';

            $admitCardID = generateSecureRandomString(8);

            // Add student data to admit_cards table
            $res = addAdmitCardDetails($admitCardID, $registrationID, $accountsSectionApproval, $deanApproval);
        }
        return $res;
    }
}

// add admit card details into admit_cards table
function addAdmitCardDetails($admitCardID, $registrationID, $accountsSectionApproval, $deanApproval)
{
    $conn = getConnection();

    try {
        $qry = "INSERT INTO admit_cards(admit_card_id, registration_id, accounts_section_approval, dean_approval) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssss", $admitCardID, $registrationID, $accountsSectionApproval, $deanApproval);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Return all admit card details into admit_cards table
function getAllAdmitCardData()
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM admit_cards WHERE exam_cell_approval = 'pending'";
        $stmt = $conn->prepare($qry);
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


// Delete all previous entries from admit_cards table
function deleteTableData()
{
    $conn = getConnection();

    try {
        $qry = "DELETE FROM admit_cards";
        $stmt = $conn->prepare($qry);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}


// Set start date and end date for exam registration
function scheduleRegistrationDeadline($startDate, $endDate)
{
    $conn = getConnection();

    try {
        $qry = "ALTER TABLE exam_registrations MODIFY registration_start_date DATE DEFAULT ?, MODIFY registration_end_date DATE DEFAULT ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $startDate, $endDate);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Set start date and end date for admit card distribution
function scheduleDistributionDeadline($startDate, $endDate)
{
    $conn = getConnection();

    try {
        $qry = "ALTER TABLE admit_cards MODIFY distribution_start_date DATE DEFAULT ?, MODIFY distribution_end_date DATE DEFAULT ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $startDate, $endDate);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Returns all student's exam registration all details form exam_registration table
function getAllExamRegistrationDetails()
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM exam_registrations WHERE is_approved = 'pending'";
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

// Returns all approved exam registration details form exam_registration table
function getAllApprovedExamRegistrationDetails()
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM exam_registrations WHERE is_approved = 'completed'";
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

// Retruns a student name using sic from students table
function getStudentName($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT full_name FROM students WHERE sic = ?";
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

// To set is_approved status and approval_date in exam_registrations table
function completeExamRegistration($is_approved, $approval_date, $sic)
{
    $conn = getConnection();

    try {
        $qry = "UPDATE exam_registrations SET is_approved = ?, approval_date = ? WHERE student_sic = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sss", $is_approved, $approval_date, $sic);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}


// Retruns a studnet's name and sic using the admit registration id
function getStudentNameAndSIC($registraionID)
{
    $conn = getConnection();
    // print_r($conn);

    try {
        $qry = "SELECT s.full_name AS student_name, ex.student_sic AS student_sic FROM admit_cards AS ac JOIN exam_registrations AS ex ON ac.registration_id = ex.registration_id JOIN students AS s ON ex.student_sic = s.sic WHERE ac.registration_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $registraionID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    } catch (Exception $e) {
        $e->getMessage();
    } finally {
        $conn->close();
    }
}


// To set exam_cell_approval status in admit_cards table
function allowToDownlaodAdmitCard($examCellAapproval, $admitCardID)
{
    $conn = getConnection();

    try {
        $qry = "UPDATE admit_cards SET exam_cell_approval = ? WHERE admit_card_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $examCellAapproval, $admitCardID);
        $res = $stmt->execute();

        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

function add_message($sender_role, $receiver, $message, $date, $new_name)
{
    $conn = getConnection();


    try {
        $qry = "INSERT INTO dms (sender_role,	receiver,	message	,doc,	date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($qry);
        // $departments = json_encode($receiver);
        $stmt->bind_param("sssss", $sender_role, $receiver, $message, $new_name, $date);
        $res = $stmt->execute();
        return $res;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } finally {
        $conn->close();
    }
}
