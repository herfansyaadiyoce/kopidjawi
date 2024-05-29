<?php
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $metode_pembayaran = $_POST['status'];

    $stmt = $koneksi->prepare("UPDATE pembayaran SET metode_pembayaran = ? WHERE id_pembayaran = ?");
    $stmt->bind_param("si", $metode_pembayaran, $id);
    $stmt->execute();
    $stmt->close();
}
