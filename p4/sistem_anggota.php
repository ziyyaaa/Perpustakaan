<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

<?php
require_once 'functions_anggota.php';

// Data anggota (format baru)
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjam" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Yuhu Uhuy",
        "email" => "yuhuuu@email.com",
        "telepon" => "0898765432",
        "alamat" => "Pekalongan",
        "tanggal_daftar" => "2022-10-03",
        "status" => "Aktif",
        "total_pinjam" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Gabriel",
        "email" => "gabi@email.com",
        "telepon" => "0813579731",
        "alamat" => "Bali",
        "tanggal_daftar" => "2023-03-12",
        "status" => "Non-Aktif",
        "total_pinjam" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Huening Kai",
        "email" => "kai@email.com",
        "telepon" => "08246808642",
        "alamat" => "Bogor",
        "tanggal_daftar" => "2024-04-08",
        "status" => "Aktif",
        "total_pinjam" => 10
    ],
    [
        "id" => "AGT-005",
        "nama" => "Suga Agus",
        "email" => "suga@email.com",
        "telepon" => "087391583621",
        "alamat" => "Bekasi",
        "tanggal_daftar" => "2023-12-31",
        "status" => "Non-Aktif",
        "total_pinjam" => 4
    ]
];

// Statistik
$total = hitung_total_anggota($anggota_list);
$aktif = hitung_anggota_aktif($anggota_list);
$rata = hitung_rata_rata_pinjaman($anggota_list);
$teraktif = cari_anggota_teraktif($anggota_list);

// Filter
$anggota_aktif = filter_by_status($anggota_list, "Aktif");
$anggota_nonaktif = filter_by_status($anggota_list, "Non-Aktif");

// Sort
$anggota_list = sort_by_nama($anggota_list);

// Search
$keyword = $_GET['search'] ?? "";
if ($keyword != "") {
    $anggota_list = search_by_nama($anggota_list, $keyword);
}
?>

<div class="container mt-5">
    <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>

    <!-- Dashboard -->
    <div class="row mb-4 text-center">
        <div class="col-md-4">
            <div class="card p-3 bg-primary text-white">
                <h4><?= $total ?></h4>
                <p>Total Anggota</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 bg-success text-white">
                <h4><?= $aktif ?></h4>
                <p>Anggota Aktif</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 bg-warning text-dark">
                <h4><?= number_format($rata,1) ?></h4>
                <p>Rata-rata Pinjaman</p>
            </div>
        </div>
    </div>

    <!-- Search -->
    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari nama anggota..." value="<?= $keyword ?>">
    </form>

    <!-- Tabel Anggota -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Anggota</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Pinjaman</th>
                    <th>Tanggal Daftar</th>
                </tr>
                <?php foreach ($anggota_list as $a): ?>
                <tr>
                    <td><?= $a['id'] ?></td>
                    <td><?= $a['nama'] ?></td>
                    <td><?= $a['email'] ?></td>
                    <td><?= $a['telepon'] ?></td>
                    <td><?= $a['alamat'] ?></td>
                    <td>
                        <?php if ($a['status'] == "Aktif"): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Non-Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $a['total_pinjam'] ?></td>
                    <td><?= format_tanggal_indo($a['tanggal_daftar']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- Anggota Teraktif -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Anggota Teraktif</h5>
        </div>
        <div class="card-body">
            <h5><?= $teraktif['nama'] ?></h5>
            <p>Email: <?= $teraktif['email'] ?></p>
            <p>Total Pinjaman: <strong><?= $teraktif['total_pinjam'] ?></strong></p>
        </div>
    </div>

    <!-- Aktif & Non Aktif -->
    <div class="row">
        <div class="col-md-6">
            <h5>Anggota Aktif</h5>
            <ul class="list-group">
                <?php foreach ($anggota_aktif as $a): ?>
                    <li class="list-group-item"><?= $a['nama'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-md-6">
            <h5>Anggota Non-Aktif</h5>
            <ul class="list-group">
                <?php foreach ($anggota_nonaktif as $a): ?>
                    <li class="list-group-item"><?= $a['nama'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>