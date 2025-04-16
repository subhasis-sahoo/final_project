<?php
    require_once "../dbconnect.php";

    // Return student's semester from the students table
    function getSemester($sic) {
        $conn = getConnection();
        // print_r($conn);

        try {
            $qry = "SELECT semester FROM students WHERE sic=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("s", $sic);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;

        } catch(Exception $e) {
            $e->getMessage();
        } finally {
            $conn->close();
        }

    }

    // Return all the subjects list from the subjects table according to the semester
    function getSubjects($searched_semester) {
        $conn = getConnection();

        try {
            $qry = "SELECT subject_code, subject_name FROM subjects WHERE semester=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("i", $searched_semester);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result;

        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // Return exam registration last date from the exam_registrations table
    function getExamRegistrationLastDate() {
        $conn = getConnection();

        try {
            $qry = "SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'project_x' AND TABLE_NAME = 'exam_registrations' AND COLUMN_NAME = 'registration_end_date'";
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

    // Returns student's registred subjects list and dues data from exam_registration table
    function getRegistrationData($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT registration_data FROM exam_registrations WHERE student_sic=?";
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

    // Return due of the student from student_dues table
    function getStudentDue($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT amount FROM student_dues WHERE student_sic=?";
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

    // Returns true if the student is already registerd for the exam else flase
    function isStudnetRegistered($sic) {
        $conn = getConnection();

        try {
            $qry = "SELECT registration_id FROM exam_registrations WHERE student_sic=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("s", $sic);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        } finally {
            $conn->close();
        }
    }

    // add examRegistration data into exam_registration table
    function addExamRegistrationData($sic, $examRegistrationData) {
        $conn = getConnection();

        try {
            $qry = "INSERT INTO exam_registrations(student_sic, registration_data) VALUES(?, ?)";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("ss", $sic, $examRegistrationData);
            $result = $stmt->execute();

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
?>