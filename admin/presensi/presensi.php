<?php
include '../conf/conn.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: ../../login.php");
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
              <li class="breadcrumb-item">Presensi</li>
              <li class="breadcrumb-item active">Tambah Presensi</li>
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

            $query_tanggal = mysqli_query($conn, "SELECT *, tb_jadwal.tanggal_ekskul
              from tb_jadwal
              where tb_jadwal.id_jadwal = $id_jadwal");

            $rows = $query_tanggal->fetch_assoc();

            $query = mysqli_query($conn, "SELECT tb_anggota.id_anggota, tb_anggota.nama_anggota, tb_ekskul.ekskul
              from tb_anggota
              Left JOIN tb_ekskul ON tb_ekskul.id_ekskul = tb_anggota.id_ekskul
              where tb_anggota.id_ekskul = '$_SESSION[id_ekskul]'");

            if (isset($_POST['kirim'])) {
              while ($row1 = mysqli_fetch_assoc($query)) {
                $id_ekskul_login = $_SESSION['id_ekskul'];
                $id_anggota = $row1['id_anggota'];
                $jadwal = $id_jadwal;
                $kehadiran = $_POST[$id_anggota];

                $query_presensi = mysqli_query($conn, "INSERT INTO tb_presensi (id_anggota, id_jadwal, id_ekskul, kehadiran) VALUES ('$id_anggota', '$jadwal', $id_ekskul_login, '$kehadiran')");
              }

              if ($query_presensi === TRUE) {
                echo "<script type = \"text/javascript\">
                        window.location = (\"index.php?page=view-presensi&id_jadwal={$id_jadwal}\")
                        </script>";
              } else {
                echo "Error: " . $query_presensi . "<br>" . $conn->error;
              }
            }
            ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tanggal <span class="rounded px-2 pl"><?= $rows['tanggal_ekskul']; ?></span></h3>
              </div>

              <div class="card-body">
                <form action="" method="post">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="col-1">No</th>
                        <th class="col-6">Nama Anggota</th>
                        <th class="col-2">Ekstrakulikuler</th>
                        <th class="col-3">Keterangan</th>
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
                            <select class="custom-select" name="<?= $row['id_anggota']; ?>" id="">
                              <option value="">-- Pilih Keterangan --</option>
                              <option value="Hadir">Hadir</option>
                              <option value="Tidak Hadir">Tidak Hadir</option>
                            </select>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
              <div class="card-footer">
                <a href="index.php?page=view-presensi&id_jadwal=<?= $id_jadwal; ?>" class="btn btn-danger" id="btn">Kembali</a>
                <button type="submit" name="kirim" class="btn btn-success" id="btn">Kirim</button>
              </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
</div>
<!-- ./wrapper -->
