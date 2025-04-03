<?php
    require_once "dbconnect.php";

    // Get student's semester from the students table
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

    // Getting all the subjects list from the subjects table according to the semester
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

?>