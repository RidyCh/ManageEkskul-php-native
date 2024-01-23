<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  die();
}

$query = "SELECT tb_ekskul.ekskul
    FROM tb_user
    INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_user.id_ekskul
    Where tb_user.id_user = '$_SESSION[id_user]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();

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
              <li class="breadcrumb-item active">Anggota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><a href="index.php?page=create-anggota" class="btn text-white button"><i class="ion ion-plus"></i> Tambah</a></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th class="col-6">Nama Lengkap</th>
                      <th class="col-2">Kelas</th>
                      <th class="col-2">Ekstrakulikuler</th>
                      <th class="col-2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../conf/conn.php";
                    $no = 0;
                    $query = mysqli_query($conn, "SELECT *
                      FROM tb_anggota
                      INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_anggota.id_ekskul
                      Where tb_anggota.id_ekskul = '$_SESSION[id_ekskul]'");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td><?= $no = $no + 1; ?></td>
                        <td><?= $row['nama_anggota']; ?></td>
                        <td><?= $row['kelas']; ?></td>
                        <td><?= $row['ekskul']; ?></td>
                        <td>
                          <a href="index.php?page=update-anggota&id_anggota=<?= $row['id_anggota']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-primary">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="index.php?page=delete-anggota&id_anggota=<?= $row['id_anggota']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-danger">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
