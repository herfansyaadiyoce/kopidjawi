<?php
$koneksi = new mysqli("localhost", "root", "", "warungkopidjawi");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $status_pemesanan = $_POST['status'];

    $stmt = $koneksi->prepare("UPDATE pemesanan SET status_pemesanan = ? WHERE id_pemesanan = ?");
    $stmt->bind_param("si", $status_pemesanan, $id);
    $stmt->execute();
    $stmt->close();
}
