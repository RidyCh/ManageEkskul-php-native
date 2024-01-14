<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  switch ($page) {
      // Beranda
    case 'dashboard':
      include 'admin/index.php';
      break;
    case 'anggota':
      include '../admin/anggota/index.php';
      break;
    case 'jadwal';
      include '../admin/jadwal/index.php';
      break;
    case 'presensi';
      include '../admin/presensi/index.php';
      break;
  }
} else {
  include "../admin/dashboard/index.php";
}
