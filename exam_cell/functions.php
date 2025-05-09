<?php
    require_once "../dbconnect.php";

    // Set start date and end date for exam registration
    function scheduleRegistrationDeadline($startDate, $endDate) {
        $conn = getConnection();

        try {
            $qry = "ALTER TABLE exam_registrations MODIFY registration_start_date DATE DEFAULT ?, MODIFY registration_end_date DATE DEFAULT ?";
            $stmt = $conn-> prepare($qry);
            $stmt->bind_param("ss", $startDate, $endDate);
            $res = $stmt->execute();

            return $res;
        } catch(Exception $e) {
            $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Set start date and end date for admit card distribution
    function scheduleDistributionDeadline($startDate, $endDate) {
        $conn = getConnection();

        try {
            $qry = "ALTER TABLE admit_cards MODIFY distribution_start_date DATE DEFAULT ?, MODIFY distribution_end_date DATE DEFAULT ?";
            $stmt = $conn-> prepare($qry);
            $stmt->bind_param("ss", $startDate, $endDate);
            $res = $stmt->execute();

            return $res;
        } catch(Exception $e) {
            $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Returns all student's exam registration all details form exam_registration table
    function getAllExamRegistrationDetails() {
        $conn = getConnection();

        try {
            $qry = "SELECT * FROM exam_registrations WHERE is_approved = 'pending'";
            $stmt = $conn->prepare($qry);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
            
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Retruns a student name using sic from students table
    function getStudentName($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT full_name FROM students WHERE sic = ?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("s", $sic);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
            
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Returns detils of a student form students table
    function getStudentsDetails($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT * FROM students WHERE sic=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("s", $sic);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
            
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Returns student's exam registration all details form exam_registration table
    function getExamRegistrationDetails($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT * FROM exam_registrations WHERE student_sic=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("s", $sic);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;
            
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // To set is_approved status and approval_date in exam_registrations table
    function completeExamRegistration($is_approved, $approval_date, $sic) {
        $conn = getConnection();

        try {
            $qry = "UPDATE exam_registrations SET is_approved = ?, approval_date = ? WHERE student_sic = ?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("sss", $is_approved, $approval_date, $sic);
            $res = $stmt->execute();

            return $res;
            
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

?>