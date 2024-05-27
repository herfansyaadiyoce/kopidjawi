<h2 class="text-center"> Edit Menu</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM menu WHERE id_menu ='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label> Nama Menu </label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_menu'] ?>">
    </div>
    <div class="form-group">
        <label> Harga(Rp) </label>
        <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_menu'] ?>">
    </div>
    <div class="form-group">
        <label> Kategori </label>
        <select name="kategori" class="form-control">
            <option value="Makanan" <?php if ($pecah['kategori_menu'] == 'Makanan') echo 'selected'; ?>>Makanan</option>
            <option value="Minuman" <?php if ($pecah['kategori_menu'] == 'Minuman') echo 'selected'; ?>>Minuman</option>
        </select>
    </div>
    <div class="form-group">
        <img src="../foto_menu/<?php echo $pecah['foto_menu'] ?>" width="200" height="150">
    </div>
    <div class="form-group">
        <label> Ganti Foto Menu </label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label> Deskripsi Menu </label>
        <textarea name="deskripsi" class="form-control" rows="5"><?php echo $pecah['deskripsi_menu']; ?></textarea>
    </div>
    <button class="btn btn-primary" name="edit"> Edit </button>
    <a href="index.php?halaman=menu" class="btn btn-warning"> Kembali</a>
</form>

<?php
if (isset($_POST['edit'])) {
    $nama = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';
    $lokasi = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : '';

    if (!empty($lokasi)) {
        move_uploaded_file($lokasi, "../foto_menu/$nama");

        $koneksi->query("UPDATE menu SET nama_menu = '$_POST[nama]', harga_menu = '$_POST[harga]', foto_menu ='$nama', deskripsi_menu = '$_POST[deskripsi]', kategori_menu = '$_POST[kategori]' WHERE id_menu = '$_GET[id]'");
    } else {
        $koneksi->query("UPDATE menu SET nama_menu = '$_POST[nama]', harga_menu = '$_POST[harga]', deskripsi_menu = '$_POST[deskripsi]', kategori_menu = '$_POST[kategori]' WHERE id_menu = '$_GET[id]'");
    }

    echo "<script>alert('Data Berhasil Diedit');</script>";
    echo "<script>window.location.href = 'index.php?halaman=menu';</script>";
}
?>