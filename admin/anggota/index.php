<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
}

$query = "SELECT tb_ekskul.ekskul
    FROM tb_user
    INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_user.id_ekskul
    Where tb_user.id_user = '$_SESSION[id_user]'";

$rs = $conn->query($query);
$num = $rs->num_rows;
$rrw = $rs->fetch_assoc();



// ======================= DELETE ANGGOTA =======================
// if (isset($_GET['id_anggota']) && isset($_GET['action']) && $_GET['action'] == "delete") {
//   $id_anggota = $_GET['id_anggota'];

//   $query = mysqli_query($conn, "DELETE FROM tb_anggota WHERE id_anggota='$id_anggota'");

//   if ($query == TRUE) {

//     echo "<script type = \"text/javascript\">
//             window.location = (\"index.php\")
//             </script>";
//   } else {

//     // $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
//   }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ManageEkskul | Anggota</title>

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
              <h1>Data Anggota</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                  <h3 class="card-title"><a href="index.php?page=create-anggota" class="btn btn-primary"><i class="ion ion-plus"></i> Tambah</a></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th class="col-5">Nama Lengkap</th>
                        <th class="col-2">Kelas</th>
                        <th class="col-3">Ekstrakulikuler</th>
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
                          <td><?php echo $no = $no + 1; ?></td>
                          <td><?php echo $row['nama_anggota']; ?></td>
                          <td><?php echo $row['kelas']; ?></td>
                          <td><?php echo $row['ekskul']; ?></td>
                          <td>
                            <a href="index.php?page=update-anggota&id_anggota=<?php echo $row['id_anggota']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-primary">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="index.php?page=delete-anggota&id_anggota=<?php echo $row['id_anggota']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline btn btn-danger">
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
