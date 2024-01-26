<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  die();
}

if (isset($_POST['update'])) {
  $id_anggota = $_GET['id_anggota'];

  $nama_anggota = $_POST['nama_anggota'];
  $kelas = $_POST['kelas'];

  $query_update_anggota = mysqli_query($conn, "UPDATE tb_anggota SET nama_anggota='$nama_anggota', kelas='$kelas' WHERE id_anggota=$id_anggota");

  if ($query_update_anggota === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"index.php?page=anggota\")
            </script>";
  } else {
    echo "Error: " . $query_update_anggota . "<br>" . $conn->error;
  }
}
$conn->close();
?>

<?php
include '../conf/conn.php';

$id_anggota = $_GET['id_anggota'];

$result = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota=$id_anggota");

while ($row = mysqli_fetch_array($result)) {
  $nama_anggota = $row['nama_anggota'];
  $kelas = $row['kelas'];
}
?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Anggota</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Anggota</li>
              <li class="breadcrumb-item active">Edit Anggota</li>
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
                <h3 class="card-title">Edit Data Anggota</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="text" name="nama_anggota" class="form-control" id="exampleInputEmail1" value="<?= $nama_anggota;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kelas</label>
                    <input type="text" name="kelas" class="form-control" id="exampleInputPassword1" value="<?= $kelas;?>" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="index.php?page=anggota" class="btn btn-danger" id="btn">Kembali</a>
                  <button type="submit" name="update" class=" btn btn-warning">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</div>
