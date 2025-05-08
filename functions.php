<?php
require_once "dbconnection.php";


//function for adding student application form into data base
function add_applications($sic, $name, $request_type, $new_name, $sts, $current_stage, $apply_date)
{
  global $conn;

  try {
    $qry = "INSERT INTO applications (student_sic, student_name, application_type, supporting_documents, status, current_stage, apply_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($qry);
    $statuss = json_encode($sts);
    $stmt->bind_param("sssssss", $sic, $name, $request_type, $new_name, $statuss, $current_stage, $apply_date);
    $res = $stmt->execute();
    return $res;
  } catch (Exception $ex) {
    echo $ex->getMessage();
    return false;
  }
}



//function for getting student name by sic from data base
function get_student_name($sic)
{
  global $conn;
  try {
    $qry = "SELECT full_name from students where sic=?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s", $sic);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
    // $conn->close();
  }
}



//getting all application of student by  admin 

function get_application_of_students($current_stage)
{
  global $conn;
  try {
    $qry = "select * from applications where current_stage=?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s", $current_stage);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  } catch (Exception $e) {
    $e->getMessage();
  } finally {
    // $con->close();
  }
}


//fetching all aplication submited by a student by sic
function get_application_submit_by_student($sic)
{
  global $conn;
  try {
    $qry = "select * from applications where student_sic=?";
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
    $e->getMessage();
  } finally {
    // $con->close();
  }
}



//function for chasnging status when account section allow application
function accountant_allow($aid)
{
  global $conn;
  try {
    $qry = "update applications set current_stage=?,status=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["approved by accounts", date("d-m-y h:i:s"), "marked at examination cell"];
    $status = json_encode($status);
    $stage = "examination cell";
    $stmt->bind_param("ssi", $stage, $status, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}



//function for chasnging status when account section reject application

function accountant_reject($aid)
{
  global $conn;
  try {
    $qry = "update applications set status=?,current_stage=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["reject by account", date("d-m-y h:i:s"), "reverted to student"];
    $status = json_encode($status);
    $stage = "student";
    $stmt->bind_param("ssi", $status, $stage, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}


//fa allow

function fa_allow($aid)
{
  global $conn;
  try {
    $qry = "update applications set current_stage=?,status=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["approved by fa", date("d-m-y h:i:s"), "pending at dean"];
    $status = json_encode($status);
    $stage = "dean";
    $stmt->bind_param("ssi", $stage, $status, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}


function fa_reject($aid)
{
  global $conn;
  try {
    $qry = "update applications set status=?,current_stage=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["reject by fa", date("d-m-y h:i:s"), "reverted to student"];
    $status = json_encode($status);
    $stage = "student";
    $stmt->bind_param("ssi", $status, $stage, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}

function dean_allow($aid)
{
  global $conn;
  try {
    $qry = "update applications set current_stage=?,status=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["approved by dean", date("d-m-y h:i:s"), "pending at accounts"];
    $status = json_encode($status);
    $stage = "accounts section";
    $stmt->bind_param("ssi", $stage, $status, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}

function dean_reject($aid)
{
  global $conn;
  try {
    $qry = "update applications set status=?,current_stage=? where application_id=?";
    $stmt = $conn->prepare($qry);
    $res = get_status($aid);
    if ($res) {
      $row = $res->fetch_assoc();
      $status = json_decode($row['status'], true); // decode JSON into PHP array
    }
    $status[] = ["reject by dean", date("d-m-y h:i:s"), "reverted to student"];
    $status = json_encode($status);
    $stage = "student";
    $stmt->bind_param("ssi", $status, $stage, $aid);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      return "success";
    }
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}

//function for counting no of application

function total_applications($stage)
{
  global $conn;
  try {
    $qry = "SELECT COUNT(*) AS total FROM applications WHERE current_stage=?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s", $stage);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
  } catch (Exception $ex) {
    $ex->getMessage();
  } finally {
  }
}




function get_status($id)
{
  global $conn;
  try {
    $qry = "select * from applications where application_id=?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  } catch (Exception $e) {
    $e->getMessage();
  } finally {
    // $con->close();
  }
}

// function add_status($val)
// {
//   global $conn;
//   try {
//     $qry = "update applications set status=? where application_id=?";
//     $stmt = $conn->prepare($qry);
//     // $status = "rejected";
//     $stmt->bind_param("si", $val, $aid);
//     $stmt->execute();
//     if ($stmt->affected_rows > 0) {
//       return "success";
//     }
//   } catch (Exception $ex) {
//     $ex->getMessage();
//   } finally {
//   }
// }