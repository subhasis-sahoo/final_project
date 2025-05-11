<?php

require_once "../dbconnect.php";

// Returns all applications from applications table
function getAllApplicationsAccordingToRole($role)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM applications WHERE current_stage = ? AND is_checked = 0";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $role);
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

// Return staff details from users table
function getStaffRole($sic)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM users WHERE u_sic = ?";
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

// Returns all applications details from applications table
function getApplicationDeatils($applicationId)
{
    $conn = getConnection();

    try {
        $qry = "SELECT * FROM applications WHERE application_id = ?";
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

// Update applications status in applications table
function updateApplicationStatus($statusLog, $applicationID)
{
    $conn = getConnection();

    try {
        $qry = "UPDATE applications SET status_logs = ?, is_checked = 1 WHERE application_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $statusLog, $applicationID);
        $result = $stmt->execute();

        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}

// Update account section approval status in exam_registrations table
function updateExamRegistrationApprovalStatus($accountsSectionApproval, $studentSic)
{
    $conn = getConnection();

    try {
        $qry = "UPDATE exam_registrations SET accounts_section_approval = ? WHERE student_sic = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $accountsSectionApproval, $studentSic);
        $result = $stmt->execute();

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

?>