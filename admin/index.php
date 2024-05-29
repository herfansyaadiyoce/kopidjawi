<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">
    <?php
    if (isset($_GET['halaman'])) {
      if ($_GET['halaman'] == "menu") {
        include 'menu.php';
      } elseif ($_GET['halaman'] == "pelanggan") {
        include 'pelanggan.php';
      } elseif ($_GET['halaman'] == "pemesanan") {
        include 'pemesanan.php';
      } elseif ($_GET['halaman'] == "detail") {
        include 'detail.php';
      } elseif ($_GET['halaman'] == "tambah_menu") {
        include 'tambah_menu.php';
      } elseif ($_GET['halaman'] == "hapus_menu") {
        include 'hapus_menu.php';
      } elseif ($_GET['halaman'] == "edit_menu") {
        include 'edit_menu.php';
      } elseif ($_GET['halaman'] == "pembayaran") {
        include 'pembayaran.php';
      }
    } else {
      include 'home.php';
    }
    ?>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>