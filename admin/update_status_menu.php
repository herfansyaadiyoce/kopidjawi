<?php
include 'koneksi.php';

$id_menu = $_POST['id_menu'];
$status_menu = $_POST['status_menu'];

$koneksi->query("UPDATE menu SET status_menu='$status_menu' WHERE id_menu='$id_menu'");

header('Location: index.php?halaman=menu');
