<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if (empty($_SESSION['keranjang']) or !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Menu Kosong, Silahkan Belanja Terlebih Dahulu);</script>";
    echo "<script>location='index.php';</script>";
}

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
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true" style="color: white;"></i></a>
                </li>
            </ul>
        </div>
    </nav>


    <section class="konten">
        <div class="container"><br><br>
            <h1 class="judul-keranjang">Keranjang Menu</h1><br>
            <table class="table table-bordered text-center table-fluid">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Menu</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subharga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) : ?>
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu = '$id_menu'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah['harga_menu'] * $jumlah;
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah['nama_menu']; ?></td>
                            <td class="harga-menu" data-id="<?php echo $id_menu; ?>" data-harga="<?php echo $pecah['harga_menu']; ?>">Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
                            <td class="quantity">
                                <button class="btn-minus" data-id="<?php echo $id_menu; ?>"><i class="fas fa-minus"></i></button>
                                <span class="mx-2 jumlah" data-id="<?php echo $id_menu; ?>"><?php echo $jumlah; ?></span>
                                <button class="btn-plus" data-id="<?php echo $id_menu; ?>"><i class="fas fa-plus text-white"></i></button>
                            </td>
                            <td class="subharga" data-id="<?php echo $id_menu; ?>">Rp. <?php echo number_format($subharga); ?></td>
                            <td>
                                <a href="hapus_keranjang.php?id=<?php echo $id_menu; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-harga mt-4 text-end">
                <h6>Total Harga: <span id="total-harga">Rp. 0</span></h4>
            </div>
            <a href="index.php" class="btn btn-primary"> Tambah Menu </a>
            <a href="bayar.php" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin melakukan pembayaran?')"> Bayar </a>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-plus').on('click', function() {
                let id = $(this).data('id');
                updateQuantity(id, 'plus');
            });

            $('.btn-minus').on('click', function() {
                let id = $(this).data('id');
                updateQuantity(id, 'minus');
            });

            function updateQuantity(id, action) {
                $.ajax({
                    url: 'beli.php',
                    type: 'POST',
                    data: {
                        id: id,
                        action: action
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        let jumlahElement = $('.jumlah[data-id="' + id + '"]');
                        let subhargaElement = $('.subharga[data-id="' + id + '"]');

                        jumlahElement.text(data.jumlah);

                        let hargaMenu = parseInt($('.harga-menu[data-id="' + id + '"]').data('harga'));
                        let newSubtotal = hargaMenu * data.jumlah;
                        subhargaElement.text('Rp. ' + newSubtotal.toLocaleString('id-ID'));
                    }
                });
            }
        });
        $(document).ready(function() {
            // Your existing JavaScript code

            // Function to calculate total harga
            function calculateTotalHarga() {
                let total = 0;
                $('.subharga').each(function() {
                    let subharga = parseInt($(this).text().replace('Rp. ', '').replace('.', ''));
                    total += subharga;
                });
                $('#total-harga').text('Rp. ' + formatRupiah(total));
            }

            // Format Rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }

            // Calculate total harga on page load
            calculateTotalHarga();

            // Update total harga on subharga change (added)
            $(document).ajaxComplete(function() {
                calculateTotalHarga();
            });
        });
    </script>

</body>

</html>