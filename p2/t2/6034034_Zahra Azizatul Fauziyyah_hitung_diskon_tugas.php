<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>

    <?php
    // PEMBELI 1
    $nama_pembeli = "Budi Santoso";
    $judul_buku = "Laravel Advanced";
    $harga_satuan = 150000;
    $jumlah_beli = 4;
    $is_member = true;

    $subtotal = $harga_satuan * $jumlah_beli;

    if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
        $persentase_diskon = 0;
    } elseif ($jumlah_beli <= 5) {
        $persentase_diskon = 0.10;
    } elseif ($jumlah_beli <= 10) {
        $persentase_diskon = 0.15;
    } else {
        $persentase_diskon = 0.20;
    }

    $diskon = $subtotal * $persentase_diskon;
    $total_setelah_diskon1 = $subtotal - $diskon;

    $diskon_member = 0;
    if ($is_member){
        $diskon_member = $total_setelah_diskon1 * 0.05;
    }

    $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;
    $ppn = $total_setelah_diskon * 0.11;
    $total_akhir = $total_setelah_diskon + $ppn;
    $total_hemat = $diskon + $diskon_member;
    ?>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5>Detail Pembelian</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Pembeli:</strong> <?php echo $nama_pembeli; ?></p>
            <p><strong>Judul Buku:</strong> <?php echo $judul_buku; ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($harga_satuan,0,',','.'); ?></p>
            <p><strong>Jumlah:</strong> <?php echo $jumlah_beli; ?> buku</p>
            <p>
                <strong>Status:</strong>
                <span class="badge <?php echo $is_member ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $is_member ? 'Member' : 'Non Member'; ?>
                </span>
            </p>

            <hr>
            <h5>Perhitungan</h5>
            <table class="table">
                <tr><td>Subtotal</td><td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td></tr>
                <tr><td>Diskon (<?php echo $persentase_diskon*100; ?>%)</td><td>Rp <?php echo number_format($diskon,0,',','.'); ?></td></tr>
                <tr><td>Diskon Member</td><td>Rp <?php echo number_format($diskon_member,0,',','.'); ?></td></tr>
                <tr><td>Total Setelah Diskon</td><td>Rp <?php echo number_format($total_setelah_diskon,0,',','.'); ?></td></tr>
                <tr><td>PPN</td><td>Rp <?php echo number_format($ppn,0,',','.'); ?></td></tr>
                <tr class="table-success"><td>Total Akhir</td><td>Rp <?php echo number_format($total_akhir,0,',','.'); ?></td></tr>
                <tr class="table-warning"><td>Total Hemat</td><td>Rp <?php echo number_format($total_hemat,0,',','.'); ?></td></tr>
            </table>
        </div>
    </div>


    <?php
    // PEMBELI 2
    $nama_pembeli = "Yuhu Uhuy";
    $judul_buku = "MySQL Database";
    $harga_satuan = 135000;
    $jumlah_beli = 2;
    $is_member = false;

    $subtotal = $harga_satuan * $jumlah_beli;

    if ($jumlah_beli <= 2) {
        $persentase_diskon = 0;
    } elseif ($jumlah_beli <= 5) {
        $persentase_diskon = 0.10;
    } elseif ($jumlah_beli <= 10) {
        $persentase_diskon = 0.15;
    } else {
        $persentase_diskon = 0.20;
    }

    $diskon = $subtotal * $persentase_diskon;
    $total_setelah_diskon1 = $subtotal - $diskon;

    $diskon_member = 0;
    if ($is_member == true) {
        $diskon_member = $total_setelah_diskon1 * 0.05;
    }

    $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;
    $ppn = $total_setelah_diskon * 0.11;
    $total_akhir = $total_setelah_diskon + $ppn;
    $total_hemat = $diskon + $diskon_member;
    ?>

    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white">
            <h5>Detail Pembelian</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Pembeli:</strong> <?php echo $nama_pembeli; ?></p>
            <p><strong>Judul Buku:</strong> <?php echo $judul_buku; ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($harga_satuan,0,',','.'); ?></p>
            <p><strong>Jumlah:</strong> <?php echo $jumlah_beli; ?> buku</p>
            <p>
                <strong>Status:</strong>
                <span class="badge <?php echo $is_member ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $is_member ? 'Member' : 'Non Member'; ?>
                </span>
            </p>

            <hr>
            <h5>Perhitungan</h5>
            <table class="table">
                <tr><td>Subtotal</td><td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td></tr>
                <tr><td>Diskon</td><td>Rp <?php echo number_format($diskon,0,',','.'); ?></td></tr>
                <tr><td>Diskon Member</td><td>Rp <?php echo number_format($diskon_member,0,',','.'); ?></td></tr>
                <tr><td>Total Setelah Diskon</td><td>Rp <?php echo number_format($total_setelah_diskon,0,',','.'); ?></td></tr>
                <tr><td>PPN</td><td>Rp <?php echo number_format($ppn,0,',','.'); ?></td></tr>
                <tr class="table-success"><td>Total Akhir</td><td>Rp <?php echo number_format($total_akhir,0,',','.'); ?></td></tr>
                <tr class="table-warning"><td>Total Hemat</td><td>Rp <?php echo number_format($total_hemat,0,',','.'); ?></td></tr>
            </table>
        </div>
    </div>


    <?php
    // PEMBELI 3
    $nama_pembeli = "Adadeh";
    $judul_buku = "JavaScript Dasar";
    $harga_satuan = 110000;
    $jumlah_beli = 7;
    $is_member = true;

    $subtotal = $harga_satuan * $jumlah_beli;

    if ($jumlah_beli <= 2) {
        $persentase_diskon = 0;
    } elseif ($jumlah_beli <= 5) {
        $persentase_diskon = 0.10;
    } elseif ($jumlah_beli <= 10) {
        $persentase_diskon = 0.15;
    } else {
        $persentase_diskon = 0.20;
    }

    $diskon = $subtotal * $persentase_diskon;
    $total_setelah_diskon1 = $subtotal - $diskon;

    $diskon_member = 0;
    if ($is_member){
        $diskon_member = $total_setelah_diskon1 * 0.05;
    }

    $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;
    $ppn = $total_setelah_diskon * 0.11;
    $total_akhir = $total_setelah_diskon + $ppn;
    $total_hemat = $diskon + $diskon_member;
    ?>

    <div class="card shadow mb-4">
        <div class="card-header bg-warning">
            <h5>Detail Pembelian</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Pembeli:</strong> <?php echo $nama_pembeli; ?></p>
            <p><strong>Judul Buku:</strong> <?php echo $judul_buku; ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($harga_satuan,0,',','.'); ?></p>
            <p><strong>Jumlah:</strong> <?php echo $jumlah_beli; ?> buku</p>
            <p>
                <strong>Status:</strong>
                <span class="badge <?php echo $is_member ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $is_member ? 'Member' : 'Non Member'; ?>
                </span>
            </p>

            <hr>
            <h5>Perhitungan</h5>
            <table class="table">
                <tr><td>Subtotal</td><td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td></tr>
                <tr><td>Diskon</td><td>Rp <?php echo number_format($diskon,0,',','.'); ?></td></tr>
                <tr><td>Diskon Member</td><td>Rp <?php echo number_format($diskon_member,0,',','.'); ?></td></tr>
                <tr><td>Total Setelah Diskon</td><td>Rp <?php echo number_format($total_setelah_diskon,0,',','.'); ?></td></tr>
                <tr><td>PPN</td><td>Rp <?php echo number_format($ppn,0,',','.'); ?></td></tr>
                <tr class="table-success"><td>Total Akhir</td><td>Rp <?php echo number_format($total_akhir,0,',','.'); ?></td></tr>
                <tr class="table-warning"><td>Total Hemat</td><td>Rp <?php echo number_format($total_hemat,0,',','.'); ?></td></tr>
            </table>
        </div>
    </div>

</div>

</body>
</html>