<?php
require_once "dbconnect.php";


function validateUser($username, $password)
{
    $conn = getConnection();

    try {
        $sql = "SELECT * FROM users WHERE u_sic = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return ["status" => "error", "message" => "SQL prepare error (faculty): " . $conn->error];
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            return ["status" => "error", "message" => "SQL execute error (faculty): " . $stmt->error];
        }

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        // print_r($user);

        if ($user) {
            error_log("Faculty User found, checking password");
            // $passwordMatch = password_verify($password, $user['password']);
            $passwordMatch = $password == $user['password'] ? true : false;
            error_log("Password match: " . ($passwordMatch ? "Yes" : "No"));
            if ($passwordMatch) {
                $stmt->close();
                return [
                    "status" => "success",
                    "message" => "Login successful",
                    "user_id" => $user['u_sic'],
                    "user_type" => $user['role'],
                    "user_photo" => $user['profile_photo_path']
                ];
            }
        }

        $stmt->close();

        // Check in students table
        $sql = "SELECT * FROM students WHERE sic = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return ["status" => "error", "message" => "SQL prepare error (student): " . $conn->error];
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            return ["status" => "error", "message" => "SQL execute error (student): " . $stmt->error];
        }

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // print_r($user);

        if ($user) {
            // echo "Inside student";
            error_log("Student User found, checking password");
            echo $password . $user['password'];
            // $passwordMatch = password_verify($password, $user['password']);
            $passwordMatch = $password == $user['password'] ? true : false;
            print_r(!$passwordMatch);
            error_log("Password match: " . ($passwordMatch ? "Yes" : "No"));
            if ($passwordMatch) {
                // echo "Inside password match";
                $stmt->close();
                return [
                    "status" => "success",
                    "message" => "Login successful",
                    "user_id" => $user['sic'],
                    "user_type" => "student",
                    "user_photo" => $user['profile_photo_path'],
                    "user_name" => $user['full_name']
                ];
            }
            // echo "Outside password match";
        }

        $stmt->close();
    } catch (Exception $e) {
        $e->getMessage();
    } {
        $conn->close();
    }


    // If not matches with any field return error message
    return ["status" => "error", "message" => "Invalid credentials"];
}


function  getUserData($sic)
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