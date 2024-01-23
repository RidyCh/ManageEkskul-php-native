<?php
// include '../../conf/conn.php';

$id_anggota = $_GET['id_anggota'];

$result = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id_anggota=$id_anggota");

if ($result === TRUE) {
  echo "<script type = \"text/javascript\">
          window.location = (\"index.php?page=anggota\")
          </script>";
} else {
  echo "Error: " . $result . "<br>" . $conn->error;
}

?>
