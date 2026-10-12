<?php
    $kirim = isset($_POST['submit']);

    $nama_barang = "";
    $harga_satuan = 0;
    $jumlah_pembelian = 0;
    $diskon = 0;

    if ($kirim) {
        $nama_barang = $_POST['nama_barang'];
        $harga_satuan = (int)$_POST['harga_satuan'];
        $jumlah_pembelian = (int)$_POST['jumlah_pembelian'];

        if ($harga_satuan < 0 || $jumlah_pembelian < 1) {
            echo "Harga tidak boleh minus dan jumlah minimal 1.";
        } else {
            $harga_total = $harga_satuan * $jumlah_pembelian;

            if ($harga_total >= 500000) {
                $diskon = 20;
            } elseif ($harga_total >= 250000) {
                $diskon = 10;
            } else {
                $diskon = 0;
            }

            $bayar = $harga_total - ($harga_total * $diskon / 100);
        }
    }
?>

<form method="POST">
    Nama Barang:
    <input type="text" name="nama_barang" required><br>

    Harga Satuan:
    <input type="number" name="harga_satuan" min="0" required><br>

    Jumlah Pembelian:
    <input type="number" name="jumlah_pembelian" min="1" required><br>

    <button type="submit" name="submit">Kirim</button>
</form>

<?php
if ($kirim && $harga_satuan >= 0 && $jumlah_pembelian >= 1) {
    echo "<p>Nama Barang: $nama_barang</p>";
    echo "<p>Harga Satuan: Rp" . number_format($harga_satuan) . "</p>";
    echo "<p>Jumlah Pembelian: $jumlah_pembelian</p>";
    echo "<p>Diskon: $diskon%</p>";
    echo "<p>Total Pembayaran: Rp" . number_format($bayar) . "</p>";
}
?>