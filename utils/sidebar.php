<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
}

$query = "SELECT *, tb_ekskul.ekskul
    FROM tb_user
    INNER JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_user.id_ekskul
    Where tb_user.id_user = '$_SESSION[id_user]'";

$rs = $conn->query($query);
$rrw = $rs->fetch_assoc();

$current_page = isset($_GET['page']) ? $_GET['page'] : '';

function isActive($page)
{
  global $current_page;
  return $current_page == $page ? 'active' : '';
}
?>

<aside class="main-sidebar sidebar-dark-primary purple elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Ekskul Manager</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image mt-2">
        <img src="../dist/img/profile.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block text-white text-md"><?= $rrw['nama_lengkap']; ?></a>
        <a href="#" class="d-block text-white text-sm">Ketua <?= $rrw['ekskul']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="../admin/index.php" class="nav-link <?= isActive(!'dashboard'); ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=anggota" class="nav-link <?= isActive('anggota'); ?>">
            <i class="nav-icon ion ion-person-add"></i>
            <p>Anggota</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=jadwal" class="nav-link <?= isActive('jadwal'); ?>">
            <i class="nav-icon ion ion-ios-time"></i>
            <p>Jadwal</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=presensi" class="nav-link <?= isActive('presensi'); ?>">
            <i class="nav-icon ion ion-calendar"></i>
            <p>Presensi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=informasi" class="nav-link <?= isActive('informasi'); ?>">
            <i class="nav-icon ion ion-information-circled"></i>
            <p>Informasi</p>
          </a>
        </li>
        </hr>
        <li class="nav-item">
          <a href="../admin/logout.php" class="nav-link bg-danger">
            <i class="nav-icon ion ion-arrow-left-a"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
