<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
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
            "total_pinjaman" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Siti Aminah",
            "email" => "siti@email.com",
            "telepon" => "082233445566",
            "alamat" => "Bandung",
            "tanggal_daftar" => "2024-02-10",
            "status" => "Aktif",
            "total_pinjaman" => 8
        ],
        [
            "id" => "AGT-003",
            "nama" => "Andi Pratama",
            "email" => "andi@email.com",
            "telepon" => "083344556677",
            "alamat" => "Surabaya",
            "tanggal_daftar" => "2024-03-05",
            "status" => "Non-Aktif",
            "total_pinjaman" => 2
        ],
        [
            "id" => "AGT-004",
            "nama" => "Dewi Lestari",
            "email" => "dewi@email.com",
            "telepon" => "084455667788",
            "alamat" => "Semarang",
            "tanggal_daftar" => "2024-04-12",
            "status" => "Aktif",
            "total_pinjaman" => 10
        ],
        [
            "id" => "AGT-005",
            "nama" => "Rizky Ramadhan",
            "email" => "rizky@email.com",
            "telepon" => "085566778899",
            "alamat" => "Yogyakarta",
            "tanggal_daftar" => "2024-05-20",
            "status" => "Non-Aktif",
            "total_pinjaman" => 4
        ],
        [
            "id" => "AGT-006",
            "nama" => "Fajar Nugroho",
            "email" => "fajar@email.com",
            "telepon" => "081122334455",
            "alamat" => "Solo",
            "tanggal_daftar" => "2024-06-01",
            "status" => "Aktif",
            "total_pinjaman" => 7
        ],
        [
            "id" => "AGT-007",
            "nama" => "Lina Marlina",
            "email" => "lina@email.com",
            "telepon" => "082233445577",
            "alamat" => "Malang",
            "tanggal_daftar" => "2024-06-10",
            "status" => "Non-Aktif",
            "total_pinjaman" => 3
        ],
        [
            "id" => "AGT-008",
            "nama" => "Hendra Wijaya",
            "email" => "hendra@email.com",
            "telepon" => "083344556688",
            "alamat" => "Bekasi",
            "tanggal_daftar" => "2024-06-15",
            "status" => "Aktif",
            "total_pinjaman" => 12
        ],
        [
            "id" => "AGT-009",
            "nama" => "Maya Sari",
            "email" => "maya@email.com",
            "telepon" => "084455667799",
            "alamat" => "Depok",
            "tanggal_daftar" => "2024-06-20",
            "status" => "Aktif",
            "total_pinjaman" => 6
        ],
    ];

    $total_anggota = count($anggota_list);

    $aktif = 0;
    $non_aktif = 0;
    $total_pinjaman_semua = 0;
    $anggota_teraktif = null;

    foreach ($anggota_list as $anggota) {
        $total_pinjaman_semua += $anggota["total_pinjaman"];

        if ($anggota["status"] === "Aktif") {
            $aktif++;
        } else {
            $non_aktif++;
        }

        if ($anggota_teraktif === null || $anggota["total_pinjaman"] > $anggota_teraktif["total_pinjaman"]) {
            $anggota_teraktif = $anggota;
        }
    }

    $persen_aktif = $total_anggota > 0 ? ($aktif / $total_anggota) * 100 : 0;
    $persen_non_aktif = $total_anggota > 0 ? ($non_aktif / $total_anggota) * 100 : 0;
    $rata_rata_pinjaman = $total_anggota > 0 ? $total_pinjaman_semua / $total_anggota : 0;

    $status_filter = isset($_GET['status']) ? $_GET['status'] : 'Semua';

    $anggota_tampil = [];
    foreach ($anggota_list as $anggota) {
        if ($status_filter === 'Semua' || $anggota["status"] === $status_filter) {
            $anggota_tampil[] = $anggota;
        }
    }
    ?>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Data Anggota Perpustakaan</h2>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-2 text-primary"></i>
                        <h5 class="mt-2">Total Anggota</h5>
                        <h3 class="fw-bold"><?= $total_anggota ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                        <h5 class="mt-2">Anggota Aktif</h5>
                        <h3 class="fw-bold"><?= number_format($persen_aktif, 1) ?>%</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-x-circle-fill fs-2 text-danger"></i>
                        <h5 class="mt-2">Anggota Non-Aktif</h5>
                        <h3 class="fw-bold"><?= number_format($persen_non_aktif, 1) ?>%</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-book-fill fs-2 text-warning"></i>
                        <h5 class="mt-2">Rata-rata Pinjaman</h5>
                        <h3 class="fw-bold"><?= number_format($rata_rata_pinjaman, 1) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Anggota Teraktif</h5>
                        <p class="mb-1"><strong>Nama:</strong> <?= $anggota_teraktif["nama"] ?></p>
                        <p class="mb-1"><strong>ID:</strong> <?= $anggota_teraktif["id"] ?></p>
                        <p class="mb-0"><strong>Total Pinjaman:</strong> <?= $anggota_teraktif["total_pinjaman"] ?> buku</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="status" class="form-label fw-semibold">Filter Berdasarkan Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Semua" <?= $status_filter === 'Semua' ? 'selected' : '' ?>>Semua</option>
                            <option value="Aktif" <?= $status_filter === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Non-Aktif" <?= $status_filter === 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Daftar Anggota</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Total Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($anggota_tampil) > 0): ?>
                            <?php $no = 1; foreach ($anggota_tampil as $anggota): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $anggota["id"] ?></td>
                                    <td><?= $anggota["nama"] ?></td>
                                    <td><?= $anggota["email"] ?></td>
                                    <td><?= $anggota["telepon"] ?></td>
                                    <td><?= $anggota["alamat"] ?></td>
                                    <td><?= $anggota["tanggal_daftar"] ?></td>
                                    <td>
                                        <?php if ($anggota["status"] === "Aktif"): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $anggota["total_pinjaman"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy;Sistem Perpustakaan</p>
    </footer>`;
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>