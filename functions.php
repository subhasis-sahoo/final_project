<?php
    require_once "dbconnect.php";

    function getSubjects($semester) {
        $conn = getConnection();
        // print_r($conn);

        try {
            $qry = "SELECT subject_code, subject_name FROM subjects WHERE semester=?";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("i", $semester);
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