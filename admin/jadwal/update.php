<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
  die();
}

if (isset($_POST['update'])) {
  $id_jadwal = $_GET['id_jadwal'];

  $tanggal_ekskul = $_POST['tanggal_ekskul'];
  $lokasi = $_POST['lokasi'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];

  $query_update_jadwal = mysqli_query($conn, "UPDATE tb_jadwal SET tanggal_ekskul='$tanggal_ekskul', lokasi='$lokasi', jam_mulai='$jam_mulai', jam_selesai='$jam_selesai' WHERE id_jadwal=$id_jadwal");

  if ($query_update_jadwal === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"index.php?page=jadwal\")
            </script>";
  } else {
    echo "Error: " . $query_update_jadwal . "<br>" . $conn->error;
  }
}
$conn->close();
?>

<?php
include '../conf/conn.php';

$id_jadwal = $_GET['id_jadwal'];

$result = mysqli_query($conn, "SELECT * FROM tb_jadwal WHERE id_jadwal=$id_jadwal");

while ($row = mysqli_fetch_array($result)) {
  $tanggal_ekskul = $row['tanggal_ekskul'];
  $lokasi = $row['lokasi'];
  $jam_mulai = $row['jam_mulai'];
  $jam_selesai = $row['jam_selesai'];
}
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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Jadwal</li>
              <li class="breadcrumb-item active">Edit Jadwal</li>
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
            <div class="card card-purple">
              <div class="card-header">
                <h3 class="card-title">Edit Data Jadwal</h3>
              </div>
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="ekskul_role" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Ekskul</label>
                    <input type="date" name="tanggal_ekskul" class="form-control" id="exampleInputEmail1" value="<?php echo $tanggal_ekskul;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="exampleInputPassword1" value="<?php echo $lokasi;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" id="exampleInputPassword2" value="<?php echo $jam_mulai;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword3">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" id="exampleInputPassword3" value="<?php echo $jam_selesai;?>" required>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="index.php?page=jadwal" class="btn btn-danger" id="btn">Kembali</a>
                  <button type="submit" name="update" class="btn btn-warning">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</div>
