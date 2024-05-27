<?php
session_start();

if (isset($_POST['submit'])) {
    $_SESSION['nama_pelanggan'] = $_POST['nama_pelanggan'];
    $_SESSION['nomer_meja'] = $_POST['nomer_meja'];
    $_SESSION['tanggal_pemesanan'] = date("Y-m-d H:i:s");
    header("Location: index.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Warung Kopidjawi Soemarto</title>
    <link rel="stylesheet" href="kode.css">
</head>

<body>
    <div class="container">
        <div class="masuk">
            <form action="" method="POST">
                <h1>WELCOME</h1>
                <p>Silahkan masukan nama dan nomer meja anda!</p>
                <hr>
                <div class="form-group">
                    <label>Nama : </label>
                    <input type="text" name="nama_pelanggan" class="input-control" placeholder="Masukan Nama" required>
                </div>

                <div class="form-group">
                    <label>Nomer Meja : </label>
                    <input type="text" name="nomer_meja" placeholder="Masukan Nomer Meja" class="input-control" required>
                </div>
                <input type="submit" name="submit" value="MASUK" class="btn">
            </form>
        </div>
    </div>
</body>

</html>