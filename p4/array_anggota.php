<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Array Anggota Perpustakaan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php
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

$status_filter = $_GET['status'] ?? 'Semua';

$filtered = [];
foreach ($anggota_list as $a) {
    if ($status_filter == "Semua" || $a["status"] == $status_filter) {
        $filtered[] = $a;
    }
}

$total = count($anggota_list);
$aktif = 0;
$non = 0;
$total_pinjam = 0;

$max = 0;
$teraktif = [];

foreach ($anggota_list as $a) {
    if ($a["status"] == "Aktif") {
        $aktif++;
    } else {
        $non++;
    }

    $total_pinjam += $a["total_pinjam"];

    if ($a["total_pinjam"] > $max) {
        $max = $a["total_pinjam"];
        $teraktif = $a;
    }
}

$persen_aktif = ($aktif / $total) * 100;
$persen_non = ($non / $total) * 100;
$rata = $total_pinjam / $total;
?>

<div class="container mt-4">

    <h3 class="text-center fw-bold mb-4">Data Anggota Perpustakaan</h3>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h6>Total Anggota</h6>
                <h3><?php echo $total; ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h6>Anggota Aktif</h6>
                <h3><?php echo number_format($persen_aktif,1); ?>%</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h6>Anggota Non-Aktif</h6>
                <h3><?php echo number_format($persen_non,1); ?>%</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h6>Rata-rata Pinjaman</h6>
                <h3><?php echo number_format($rata,1); ?></h3>
            </div>
        </div>

    </div>

    <div class="card p-3 mb-3">
        <h5>Anggota Teraktif</h5>
        <p>
            <b>Nama:</b> <?php echo $teraktif["nama"]; ?><br>
            <b>ID:</b> <?php echo $teraktif["id"]; ?><br>
            <b>Total Pinjaman:</b> <?php echo $teraktif["total_pinjam"]; ?> buku
        </p>
    </div>

    <div class="card p-3 mb-3">
        <form method="GET" class="row">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option <?php if($status_filter=="Semua") echo "selected"; ?>>Semua</option>
                    <option <?php if($status_filter=="Aktif") echo "selected"; ?>>Aktif</option>
                    <option <?php if($status_filter=="Non-Aktif") echo "selected"; ?>>Non-Aktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>

    <div class="card p-3">
        <h5>Daftar Anggota</h5>

        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total Pinjaman</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; foreach ($filtered as $a) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $a["id"]; ?></td>
                    <td><?php echo $a["nama"]; ?></td>
                    <td><?php echo $a["email"]; ?></td>
                    <td><?php echo $a["telepon"]; ?></td>
                    <td><?php echo $a["alamat"]; ?></td>
                    <td><?php echo $a["tanggal_daftar"]; ?></td>
                    <td>
                        <?php if ($a["status"] == "Aktif") { ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Non-Aktif</span>
                        <?php } ?>
                    </td>
                    <td><?php echo $a["total_pinjam"]; ?></td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

</div>

</body>
</html>