<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");
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
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item d-flex align-items-center">
                    <a class="nav-link cart-link" href="keranjang.php">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="konten">
        <div class="container">
            <br>
            <h1 class="text-center mt-5 md-4">Detail Menu</h1><br>
            <?php
            $id_menu = $_GET['id'];
            $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu = '$id_menu'");
            $detail = $ambil->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_menu/<?php echo $detail['foto_menu']; ?>" alt="<?php echo $detail['nama_menu']; ?>" class="img-fluid" style="border-radius: 10px;">
                </div>
                <div class="col-md-6" style="margin-top: 10px;">
                    <h3 style="font-weight: bold;"><?php echo $detail['nama_menu']; ?></h3>
                    <h5>Rp. <?php echo number_format($detail['harga_menu']); ?></h5>
                    <p style="margin-top: 15px;"><?php echo $detail['deskripsi_menu']; ?></p>
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah">
                                <div class="input-group-btn" style="margin-left: 10px;">
                                    <button class="btn btn-success" name="beli">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['beli'])) {
                        $jumlah = $_POST['jumlah'];
                        $_SESSION['keranjang'][$id_menu] = $jumlah;

                        echo "<script>alert('Menu berhasil ditambahkan kedalam Keranjang');</script>";
                        echo "<script>location:'keranjang.php';</script>";
                    }
                    ?>
                    <br>
                    <a href="index.php" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>