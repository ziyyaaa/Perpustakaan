<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5;

$max_pinjam = 3;
$denda_per_hari = 1000;
$max_denda = 50000;

// Status
$status = "";
$denda = 0;
$peringatan = "";

if ($buku_terlambat > 0) {
    $status = "Tidak bisa pinjam";
    $denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;

    if ($denda > $max_denda) {
        $denda = $max_denda;
    }

    $peringatan = "Ada keterlambatan!";
} elseif ($total_pinjaman >= $max_pinjam) {
    $status = "Batas maksimal tercapai";
} else {
    $status = "Boleh meminjam";
}

switch (true) {
    case ($total_pinjaman <= 5):
        $level = "Bronze";
        break;
    case ($total_pinjaman <= 15):
        $level = "Silver";
        break;
    default:
        $level = "Gold";
}
?>

<div class="container mt-5">
    <h3 class="mb-4">Status Peminjaman Anggota</h3>

    <!-- Card Informasi -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-info text-white">
            Data Anggota
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td><?php echo $nama_anggota; ?></td>
                </tr>
                <tr>
                    <th>Total Pinjaman</th>
                    <td><?php echo $total_pinjaman; ?> buku</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>
                        <span class="badge bg-warning text-dark"><?php echo $level; ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Card Status -->
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-dark text-white">
            Status Peminjaman
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-<?php echo ($buku_terlambat > 0) ? 'danger' : 'success'; ?>">
                            <?php echo $status; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Buku Terlambat</th>
                    <td><?php echo $buku_terlambat; ?></td>
                </tr>
                <tr>
                    <th>Hari Keterlambatan</th>
                    <td><?php echo $hari_keterlambatan; ?> hari</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Card Denda -->
    <?php if ($denda > 0) { ?>
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            Informasi Denda
        </div>
        <div class="card-body">
            <h5 class="text-danger">
                Rp <?php echo number_format($denda, 0, ',', '.'); ?>
            </h5>
            <p class="text-muted"><?php echo $peringatan; ?></p>
        </div>
    </div>
    <?php } ?>

</div>

</body>
</html>