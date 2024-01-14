<?php
$conn = new mysqli('localhost', 'root', '', 'ekskul_managemen');
if ($conn->connect_error) {
  die("conn Gagal: " . $koneksi->connect_error);
}
