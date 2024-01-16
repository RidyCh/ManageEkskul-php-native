<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ManageEkskul | Presensi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition sidebar-mini">
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
                <li class="breadcrumb-item active">Presensi Jadwal</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <?php
              include "../conf/conn.php";

              $no = 0;
              $id_jadwal = $_GET['id_jadwal'];

              $query = mysqli_query($conn, "SELECT *
              FROM tb_presensi
              LEFT JOIN tb_anggota ON tb_presensi.id_anggota = tb_anggota.id_anggota
              LEFT JOIN tb_ekskul ON tb_presensi.id_ekskul = tb_ekskul.id_ekskul
              LEFT JOIN tb_jadwal ON tb_presensi.id_jadwal = tb_jadwal.id_jadwal
              WHERE tb_presensi.id_jadwal = $id_jadwal
              AND tb_presensi.id_ekskul = '$_SESSION[id_ekskul]'");

              while ($row = mysqli_fetch_assoc($query)) {
              ?>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><?= $row['tanggal_ekskul']; ?> | <a href="index.php?page=create-presensi" class="btn btn-primary"><i class="ion ion-plus"></i> Tambah</a></h3>
                  </div>

                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="col-1">No</th>
                          <th class="col-4">Nama Anggota</th>
                          <th class="col-3">Ekstrakulikuler</th>
                          <th class="col-2">Kehadiran</th>
                          <th class="col-2">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?= $no = $no + 1; ?></td>
                          <td><?= $row['nama_anggota']; ?></td>
                          <td><?= $row['ekskul']; ?></td>
                          <td><?= $row['kehadiran']; ?></td>
                          <td>
                            <a href="index.php?page=update-presensi&id_jadwal=<?= $row['id_jadwal']; ?>&id_presensi=<?= $row['id_presensi']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-primary">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?page=delete-presensi&id_presensi=<?= $row['id_presensi']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-danger">
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
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>
