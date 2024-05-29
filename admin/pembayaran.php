<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

// Fetch data from database
$ambil = $koneksi->query("SELECT pemesanan.id_pemesanan, pelanggan.nomer_meja, pelanggan.nama_pelanggan, pemesanan.tanggal_pemesanan, pemesanan.total_pemesanan, pembayaran.metode_pembayaran, pembayaran.bukti_pembayaran FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan = pelanggan.id_pelanggan LEFT JOIN pembayaran ON pemesanan.id_pemesanan = pembayaran.id_pemesanan ORDER BY pemesanan.tanggal_pemesanan DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Detail Pembayaran</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pelanggan</th>
                    <th>Nomer Meja</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Total Pemesanan</th>
                    <th>Metode Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama_pelanggan']; ?></td>
                        <td><?php echo $pecah['nomer_meja']; ?></td>
                        <td><?php echo date("Y-m-d H:i:s", strtotime($pecah['tanggal_pemesanan'])); ?></td>
                        <td>Rp. <?php echo number_format($pecah['total_pemesanan']); ?></td>
                        <td><?php echo $pecah['metode_pembayaran']; ?></td>
                        <td><img src="../bukti_pembayaran/<?php echo $pecah['bukti_pembayaran']; ?>" width="150" height="100"></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>