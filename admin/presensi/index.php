<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../index.php");
  die();
}

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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Lihat Jadwal</li>
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
                <h3 class="card-title">List Tanggal Ekstrakulikuler</h3>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="col-1">No</th>
                      <th class="col-9">Tanggal Ekstrakulikuler</th>
                      <th class="col-2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../conf/conn.php";

                    $no = 0;

                    $query = mysqli_query($conn, "SELECT * FROM tb_jadwal Where tb_jadwal.id_ekskul = '$_SESSION[id_ekskul]'");

                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td><?= $no = $no + 1; ?></td>
                        <td><?= $row['tanggal_ekskul']; ?></td>
                        <td>
                          <a href="index.php?page=view-presensi&id_jadwal=<?= $row['id_jadwal']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-success">
                            <i class="ion ion-eye"></i> Lihat Presensi
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
</div>
<!-- ./wrapper -->
