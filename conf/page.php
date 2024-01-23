<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  switch ($page) {
      // Beranda
    case 'anggota':
      include '../admin/anggota/index.php';
      break;
    case 'create-anggota':
      include '../admin/anggota/create.php';
      break;
    case 'update-anggota':
      include '../admin/anggota/update.php';
      break;
    case 'delete-anggota':
      include '../admin/anggota/delete.php';
      break;
    case 'jadwal';
      include '../admin/jadwal/index.php';
      break;
    case 'create-jadwal':
      include '../admin/jadwal/create.php';
      break;
    case 'update-jadwal':
      include '../admin/jadwal/update.php';
      break;
    case 'delete-jadwal':
      include '../admin/jadwal/delete.php';
      break;
    case 'presensi';
      include '../admin/presensi/index.php';
      break;
    case 'create-presensi':
      include '../admin/presensi/presensi.php';
      break;
    case 'view-presensi':
      include '../admin/presensi/update.php';
      break;
    case 'informasi';
      include '../admin/profile/index.php';
      break;
  }
} else {
  include "../admin/dashboard/index.php";
}
