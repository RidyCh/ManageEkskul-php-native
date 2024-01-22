<?php
// include '../../conf/conn.php';

$id_jadwal = $_GET['id_jadwal'];

$result = mysqli_query($conn, "DELETE FROM tb_jadwal WHERE id_jadwal=$id_jadwal");

if ($result === TRUE) {
  echo "<script type = \"text/javascript\">
          window.location = (\"../../admin/jadwal/index.php\")
          </script>";
} else {
  echo "Error: " . $result . "<br>" . $conn->error;
}
