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
    // Include functions
    require_once 'functions_anggota.php';
    
    // Data anggota
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
        [
            "id" => "AGT-010",
            "nama" => "Rudi Hartono",
            "email" => "rudi@email.com",
            "telepon" => "085577889900",
            "alamat" => "Bogor",
            "tanggal_daftar" => "2024-07-01",
            "status" => "Non-Aktif",
            "total_pinjaman" => 1
        ]
    ];

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    if (!empty($keyword)) {
        $anggota_list = search_by_nama($anggota_list, $keyword);
    }

    if ($sort === 'nama') {
        $anggota_list = sort_by_nama($anggota_list);
    }

    $total = hitung_total_anggota($anggota_list);
    $aktif = hitung_anggota_aktif($anggota_list);
    $rata = hitung_rata_rata_pinjaman($anggota_list);
    $teraktif = cari_anggota_teraktif($anggota_list);
    ?>
    
    <div class="container mt-5">
        <h1 class="mb-4 text-center"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>
        
        <!-- Dashboard Statistik -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h3><?= $total ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Anggota Aktif</h5>
                        <h3><?= $aktif ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Rata-rata Pinjaman</h5>
                        <h3><?= number_format($rata,1) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Anggota -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">

                <form method="GET" class="mb-3 d-flex">
                    <input type="text" name="keyword" class="form-control me-2" placeholder="Cari nama..." value="<?= $keyword ?>">

                    <select name="sort" class="form-select me-2" style="max-width:200px;">
                        <option value="">ID</option>
                        <option value="nama" <?= $sort === 'nama' ? 'selected' : '' ?>>Nama</option>
                    </select>

                    <button class="btn btn-light">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Total Pinjaman</th>
                    </tr>
                    <?php foreach ($anggota_list as $a): ?>
                    <tr>
                        <td><?= $a["id"] ?></td>
                        <td><?= $a["nama"] ?></td>
                        <td><?= $a["status"] ?></td>
                        <td><?= $a["total_pinjaman"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        
        <!-- Anggota Teraktif -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Anggota Teraktif</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama :</strong> <?= $teraktif["nama"] ?></p>
                <p><strong>Total Pinjaman :</strong> <?= $teraktif["total_pinjaman"] ?></p>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy;<?php echo date('Y'); ?> Sistem Perpustakaan</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>