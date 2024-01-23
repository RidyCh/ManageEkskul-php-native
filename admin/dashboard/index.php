<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../index.php");
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard - <?php echo $rrw['ekskul']; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box rose">
              <div class="inner">
                <h3><?php
                    $query1 = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_ekskul = '$_SESSION[id_ekskul]'");
                    $anggotas = mysqli_num_rows($query1);
                    ?><?php echo $anggotas; ?></h3>

                <p>Anggota Ekstrakukuler</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="index.php?page=anggota" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box green">
              <div class="inner">
                <h3><?php
                    $query1 = mysqli_query($conn, "SELECT * FROM tb_jadwal WHERE id_ekskul = '$_SESSION[id_ekskul]'");
                    $jadwals = mysqli_num_rows($query1);
                    ?><?php echo $jadwals; ?></h3>

                <p>Jadwal Ekstrakulikuler</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-time"></i>
              </div>
              <a href="index.php?page=jadwal" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box orange">
              <div class="inner">
                <h3><?php
                    $query1 = mysqli_query($conn, "SELECT * FROM tb_presensi WHERE id_ekskul = '$_SESSION[id_ekskul]'");
                    $presensis = mysqli_num_rows($query1);
                    ?><?php echo $presensis; ?></h3>

                <p>Presensi Anggota</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="index.php?page=presensi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box blue">
              <div class="inner">
                <h3><i class="ion ion-edit"></i></h3>

                <p>Informasi Ekstrakulikuler</p>
              </div>
              <div class="icon">
                <i class="ion ion-information-circled"></i>
              </div>
              <a href="index.php?page=informasi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
