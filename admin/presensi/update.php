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
              <li class="breadcrumb-item active">Presensi</li>
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

            $query_tanggal = mysqli_query($conn, "SELECT tb_jadwal.id_jadwal, tb_jadwal.tanggal_ekskul
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

                if ($update_presensi === TRUE) {
                  echo "<script type = \"text/javascript\">
                          window.location = (\"index.php?page=view-presensi&id_jadwal={$id_jadwal}\")
                          </script>";
                } else {
                  echo "Error: " . $update_presensi . "<br>" . $conn->error;
                }
              }
            }
            ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><span class="rounded px-2 pl"><?= $rows['tanggal_ekskul']; ?></span>
                  <?php
                  $data = mysqli_query($conn, "SELECT * from tb_presensi where id_jadwal = $id_jadwal");
                  $num_cek = $data->num_rows;
                  $row_cek = $data->fetch_assoc();

                  if ($num_cek <= 0) {
                    echo '| <a href="index.php?page=create-presensi&id_jadwal=' . $rows['id_jadwal'] . '" class="btn text-white button" id="btn"><i class="ion ion-plus"></i> Tambah</a>';
                  }
                  ?>
                </h3>
              </div>

              <div class="card-body">
                <form action="" method="post">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-1">No</th>
                        <th class="col-5">Nama Anggota</th>
                        <th class="col-2">Ekstrakulikuler</th>
                        <th class="col-2">Kehadiran</th>
                        <th class="col-2">Keterangan</th>
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
                          <td>
                            <span class="badge <?= $row['kehadiran'] == 'Hadir' ? 'badge-success' : 'badge-danger' ?>">
                              <?= $row['kehadiran']; ?>
                            </span>
                          <td>
                            <select class="custom-select" name="<?= $row['id_anggota']; ?>" id="">
                              <option value="Hadir" <?= $row['kehadiran'] == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
                              <option value="Tidak Hadir" <?= $row['kehadiran'] == 'Tidak Hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                            </select>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
              <div class="card-footer">
                <a href="index.php?page=presensi" class="btn btn-danger" id="btn">Kembali</a>
                <button type="submit" name="update" class="btn btn-warning" id="btn">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
<!-- ./wrapper -->
