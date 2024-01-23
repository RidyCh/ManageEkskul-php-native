<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  die();
}

if (isset($_POST['simpan'])) {
  $id_user = $_SESSION['id_user'];

  $nama_lengkap = $_POST['nama_lengkap'];
  $nama_pembina = $_POST['nama_pembina'];
  // $password = $_POST['password'];
  // $password = md5($password);

  $update_info = mysqli_query($conn, "UPDATE tb_user SET nama_lengkap='$nama_lengkap', nama_pembina='$nama_pembina' WHERE id_user = $id_user");
}
$conn->close();
?>

<?php
include '../conf/conn.php';

$id_user = $_SESSION['id_user'];

$result_info = mysqli_query($conn, "SELECT *, tb_ekskul.ekskul
FROM tb_user
INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_user.id_ekskul
WHERE tb_user.id_user = $id_user");

$rrw = $result_info->fetch_assoc();

$result_update = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $id_user");

while ($row = mysqli_fetch_array($result_update)) {
  $nama_lengkap = $row['nama_lengkap'];
  $nama_pembina = $row['nama_pembina'];
  // $password = $row['password'];
}
?>

<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Informasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Informasi Ekstrakulikuler</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card card-purple">
              <div class="card-header">
                <h3 class="card-title"><span class="shadow-lg px-2 bg-white rounded"><?= $_SESSION['username']; ?></span> | <?= $rrw['ekskul']; ?></h3>
              </div>
              <form action="" method="post">
                <div class="row">
                  <div class="col-sm-3 mt-3 ml-4">
                    <div class="text-center">
                      <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-thumbnail" alt="avatar">
                      <h6>Upload a ekskul photo...</h6>
                      <input type="file" class="text-center ml-5 center-block file-upload">
                    </div>
                  </div>
                  <div class="card-body ">
                    <div class="form-group">
                      <label for="1">Nama Ketua Ekstra</label>
                      <input type="text" name="nama_lengkap" class="form-control" id="1" value="<?= $nama_lengkap; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="2">Nama Pembina Ekstra</label>
                      <input type="text" name="nama_pembina" class="form-control" id="2" value="<?= $nama_pembina; ?>" required>
                    </div>
                    <!-- <div class="form-group">
                      <label for="3">Ganti Password</label>
                      <input type="password" name="password" class="form-control" id="3" value="<?//= $password; ?>" required>
                    </div> -->
                  </div>
                </div>
                <div class="card-footer">
                  <button class="btn btn-lg btn-success pull-right" name="simpan" type="submit"><i class="fas fa-save"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
    </section>
  </div>
</div>
