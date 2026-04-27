<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>
        
        <?php
        // Statistik awal
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop pertama untuk hitung statistik
        for ($i = 1; $i <= 10; $i++) {

            if ($i % 2 == 0) {
                continue;
            }

            if ($i == 8) {
                break;
            }

            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

            $total_transaksi++;

            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>
        
        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3 bg-primary text-white">
                    <h5>Total Transaksi</h5>
                    <p class="fs-3 mb-0"><?php echo $total_transaksi; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 bg-warning text-dark">
                    <h5>Dipinjam</h5>
                    <p class="fs-3 mb-0"><?php echo $total_dipinjam; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 bg-success text-white">
                    <h5>Dikembalikan</h5>
                    <p class="fs-3 mb-0"><?php echo $total_dikembalikan; ?></p>
                </div>
            </div>
        </div>
        
        <!-- Tabel -->
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 1; $i <= 10; $i++) {

                    if ($i % 2 == 0) {
                        continue;
                    }

                    if ($i == 8) {
                        break;
                    }

                    $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    $nama_peminjam = "Anggota " . $i;
                    $judul_buku = "Buku Teknologi Vol. " . $i;

                    $tanggal_pinjam = date("Y-m-d", strtotime("-$i days"));
                    $tanggal_kembali = date("Y-m-d", strtotime("+7 days", strtotime($tanggal_pinjam)));

                    $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                    // biar gak koma
                    $hari = floor((strtotime(date("Y-m-d")) - strtotime($tanggal_pinjam)) / (60 * 60 * 24));

                    // badge warna
                    if ($status == "Dipinjam") {
                        $badge = "bg-warning text-dark";
                    } else {
                        $badge = "bg-success";
                    }

                    echo "<tr>
                        <td>$i</td>
                        <td>$id_transaksi</td>
                        <td>$nama_peminjam</td>
                        <td>$judul_buku</td>
                        <td>$tanggal_pinjam</td>
                        <td>$tanggal_kembali</td>
                        <td>$hari hari</td>
                        <td><span class='badge $badge'>$status</span></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>