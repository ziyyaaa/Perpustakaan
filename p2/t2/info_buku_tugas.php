<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h1 class="mb-4">Informasi Buku</h1>

    <div class="row">

        <?php
        // Buku 1
        $judul1 = "Laravel: From Beginner to Advanced";
        $pengarang1 = "Budi Raharjo";
        $penerbit1 = "Informatika";
        $tahun1 = 2023;
        $isbn1 = "978-602-1234-56-7";
        $harga1 = 125000;
        $stok1 = 8;
        $kategori1 = "Programming";
        $bahasa1 = "Indonesia";
        $halaman1 = 450;
        $berat1 = 500;

        // Buku 2
        $judul2 = "MySQL Database Administration";
        $pengarang2 = "Andi Setiawan";
        $penerbit2 = "Yuhu Media";
        $tahun2 = 2022;
        $isbn2 = "678-103-1357-23-5";
        $harga2 = 135000;
        $stok2 = 5;
        $kategori2 = "Database";
        $bahasa2 = "Inggris";
        $halaman2 = 380;
        $berat2 = 450;

        // Buku 3
        $judul3 = "Belajar HTML & CSS";
        $pengarang3 = "Rudi Hartono";
        $penerbit3 = "Informatika";
        $tahun3 = 2021;
        $isbn3 = "876-503-0987-12-3";
        $harga3 = 95000;
        $stok3 = 7;
        $kategori3 = "Web Design";
        $bahasa3 = "Indonesia";
        $halaman3 = 300;
        $berat3 = 350;

        // Buku 4
        $judul4 = "JavaScript untuk Pemula";
        $pengarang4 = "Siti Aminah";
        $penerbit4 = "Andi Publisher";
        $tahun4 = 2024;
        $isbn4 = "123-908-456-32-2";
        $harga4 = 110000;
        $stok4 = 6;
        $kategori4 = "Programming";
        $bahasa4 = "Indonesia";
        $halaman4 = 420;
        $berat4 = 480;
        ?>


        <!-- Buku 1 -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo $judul1; ?></h5>
                    <span class="badge bg-primary"><?php echo $kategori1; ?></span>
                </div>

                <div class="card-body">
                    <p>Pengarang : <?php echo $pengarang1; ?></p>
                    <p>Penerbit : <?php echo $penerbit1; ?></p>
                    <p>Tahun : <?php echo $tahun1; ?></p>
                    <p>ISBN : <?php echo $isbn1; ?></p>
                    <p>Bahasa : <?php echo $bahasa1; ?></p>
                    <p>Halaman : <?php echo $halaman1; ?></p>
                    <p>Berat : <?php echo $berat1; ?> gram</p>
                    <p>Harga : Rp <?php echo number_format($harga1, 0, ',', '.'); ?></p>
                    <p>Stok : <?php echo $stok1; ?> buku</p>
                </div>
            </div>
        </div>

        <!-- Buku 2 -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo $judul2; ?></h5>
                    <span class="badge bg-success"><?php echo $kategori2; ?></span>
                </div>

                <div class="card-body">
                    <p>Pengarang : <?php echo $pengarang2; ?></p>
                    <p>Penerbit : <?php echo $penerbit2; ?></p>
                    <p>Tahun : <?php echo $tahun2; ?></p>
                    <p>ISBN : <?php echo $isbn2; ?></p>
                    <p>Bahasa : <?php echo $bahasa2; ?></p>
                    <p>Halaman : <?php echo $halaman2; ?></p>
                    <p>Berat : <?php echo $berat2; ?> gram</p>
                    <p>Harga : Rp <?php echo number_format($harga2, 0, ',', '.'); ?></p>
                    <p>Stok : <?php echo $stok2; ?> buku</p>
                </div>
            </div>
        </div>

        <!-- Buku 3 -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo $judul3; ?></h5>
                    <span class="badge bg-warning"><?php echo $kategori3; ?></span>
                </div>

                <div class="card-body">
                    <p>Pengarang : <?php echo $pengarang3; ?></p>
                    <p>Penerbit : <?php echo $penerbit3; ?></p>
                    <p>Tahun : <?php echo $tahun3; ?></p>
                    <p>ISBN : <?php echo $isbn3; ?></p>
                    <p>Bahasa : <?php echo $bahasa3; ?></p>
                    <p>Halaman : <?php echo $halaman3; ?></p>
                    <p>Berat : <?php echo $berat3; ?> gram</p>
                    <p>Harga : Rp <?php echo number_format($harga3, 0, ',', '.'); ?></p>
                    <p>Stok : <?php echo $stok3; ?> buku</p>
                </div>
            </div>
        </div>

        <!-- Buku 4 -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo $judul4; ?></h5>
                    <span class="badge bg-primary"><?php echo $kategori4; ?></span>
                </div>

                <div class="card-body">
                    <p>Pengarang : <?php echo $pengarang4; ?></p>
                    <p>Penerbit : <?php echo $penerbit4; ?></p>
                    <p>Tahun : <?php echo $tahun4; ?></p>
                    <p>ISBN : <?php echo $isbn4; ?></p>
                    <p>Bahasa : <?php echo $bahasa4; ?></p>
                    <p>Halaman : <?php echo $halaman4; ?></p>
                    <p>Berat : <?php echo $berat4; ?> gram</p>
                    <p>Harga : Rp <?php echo number_format($harga4, 0, ',', '.'); ?></p>
                    <p>Stok : <?php echo $stok4; ?> buku</p>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>