<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
  die();
}

$id_ekskul = $_SESSION['id_ekskul'];
$id_jadwal = $_GET['id_jadwal'];
$id_presensi = $_GET['id_presensi'];

$query_user = "SELECT *
FROM tb_anggota
-- INNER JOIN tb_ekskul ON tb_anggota.id_ekskul = tb_ekskul.id_ekskul
-- WHERE tb_anggota.id_ekskul = $id_ekskul
ORDER BY nama_anggota ASC";

$result_user = $conn->query($query_user);

if (isset($_POST['kirim'])) {
  $id_ekskul_login = $row_user['id_ekskul'];
  $id_anggota = $_POST['id_anggota'];
  $id_jadwal_view = $id_jadwal;
  $kehadiran = $_POST['kehadiran'];

  $query_create_presensi = mysqli_query($conn, "INSERT INTO tb_presensi (id_anggota, id_jadwal, id_ekskul, kehadiran) VALUES ('$id_anggota', '$id_jadwal_view, $id_ekskul_login, '$kehadiran')");

  if ($query_create_presensi === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"../../admin/presensi/index.php\")
            </script>";
  } else {
    echo "Error: " . $query_create_presensi . "<br>" . $conn->error;
  }
}
$conn->close();
?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Presensi Anggota</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Presensi</li>
              <li class="breadcrumb-item active">Create Presensi Anggota</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Anggota</label>
                    <select name="id_anggota" class="form-control" id="exampleInputEmail1" placeholder="Atur Tanggal">
                      <?php
                      while ($row_user = $result_user->fetch_assoc()) {
                        echo "<option value='" . $row_user['id_anggota'] . "'>" . $row_user['nama_anggota'] . "</option>";
                      }
                      ?>
                  </div>
                  <div class="form-group  ">
                    <label for="exampleInputPassword2">Kehadiran</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="kehadiran" id="Hadir" value="Hadir">
                      <label class="form-check-label" for="Hadir">Hadir</label>
                      <br>
                      <input class="form-check-input" type="radio" name="kehadiran" id="Tidak Hadir" value="Tidak Hadir">
                      <label class="form-check-label" for="Tidak Hadir">Tidak Hadir</label>
                    </div>
                    <div class="form-check">
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
