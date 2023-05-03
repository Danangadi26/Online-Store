<?php 
session_start();
// koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  <title>Riwayat Belanja</title>
</head>
<body>
<!-- NAVBAR -->
<?php include "menu.php"; ?>

<!-- <pre><?php //print_r($_SESSION); ?></pre> -->
<div class="riwayat">
  <div class="container">
    <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Total</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $nomor = 1;
        // mendapatkan id pelanggan yang login
        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

        $ambil  = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
        
        while($pecah = $ambil->fetch_assoc()){
        ?>
        <tr>
          <td><?php echo $nomor ?></td>
          <td><?php echo $pecah['tanggal_pembelian']; ?></td>
          <td><?php echo $pecah['status_pembelian']; ?></td>
          <td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
          <td>
            <a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>

            <?php if ($pecah['status_pembelian']=="pending"): ?>
            <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Input Pembayaran</a>
            <?php else: ?>
              <a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
                Lihat Pembayaran
              </a>
              <a href="faktur.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-default">Faktur</a>
              <a href="kuitansi.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-default">Kuitansi</a>
            <?php endif ?>  
          </td>
        </tr>
        <?php $nomor++ ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
  
</body>
</html>