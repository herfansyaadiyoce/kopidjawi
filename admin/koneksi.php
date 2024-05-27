<?php
$servername = "localhost"; // Sesuaikan dengan server database
$username = "root"; // Sesuaikan dengan username database
$password = "";
$dbname = "warungkopidjawi"; // Sesuaikan dengan nama database

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
