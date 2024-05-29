<h2 class="text-center"> Detail Pemesanan</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pemesanan JOIN pelanggan 
ON pemesanan.id_pelanggan = pelanggan.id_pelanggan 
WHERE pemesanan.id_pemesanan = '$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<strong>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $detail['nama_pelanggan']; ?></strong><br>
<strong>
    Nomer Meja : &nbsp;<?php echo $detail['nomer_meja']; ?> <br><br>
</strong>
Waktu &nbsp;&nbsp;&nbsp;: <?php echo $detail['tanggal_pemesanan']; ?><br>
<strong>Total &nbsp;&nbsp;&nbsp;&nbsp; : Rp. <?php echo number_format($detail['total_pemesanan']); ?></strong>
</p>

<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th> No. </th>
            <th> Nama Menu </th>
            <th> Harga Menu </th>
            <th> Jumlah </th>
            <th> Subtotal </th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pemesanan_menu JOIN menu
        ON pemesanan_menu.id_menu = menu.id_menu 
        WHERE pemesanan_menu.id_pemesanan = '$_GET[id]'"); ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_menu']; ?></td>
                <td> Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td> Rp. <?php echo number_format($pecah['harga_menu'] * $pecah['jumlah']); ?></td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>