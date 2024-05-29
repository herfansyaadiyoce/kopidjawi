<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['method'])) {
        if ($_POST['method'] == 'selesai') {
            unset($_SESSION['keranjang']);
            echo "success";
        }
    }
}
