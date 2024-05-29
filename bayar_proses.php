<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['method']) && $_POST['method'] == 'selesai') {
        if (isset($_SESSION['nama_pelanggan']) && isset($_SESSION['nomer_meja']) && !empty($_SESSION['keranjang'])) {
            $nama_pelanggan = $_SESSION['nama_pelanggan'];
            $nomer_meja = $_SESSION['nomer_meja'];
            $tanggal_pemesanan = date("Y-m-d H:i:s");

            // Get or create pelanggan
            $checkPelanggan = $koneksi->prepare("SELECT id_pelanggan FROM pelanggan WHERE nama_pelanggan = ? AND nomer_meja = ?");
            $checkPelanggan->bind_param("si", $nama_pelanggan, $nomer_meja);
            $checkPelanggan->execute();
            $result = $checkPelanggan->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id_pelanggan = $row['id_pelanggan'];
            } else {
                $stmt = $koneksi->prepare("INSERT INTO pelanggan (nama_pelanggan, nomer_meja) VALUES (?, ?)");
                $stmt->bind_param("si", $nama_pelanggan, $nomer_meja);
                $stmt->execute();
                $id_pelanggan = $stmt->insert_id;
                $stmt->close();
            }
            $checkPelanggan->close();

            // Insert pemesanan
            $stmt = $koneksi->prepare("INSERT INTO pemesanan (id_pelanggan, tanggal_pemesanan, total_pemesanan, status_pemesanan) VALUES (?, ?, ?, 'belum')");
            $total_pemesanan = array_sum(array_map(function ($id_menu, $jumlah) use ($koneksi) {
                $ambil = $koneksi->query("SELECT harga_menu FROM menu WHERE id_menu = '$id_menu'");
                $pecah = $ambil->fetch_assoc();
                return $pecah['harga_menu'] * $jumlah;
            }, array_keys($_SESSION['keranjang']), $_SESSION['keranjang']));
            $stmt->bind_param("isi", $id_pelanggan, $tanggal_pemesanan, $total_pemesanan);
            $stmt->execute();
            $id_pemesanan = $stmt->insert_id;
            $stmt->close();

            // Insert pemesanan_menu
            foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) {
                $stmt = $koneksi->prepare("INSERT INTO pemesanan_menu (id_pemesanan, id_menu, jumlah) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $id_pemesanan, $id_menu, $jumlah);
                $stmt->execute();
                $stmt->close();
            }

            // Clear session
            unset($_SESSION['keranjang']);
            unset($_SESSION['nama_pelanggan']);
            unset($_SESSION['nomer_meja']);

            echo "success";
        } else {
            echo "error";
        }
    }
}
