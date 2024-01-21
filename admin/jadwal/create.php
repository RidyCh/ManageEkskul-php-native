<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
  die();
}

$id_user_login = $_SESSION['id_user'];
$id_ekskul_login = $_SESSION['id_ekskul'];

$query_anggota = mysqli_query($conn, "SELECT *
FROM tb_anggota
INNER JOIN tb_presensi ON tb_presensi.id_ekskul = tb_anggota.id_ekskul
Where tb_anggota.id_ekskul = '$_SESSION[id_ekskul]'");

$row_anggota = $query_anggota->fetch_assoc();

if (isset($_POST['kirim'])) {
  $id_ekskul = $id_ekskul_login;
  $tanggal_ekskul = $_POST['tanggal_ekskul'];
  $lokasi = $_POST['lokasi'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];

  $query_create_jadwal = mysqli_query($conn, "INSERT INTO tb_jadwal (tanggal_ekskul, lokasi, id_ekskul, jam_mulai, jam_selesai) VALUES ('$tanggal_ekskul', '$lokasi', $id_ekskul, '$jam_mulai', '$jam_selesai')");

  if ($query_create_jadwal === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"/admin/jadwal/index.php\")
            </script>";
  } else {
    echo "Error: " . $query_create_jadwal . "<br>" . $conn->error;
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
            <h1>Data Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Jadwal</li>
              <li class="breadcrumb-item active">Create Jadwal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Ekskul</label>
                    <input type="date" name="tanggal_ekskul" class="form-control" id="exampleInputEmail1" placeholder="Atur Tanggal">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="exampleInputPassword1" placeholder="lokasi">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" id="exampleInputPassword2" placeholder="Jam Mulai">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" id="exampleInputPassword2" placeholder="Jam Selesai">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</div>
