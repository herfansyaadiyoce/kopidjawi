<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Keranjang kosong, silakan belanja terlebih dahulu');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

if (!isset($_SESSION['nama_pelanggan']) || !isset($_SESSION['nomer_meja'])) {
    echo "<script>alert('Silakan masukkan nama dan nomor meja terlebih dahulu');</script>";
    echo "<script>location='masuk.php';</script>";
    exit();
}

$nama = $_SESSION['nama_pelanggan'];
$nomer_meja = $_SESSION['nomer_meja'];
$total_harga = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar - Warung Kopidjawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="nota.css">
</head>

<body id="page-top">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#00235B" id="mainNav">
        <div class="container">
            <a class="navbar-brand mb-0 h1 d-flex align-items-center" href="index.php">
                <img src="img/cofee.svg" alt="Cup Hot" width="30" height="30" style="margin-right: 8px; filter: invert(100%);">
                <span style="color: white; display: flex; align-items: center;"> WARUNG <strong style="margin-left: 6px;">KOPIDJAWI</strong></span>
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true" style="color: white;"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="konten">
        <div class="container">
            <div class="nota-container">
                <div class="nota-header">
                    <h2>Nota Pembayaran</h2>
                    <h8 style="color: red; font-style: italic;">Simpan & tunjukan nota pembayaran
                        ke kasir apabila anda tidak membayar dengan QRIS</h8>
                </div>
                <div class="nota-details">
                    <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?php echo $nama; ?></p>
                    <p>Nomer Meja &nbsp;: &nbsp;<?php echo $nomer_meja; ?></p>
                </div>
                <div id="nota">
                    <table class="table table-bordered text-center table-fluid" style="max-width: 800px; margin: auto;">
                        <thead>
                            <tr>
                                <th class="text-center">Menu</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Subharga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) : ?>
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu = '$id_menu'");
                                $pecah = $ambil->fetch_assoc();
                                $subharga = $pecah['harga_menu'] * $jumlah;
                                $total_harga += $subharga;
                                ?>
                                <tr>
                                    <td><?php echo $pecah['nama_menu']; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td>Rp. <?php echo number_format($subharga); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Total</th>
                                <th>Rp. <?php echo number_format($total_harga); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="btn-container">
                    <a href="keranjang.php" class="btn btn-primary btn-fluid">Kembali</a>
                    <button onclick="window.print()" class="btn btn-danger btn-fluid">Bayar di Kasir</button>
                    <a href="qris.php" class="btn btn-success btn-fluid">QRIS</a>
                    <a href="masuk.php" class="btn btn-warning btn-fluid" style="color: black;">Selesai</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        function beforePrintHandler() {
            document.querySelector('.fa-home').style.display = 'none'; // menyembunyikan ikon home
            document.querySelector('.btn-container').style.display = 'none'; // menyembunyikan tombol kembali
        }

        function afterPrintHandler() {
            document.querySelector('.fa-home').style.display = ''; // menampilkan kembali ikon home setelah selesai mencetak
            document.querySelector('.btn-container').style.display = ''; // menampilkan kembali tombol setelah selesai mencetak
        }

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforePrintHandler();
                } else {
                    afterPrintHandler();
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>