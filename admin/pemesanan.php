<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if (isset($_SESSION['nama_pelanggan']) && isset($_SESSION['nomer_meja'])) {
    $nama_pelanggan = $_SESSION['nama_pelanggan'];
    $nomer_meja = $_SESSION['nomer_meja'];

    // Cek jika pelanggan sudah ada
    $checkPelanggan = $koneksi->prepare("SELECT id_pelanggan FROM pelanggan WHERE nama_pelanggan = ? AND nomer_meja = ?");
    $checkPelanggan->bind_param("si", $nama_pelanggan, $nomer_meja);
    $checkPelanggan->execute();
    $result = $checkPelanggan->get_result();

    if ($result->num_rows > 0) {
        // Jika pelanggan sudah ada, ambil id_pelanggan
        $row = $result->fetch_assoc();
        $id_pelanggan = $row['id_pelanggan'];
    } else {
        // Jika pelanggan belum ada, tambahkan ke database
        $stmt = $koneksi->prepare("INSERT INTO pelanggan (nama_pelanggan, nomer_meja) VALUES (?, ?)");
        $stmt->bind_param("si", $nama_pelanggan, $nomer_meja);
        $stmt->execute();
        $id_pelanggan = $stmt->insert_id;
        $stmt->close();
    }
    $checkPelanggan->close();

    // Insert data pemesanan dengan status default 'belum'
    $tanggal_pemesanan = date("Y-m-d H:i:s");
    $total_pemesanan = 0; // Set total pemesanan awal ke 0
    $status_pemesanan = 'belum';

    $stmt = $koneksi->prepare("INSERT INTO pemesanan (id_pelanggan, tanggal_pemesanan, total_pemesanan, status_pemesanan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $id_pelanggan, $tanggal_pemesanan, $total_pemesanan, $status_pemesanan);
    $stmt->execute();
    $stmt->close();

    // Hapus data sesi
    unset($_SESSION['nama_pelanggan']);
    unset($_SESSION['nomer_meja']);
}

// Ambil data dari database
$ambil = $koneksi->query("SELECT pemesanan.id_pemesanan, pelanggan.nomer_meja, pelanggan.nama_pelanggan, pemesanan.tanggal_pemesanan, pemesanan.total_pemesanan, pemesanan.status_pemesanan FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan = pelanggan.id_pelanggan ORDER BY pemesanan.tanggal_pemesanan DESC");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pemesanan</title>
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Data Pemesanan</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Nomer Meja</th>
                    <th> Nama Pelanggan</th>
                    <th> Tanggal Pemesanan</th>
                    <th> Menu</th>
                    <th> Total Pemesanan</th>
                    <th> Status </th>
                    <th> Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1; ?>
                <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nomer_meja']; ?></td>
                        <td><?php echo $pecah['nama_pelanggan']; ?></td>
                        <td><?php echo date("Y-m-d H:i:s", strtotime($pecah['tanggal_pemesanan'])); ?></td>
                        <td>
                            <?php
                            $id_pemesanan = $pecah['id_pemesanan'];
                            $query_menu = "SELECT menu.nama_menu, pemesanan_menu.jumlah FROM menu JOIN pemesanan_menu ON menu.id_menu = pemesanan_menu.id_menu WHERE pemesanan_menu.id_pemesanan = $id_pemesanan";
                            $result_menu = $koneksi->query($query_menu);
                            while ($row_menu = $result_menu->fetch_assoc()) {
                                echo $row_menu['nama_menu'] . " (" . $row_menu['jumlah'] . "), ";
                            }
                            ?>
                        </td>
                        <td>Rp. <?php echo number_format($pecah['total_pemesanan']); ?></td>
                        <td id="status_column_<?php echo $pecah['id_pemesanan']; ?>">
                            <select class="form-control" onchange="changeColor(<?php echo $pecah['id_pemesanan']; ?>, this)">
                                <option value="belum" <?php echo $pecah['status_pemesanan'] == 'belum' ? 'selected' : ''; ?>>Belum Diproses</option>
                                <option value="diproses" <?php echo $pecah['status_pemesanan'] == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                                <option value="selesai" <?php echo $pecah['status_pemesanan'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                <option value="cancel" <?php echo $pecah['status_pemesanan'] == 'cancel' ? 'selected' : ''; ?>>Cancel</option>
                            </select>
                        </td>
                        <td><a href="index.php?halaman=detail&id=<?php echo $pecah['id_pemesanan']; ?>" class="btn btn-success"> Detail </a></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function changeColor(id, selectElement) {
            var selectedValue = selectElement.value;
            var column = document.getElementById("status_column_" + id);

            // Set warna latar belakang sesuai dengan opsi yang dipilih
            if (selectedValue === "diproses") {
                column.style.backgroundColor = "#FFA07A"; // Warna untuk Diproses
            } else if (selectedValue === "selesai") {
                column.style.backgroundColor = "#98FB98"; // Warna untuk Selesai
            } else if (selectedValue === "cancel") {
                column.style.backgroundColor = "#B0C4DE"; // Warna untuk Cancel
            } else {
                column.style.backgroundColor = "white"; // Default: Warna latar belakang kolom putih
            }

            // Update status di database melalui AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id=" + id + "&status=" + selectedValue);
        }
    </script>
</body>

</html>