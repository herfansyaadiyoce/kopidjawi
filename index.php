<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Kopidjawi</title>
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
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="foto_menu/1_far_cry_primal_totem.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="foto_menu/1_far_cry_primal_totem.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="foto_menu/1_far_cry_primal_totem.jpg" class="d-block w-100 img-fluid" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <section class="konten py-5">
        <div class="container">
            <br>
            <h1 class="text-center mt-5 md-4">Daftar Menu</h1>
            <?php
            // Ambil daftar kategori makanan dari database
            $query_kategori = "SELECT DISTINCT kategori_menu FROM menu WHERE kategori_menu IN ('Makanan', 'Minuman')";
            $result_kategori = $koneksi->query($query_kategori);
            if ($result_kategori->num_rows > 0) {
                // Tampilkan navbar untuk kategori makanan dan minuman
                echo "<ul class='nav nav-pills justify-content-center mb-5'>";
                while ($kategori = $result_kategori->fetch_assoc()) {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='#{$kategori['kategori_menu']}' onclick='showCategory(\"{$kategori['kategori_menu']}\")'>{$kategori['kategori_menu']}</a>";
                    echo "</li>";
                }
                echo "</ul>";

                // Tampilkan menu berdasarkan kategori makanan dan minuman
                $result_kategori->data_seek(0); // Kembalikan pointer hasil ke awal
                while ($kategori = $result_kategori->fetch_assoc()) {
                    $nama_kategori = $kategori['kategori_menu'];

                    // Query untuk mengambil menu berdasarkan kategori dan status "ready"
                    $query_menu = "SELECT * FROM menu WHERE kategori_menu='$nama_kategori' AND status_menu='ready'";
                    $ambil = $koneksi->query($query_menu);

                    // Tampilkan judul kategori
                    echo "<div id='{$nama_kategori}' style='display: none;'>";
                    echo "<div class='row'>";
                    while ($permenu = $ambil->fetch_assoc()) {
                        echo "<div class='col-lg-3 col-md-3 col-sm-6 col-6 mt-2'>";
                        echo "<div class='card h-100'>";
                        echo "<a href='detail.php?id={$permenu['id_menu']}'>";
                        echo "<img src='foto_menu/{$permenu['foto_menu']}' class='card-img-top' alt='{$permenu['nama_menu']}' style='width: 100%; height: 200px; object-fit: cover;'>";
                        echo "</a>";
                        echo "<div class='card-body text-center'>";
                        echo "<h5 class='card-title nama-menu'>{$permenu['nama_menu']}</h5>";
                        echo "<p class='card-text harga-menu'>Rp. " . number_format($permenu['harga_menu']) . "</p>";
                        echo "<form action='beli.php' method='post'>";
                        echo "<input type='hidden' name='id' value='{$permenu['id_menu']}'>";
                        echo "<button type='submit' name='action' value='beli' class='btn btn-primary btn-beli'>Pilih</button>";
                        echo "</form>";
                        echo "</div></div></div>";
                    }
                    echo "</div></div>";
                }
            } else {
                echo "<p class='text-center'>Tidak ada menu makanan atau minuman.</p>";
            }
            ?>
        </div>
    </section>

    <script>
        function showCategory(category) {
            // Semua kategori disembunyikan terlebih dahulu
            var allCategories = document.querySelectorAll('[id^=Makanan], [id^=Minuman]');
            allCategories.forEach(function(category) {
                category.style.display = 'none';
            });

            // Hilangkan kelas aktif dari semua link navigasi
            var allNavLinks = document.querySelectorAll('.nav-link');
            allNavLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Tampilkan kategori yang dipilih
            var selectedCategory = document.getElementById(category);
            if (selectedCategory) {
                selectedCategory.style.display = 'block';
            }

            // Tambahkan kelas aktif ke link navigasi yang dipilih
            var selectedNavLink = document.querySelector(`a[href="#${category}"]`);
            if (selectedNavLink) {
                selectedNavLink.classList.add('active');
            }
        }
        window.onload = function() {
            showCategory('Minuman');
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>