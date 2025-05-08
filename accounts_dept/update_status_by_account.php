<?php
$value = trim($_GET['value']);
$aid = $_GET['aid'];
require "../functions.php";
// echo $value;

if (strcmp($value, "allow") === 0) {
  $result = accountant_allow($aid);

?>

  <script>
    window.location.href = "get_applications.php"
  </script>
<?php
} else if (strcmp($value, "reject") === 0) {
  $result = accountant_reject($aid);

?>

  <script>
    window.location.href = "get_applications.php"
  </script>
<?php

} else {
  echo "error";
}