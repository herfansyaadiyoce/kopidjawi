<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

// Mengecek apakah terdapat kata kunci pencarian yang dikirimkan dari form
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari menu berdasarkan nama menu yang mengandung kata kunci
    $query = "SELECT * FROM menu WHERE nama_menu LIKE '%$keyword%'";
    $result = $koneksi->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body id="page-top">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#00235B" id="mainNav">
        <div class="container">
            <a class="navbar-brand mb-0 h1 d-flex align-items-center" href="index.php">
                <img src="img/cofee.svg" alt="Cup Hot" width="30" height="30" style="margin-right: 8px; filter: invert(100%);">
                <span style="color: white; display: flex; align-items: center;"> WARUNG <strong style="margin-left: 6px;">KOPIDJAWI</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item search-bar">
                        <!-- Form pencarian -->
                        <form class="d-flex" action="hasil_pencarian.php" method="GET">
                            <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
                            <button class="btn btn-warning" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link cart-link" href="keranjang.php">
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="konten py-5">
        <div class="container">
            <br>
            <h1 class="text-center mt-5 md-4">Hasil Pencarian</h1>
            <div class="row">
                <?php
                // Jika terdapat hasil dari pencarian
                if ($result->num_rows > 0) {
                    // Tampilkan hasil pencarian
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-lg-3 col-md-4 col-sm-6 col-12 mt-2'>";
                        echo "<div class='card h-100'>";
                        echo "<img src='foto_menu/{$row['foto_menu']}' class='card-img-top' alt='{$row['nama_menu']}' style='width: 100%; height: 200px; object-fit: cover;'>";
                        echo "<div class='card-body text-center'>";
                        echo "<h5 class='card-title nama-menu'>{$row['nama_menu']}</h5>";
                        echo "<p class='card-text harga-menu'>Rp. " . number_format($row['harga_menu']) . "</p>";
                        echo "<form action='beli.php' method='post'>";
                        echo "<input type='hidden' name='id' value='{$row['id_menu']}'>";
                        echo "<button type='submit' name='action' value='beli' class='btn btn-primary btn-beli'>Pilih</button>";
                        echo "</form>";
                        echo "</div></div></div>";
                    }
                } else {
                    // Jika tidak ada hasil dari pencarian
                    echo "<p class='text-center'>Tidak ada hasil yang ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>