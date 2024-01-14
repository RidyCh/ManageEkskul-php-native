<?php
// include '../../conf/conn.php';

$id_anggota = $_GET['id_anggota'];

$result = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id_anggota=$id_anggota");

if ($result === TRUE) {
  echo "<script type = \"text/javascript\">
          window.location = (\"../../ekskul/admin/anggota/index.php\")
          </script>";
} else {
  echo "Error: " . $result . "<br>" . $conn->error;
}
?>
