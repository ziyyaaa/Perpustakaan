<?php
session_start();

$buku_list = [
    [
        "kode" => "A001",
        "judul" => "Algoritma Dasar",
        "kategori" => "Pemrograman",
        "pengarang" => "Budi",
        "penerbit" => "Informatika",
        "tahun" => 2020,
        "harga" => 75000,
        "stok" => 5
    ],
    [
        "kode" => "A002",
        "judul" => "Struktur Data",
        "kategori" => "Pemrograman",
        "pengarang" => "Ani",
        "penerbit" => "Andi",
        "tahun" => 2021,
        "harga" => 85000,
        "stok" => 0
    ],
    [
        "kode" => "A003",
        "judul" => "Belajar HTML",
        "kategori" => "Pemrograman",
        "pengarang" => "Citra",
        "penerbit" => "Elex Media",
        "tahun" => 2019,
        "harga" => 50000,
        "stok" => 10
    ],
    [
        "kode" => "A004",
        "judul" => "CSS Modern",
        "kategori" => "Pemrograman",
        "pengarang" => "Dedi",
        "penerbit" => "Informatika",
        "tahun" => 2022,
        "harga" => 90000,
        "stok" => 3
    ],
    [
        "kode" => "A005",
        "judul" => "JavaScript Lanjut",
        "kategori" => "Pemrograman",
        "pengarang" => "Eka",
        "penerbit" => "Gramedia",
        "tahun" => 2023,
        "harga" => 95000,
        "stok" => 2
    ],
    [
        "kode" => "A006",
        "judul" => "Basis Data",
        "kategori" => "Komputer",
        "pengarang" => "Fajar",
        "penerbit" => "Andi",
        "tahun" => 2020,
        "harga" => 80000,
        "stok" => 7
    ],
    [
        "kode" => "A007",
        "judul" => "Jaringan Komputer",
        "kategori" => "Komputer",
        "pengarang" => "Gina",
        "penerbit" => "Informatika",
        "tahun" => 2018,
        "harga" => 78000,
        "stok" => 0
    ],
    [
        "kode" => "A008",
        "judul" => "UI UX Design",
        "kategori" => "Desain",
        "pengarang" => "Hani",
        "penerbit" => "Gramedia",
        "tahun" => 2021,
        "harga" => 88000,
        "stok" => 4
    ],
    [
        "kode" => "A009",
        "judul" => "Photoshop Pemula",
        "kategori" => "Desain",
        "pengarang" => "Irfan",
        "penerbit" => "Elex Media",
        "tahun" => 2017,
        "harga" => 60000,
        "stok" => 0
    ],
    [
        "kode" => "A010",
        "judul" => "Manajemen Proyek",
        "kategori" => "Bisnis",
        "pengarang" => "Joko",
        "penerbit" => "Gramedia",
        "tahun" => 2019,
        "harga" => 78000,
        "stok" => 6
    ],
    [
        "kode" => "A011",
        "judul" => "Kewirausahaan",
        "kategori" => "Bisnis",
        "pengarang" => "Lina",
        "penerbit" => "Andi",
        "tahun" => 2022,
        "harga" => 82000,
        "stok" => 1
    ],
    [
        "kode" => "A012",
        "judul" => "Digital Marketing",
        "kategori" => "Bisnis",
        "pengarang" => "Maya",
        "penerbit" => "Elex Media",
        "tahun" => 2023,
        "harga" => 91000,
        "stok" => 5
    ]
];

// AMBIL GET
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$status = $_GET['status'] ?? 'semua';
$sort = $_GET['sort'] ?? 'judul';
$page = $_GET['page'] ?? 1;

// VALIDASI
$errors = [];

if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
}

if (!empty($tahun) && ($tahun < 1900 || $tahun > date("Y"))) {
    $errors[] = "Tahun tidak valid";
}

// FILTER
$hasil = array_filter($buku_list, function($buku) use ($keyword,$kategori,$min_harga,$max_harga,$tahun,$status){

    if ($keyword && stripos($buku['judul'],$keyword) === false && stripos($buku['pengarang'],$keyword) === false) return false;

    if ($kategori && $buku['kategori'] != $kategori) return false;

    if ($min_harga && $buku['harga'] < $min_harga) return false;
    if ($max_harga && $buku['harga'] > $max_harga) return false;

    if ($tahun && $buku['tahun'] != $tahun) return false;

    if ($status == 'tersedia' && $buku['stok'] <= 0) return false;
    if ($status == 'habis' && $buku['stok'] > 0) return false;

    return true;
});

// SORT
usort($hasil, function($a,$b) use ($sort){
    return $a[$sort] <=> $b[$sort];
});

// PAGINATION
$per_page = 12;
$total = count($hasil);
$start = ($page-1)*$per_page;
$hasil_page = array_slice($hasil,$start,$per_page);

// HIGHLIGHT
function highlight($text,$keyword){
    if(!$keyword) return $text;
    return preg_replace("/($keyword)/i","<mark>$1</mark>",$text);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Advanced</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .card-header-custom {
            background: linear-gradient(135deg, #0d3bd5);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .badge-stok {
            font-size: 12px;
        }
        .table thead {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body class="container py-4">

<!-- CARD SEARCH -->
<div class="card shadow mb-4">
    <div class="card-header card-header-custom text-center">
        <h4>Sistem Pencarian Buku</h4>
    </div>

    <div class="card-body">
        <form method="GET" class="row g-3">

            <div class="col-md-4">
                <label>Judul/Pengarang</label>
                <input type="text" name="keyword" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">Semua</option>
                    <option>Pemrograman</option>
                    <option>Komputer</option>
                    <option>Desain</option>
                    <option>Bisnis</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Min Harga</label>
                <input type="number" name="min_harga" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Max Harga</label>
                <input type="number" name="max_harga" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Status</label><br>
                <input type="radio" name="status" value="semua" checked> Semua
                <input type="radio" name="status" value="tersedia" class="ms-2"> Tersedia
                <input type="radio" name="status" value="habis" class="ms-2"> Kosong
            </div>

            <div class="col-md-12 mt-3">
                <button class="btn btn-primary">Cari</button>
                <button name="export" value="1" class="btn btn-success">Export CSV</button>
            </div>

        </form>
    </div>
</div>


<!-- HASIL -->
<div class="card shadow">
    <div class="card-body">

        <h5 class="mb-3">Hasil Pencarian</h5>

        <table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($hasil_page as $b): ?>
                <tr>
                    <td><?= $b['kode'] ?></td>
                    <td><?= highlight($b['judul'],$keyword) ?></td>
                    <td><?= $b['kategori'] ?></td>
                    <td><?= highlight($b['pengarang'],$keyword) ?></td>
                    <td><?= $b['tahun'] ?></td>
                    <td>Rp <?= number_format($b['harga'],0,',','.') ?></td>
                    <td>
                        <?php if($b['stok'] > 0): ?>
                            <span class="badge bg-success badge-stok"><?= $b['stok'] ?> tersedia</span>
                        <?php else: ?>
                            <span class="badge bg-danger badge-stok">Habis</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <p><strong>Total:</strong> <?= $total ?> buku</p>

    </div>
</div>

</body>
</html>