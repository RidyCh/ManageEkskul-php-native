<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
}

// Mendapatkan id_user dari user yang sedang login
$id_user_login = $_SESSION['id_user'];

// Query untuk mendapatkan id_ekskul user yang sedang login
$query_user = "SELECT id_ekskul FROM tb_user WHERE id_user = $id_user_login";
$result_user = $conn->query($query_user);
$row_user = $result_user->fetch_assoc();

if (isset($_POST['kirim'])) {
  $id_ekskul_login = $row_user['id_ekskul'];
  $tanggal_ekskul = $_POST['tanggal_ekskul'];
  $lokasi = $_POST['lokasi'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  $status = $_POST['status'];

  $query_create_jadwal = mysqli_query($conn, "INSERT INTO tb_jadwal (tanggal_ekskul, lokasi, id_ekskul, jam_mulai, jam_selesai, status) VALUES ('$tanggal_ekskul', '$lokasi', $id_ekskul_login, '$jam_mulai', '$jam_selesai', '$status')");

  if ($query_create_jadwal === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"../../ekskul/admin/jadwal/index.php\")
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
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Anggota</label>
                    <select name="id_anggota" class="form-control" id="exampleInputEmail1" placeholder="Atur Tanggal">
                      <option value="1">1</option>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Kehadiran</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="kehadiran" id="Hadir" value="Hadir">
                      <label class="form-check-label" for="Hadir">Hadir</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="kehadiran" id="Tidak Hadir" value="Tidak Hadir">
                      <label class="form-check-label" for="Tidak Hadir">Tidak Hadir</label>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
