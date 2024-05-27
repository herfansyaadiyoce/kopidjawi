<h2 class="text-center">Tambah Menu</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Nama"> Nama </label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label for="Harga"> Harga (Rp) </label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label> Kategori </label>
        <select name="kategori" class="form-control">
            <option value="Makanan" class="form-control" name="kategori">Makanan</option>
            <option value="Minuman" class="form-control" name="kategori">Minuman</option>
        </select>
    </div>
    <div class="form-group">
        <label for="Deskripsi"> Deskripsi </label>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-froup">
        <label for="Foto"> Foto </label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="save"> Simpan </button>
    <a href="index.php?halaman=menu" class="btn btn-warning"> Kembali </a>
</form>

<?php
if (isset($_POST['save'])) {
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_menu/" . $nama);
    $koneksi->query("INSERT INTO menu(nama_menu, harga_menu, kategori_menu, foto_menu, deskripsi_menu) VALUES('$_POST[nama]', '$_POST[harga]','$_POST[kategori]', '$nama', '$_POST[deskripsi]')");
    echo "<br><div class='alert alert-success'>Data Berhasil disimpan </div>";
    echo "<meta http-equiv='refresh' content='1:url=index.php?halaman=menu'>";
}
?>