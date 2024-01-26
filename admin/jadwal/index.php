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
            <h1>Jadwal Ekstrakulikuler</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Jadwal</li>
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
                <h3 class="card-title"><a href="index.php?page=create-jadwal" class="btn text-white button"><i class="ion ion-plus"></i> Tambah</a></h3>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th class="col-3">Tanggal Ekstra</th>
                      <th class="col-3">Lokasi</th>
                      <th class="col-2">Jam Mulai</th>
                      <th class="col-2">Jam Selesai</th>
                      <th class="col-2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../conf/conn.php";
                    $no = 0;
                    $query = mysqli_query($conn, "SELECT *
                      FROM tb_jadwal
                      INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_jadwal.id_ekskul
                      Where tb_jadwal.id_ekskul = '$_SESSION[id_ekskul]'");
                    while ($row = mysqli_fetch_array($query)) {
                      $mulai = $row['jam_mulai'];
                      $selesai = $row['jam_selesai'];
                      $jam_mulai = date("H:i:s", strtotime($mulai));
                      $jam_selesai = date("H:i:s", strtotime($selesai));
                    ?>
                      <tr>
                        <td><?= $no = $no + 1; ?></td>
                        <td><?= $row['tanggal_ekskul']; ?></td>
                        <td><?= $row['lokasi']; ?></td>
                        <td><?= $jam_mulai; ?></td>
                        <td><?= $jam_selesai; ?></td>
                        <td>
                          <a href="index.php?page=update-jadwal&id_jadwal=<?= $row['id_jadwal']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-primary">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="index.php?page=delete-jadwal&id_jadwal=<?= $row['id_jadwal']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-danger">
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
