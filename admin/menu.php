<a href="index.php?halaman=tambah_menu" class="btn btn-primary">[+] Tambah Menu</a>
<h3 class="text-center">Makanan</h3>
<table class="table table-boarded text-center">
    <thead>
        <tr>
            <th> No. </th>
            <th> Nama </th>
            <th> Harga </th>
            <th> Foto </th>
            <th width="300"> Deskripsi </th>
            <th> Kategori </th>
            <th> Status </th>
            <th> Aksi </th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM menu WHERE kategori_menu='Makanan'"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_menu']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
                <td>
                    <img src="../foto_menu/<?php echo $pecah['foto_menu']; ?>" width="150" height="100">
                </td>
                <td><?php echo $pecah['deskripsi_menu']; ?></td>
                <td><?php echo $pecah['kategori_menu']; ?></td>
                <td>
                    <form method="post" action="update_status_menu.php">
                        <input type="hidden" name="id_menu" value="<?php echo $pecah['id_menu']; ?>">
                        <select name="status_menu" onchange="this.form.submit()">
                            <option value="ready" <?php if ($pecah['status_menu'] == 'ready') echo 'selected'; ?>>Ready</option>
                            <option value="kosong" <?php if ($pecah['status_menu'] == 'kosong') echo 'selected'; ?>>Kosong</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="index.php?halaman=edit_menu&id=<?php echo $pecah['id_menu'] ?>" class="btn btn-primary"> Edit </a>
                    <a href="index.php?halaman=hapus_menu&id=<?php echo $pecah['id_menu'] ?>" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<h3 class="text-center">Minuman</h3>
<table class="table table-boarded text-center">
    <thead>
        <tr>
            <th> No. </th>
            <th> Nama </th>
            <th> Harga </th>
            <th> Foto </th>
            <th width="300"> Deskripsi </th>
            <th> Kategori </th>
            <th> Status </th>
            <th> Aksi </th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM menu WHERE kategori_menu='Minuman'"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_menu']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
                <td>
                    <img src="../foto_menu/<?php echo $pecah['foto_menu']; ?>" width="150" height="100">
                </td>
                <td><?php echo $pecah['deskripsi_menu']; ?></td>
                <td><?php echo $pecah['kategori_menu']; ?></td>
                <td>
                    <form method="post" action="update_status_menu.php">
                        <input type="hidden" name="id_menu" value="<?php echo $pecah['id_menu']; ?>">
                        <select name="status_menu" onchange="this.form.submit()">
                            <option value="ready" <?php if ($pecah['status_menu'] == 'ready') echo 'selected'; ?>>Ready</option>
                            <option value="kosong" <?php if ($pecah['status_menu'] == 'kosong') echo 'selected'; ?>>Kosong</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="index.php?halaman=edit_menu&id=<?php echo $pecah['id_menu'] ?>" class="btn btn-primary"> Edit </a>
                    <a href="index.php?halaman=hapus_menu&id=<?php echo $pecah['id_menu'] ?>" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>