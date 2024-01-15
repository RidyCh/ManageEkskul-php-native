<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
  die();
}

// Mendapatkan id_user dari user yang sedang login
$id_user_login = $_SESSION['id_user'];

// Query untuk mendapatkan id_ekskul user yang sedang login
$query_user = "SELECT id_ekskul FROM tb_user WHERE id_user = $id_user_login";
$result_user = $conn->query($query_user);
$row_user = $result_user->fetch_assoc();

if (isset($_POST['kirim'])) {
  $id_ekskul_login = $row_user['id_ekskul'];
  $nama_anggota = $_POST['nama_anggota'];
  $kelas = $_POST['kelas'];

  $query_create_anggota = mysqli_query($conn, "INSERT INTO tb_anggota (nama_anggota, kelas, id_ekskul) VALUES ('$nama_anggota', '$kelas', $id_ekskul_login)");

  if ($query_create_anggota === TRUE) {
    echo "<script type = \"text/javascript\">
            window.location = (\"../../admin/anggota/index.php\")
            </script>";
  } else {
    echo "Error: " . $query_create_anggota . "<br>" . $conn->error;
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
            <h1>Data Anggota</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Anggota</li>
              <li class="breadcrumb-item active">Create Anggota</li>
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
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="text" name="nama_anggota" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kelas</label>
                    <input type="text" name="kelas" class="form-control" id="exampleInputPassword1" placeholder="Kelas" required>
                  </div>
                </div>
                <!-- /.card-body -->

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
