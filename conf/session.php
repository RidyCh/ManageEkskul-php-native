<?php
session_start();

if (!isset($_SESSION['id_user'])) {
  echo "<script type = \"text/javascript\">
  window.location = (\"../login.php\");
  </script>";
}
?>
