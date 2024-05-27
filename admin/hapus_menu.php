<?php
// Memeriksa apakah parameter 'id' ada dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_menu = $_GET['id'];

    // Mengambil data menu berdasarkan id_menu
    $ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu = '$id_menu'");
    if ($ambil) {
        $pecah = $ambil->fetch_assoc();
        // Memeriksa apakah ada data menu yang ditemukan
        if ($pecah) {
            $foto_menu = $pecah['foto_menu'];
            // Memeriksa apakah file gambar ada sebelum dihapus
            if (!empty($foto_menu) && file_exists("../foto_menu/$foto_menu")) {
                unlink("../foto_menu/$foto_menu");
            }

            // Menghapus data menu dari database
            $koneksi->query("DELETE FROM menu WHERE id_menu = '$id_menu'");
            echo "<script>alert('Data menu berhasil dihapus.'); location='index.php?halaman=menu';</script>";
        } else {
            echo "<script>alert('Data menu tidak ditemukan.'); location='index.php?halaman=menu';</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus data menu.'); location='index.php?halaman=menu';</script>";
    }
} else {
    echo "<script>alert('ID menu tidak valid.'); location='index.php?halaman=menu';</script>";
}
