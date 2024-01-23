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

              $query_tanggal = mysqli_query($conn, "SELECT tb_jadwal.tanggal_ekskul
              from tb_jadwal
              where tb_jadwal.id_jadwal = $id_jadwal");

              $rows = $query_tanggal->fetch_assoc();

              $query = mysqli_query($conn, "SELECT tb_presensi.id_presensi, tb_anggota.id_anggota, tb_anggota.nama_anggota, tb_jadwal.tanggal_ekskul, tb_ekskul.ekskul, tb_presensi.kehadiran
              from tb_anggota
              LEFT JOIN tb_presensi ON tb_anggota.id_anggota = tb_presensi.id_anggota
              LEFT JOIN tb_jadwal on tb_presensi.id_jadwal = tb_jadwal.id_jadwal
              Left JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_anggota.id_ekskul
              where tb_anggota.id_ekskul = '$_SESSION[id_ekskul]'
              and tb_jadwal.id_jadwal = $id_jadwal");

              if (isset($_POST['update'])) {
                while ($row1 = mysqli_fetch_assoc($query)) {
                  $id_presensi = $row1['id_presensi'];
                  $id_anggota = $row1['id_anggota'];
                  $kehadiran = $_POST[$id_anggota];

                  $update_presensi = mysqli_query($conn, "UPDATE tb_presensi SET kehadiran = '$kehadiran' where id_presensi='$id_presensi'");
                }
              }
              ?>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?= $rows['tanggal_ekskul']; ?></h3>
                </div>

                <div class="card-body">
                  <form action="" method="post">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th class="col-1">No</th>
                          <th class="col-3">Nama Anggota</th>
                          <th class="col-3">Ekstrakulikuler</th>
                          <th class="col-2">Kehadiran</th>
                          <th class="col-3">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                          <tr>
                            <td><?= $no = $no + 1; ?></td>
                            <td><?= $row['nama_anggota']; ?>
                              <input type="hidden" name="<?= $row['id_anggota']; ?>" value="<?= $row['id_anggota']; ?>">
                            </td>
                            <td><?= $row['ekskul']; ?></td>
                            <td><?= $row['kehadiran']; ?></td>
                            <td>
                              <input type="radio" name="<?= $row['id_anggota']; ?>" value="Hadir" <?=$row['kehadiran'] == 'Hadir' ? 'checked' : ''?> id="1">
                              <label for="1">Hadir</label>
                              <input type="radio" name="<?= $row['id_anggota']; ?>" value="Tidak Hadir" <?=$row['kehadiran'] == 'Tidak Hadir' ? 'checked' : ''?> id="2">
                              <label for="2">Tidak Hadir</label>
                            </td>
                          </tr>
                        <?php } ?>
                        <div class="card-footer">
                          <button type="submit" name="update" class="btn btn-warning" id="btn">Simpan</button>
                        </div>
                      </tbody>
                    </table>
                  </form>
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
