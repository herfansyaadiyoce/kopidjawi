<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_menu = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'beli') {
        if (isset($_SESSION['keranjang'][$id_menu])) {
            $_SESSION['keranjang'][$id_menu] += 1;
        } else {
            $_SESSION['keranjang'][$id_menu] = 1;
        }
        echo json_encode(['status' => 'success', 'message' => 'Menu berhasil masuk kedalam keranjang']);
        // Arahkan pengguna ke halaman keranjang setelah menambahkan item ke keranjang
        echo "<script>alert('Menu berhasil masuk kedalam keranjang'); window.location.href = 'keranjang.php';</script>";
    } elseif ($action == 'plus' || $action == 'minus') {
        if (isset($_SESSION['keranjang'][$id_menu])) {
            if ($action == 'plus') {
                $_SESSION['keranjang'][$id_menu] += 1;
            } elseif ($action == 'minus') {
                if ($_SESSION['keranjang'][$id_menu] > 1) {
                    $_SESSION['keranjang'][$id_menu] -= 1;
                }
            }
        }
        echo json_encode(['status' => 'success', 'message' => 'Jumlah berhasil diperbarui', 'jumlah' => $_SESSION['keranjang'][$id_menu]]);
    }
}
