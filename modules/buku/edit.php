<?php
$page_title = "Edit Data Buku";
require_once '../../config/database.php';
require_once '../../includes/header.php';
 
// Cek apakah ada ID di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=ID buku tidak valid");
    exit();
}
 
$id_buku = (int)$_GET['id'];
$errors = [];
 
// Ambil data buku untuk ditampilkan di form
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        $stmt->close();
        closeConnection();
        header("Location: index.php?error=Buku tidak ditemukan");
        exit();
    }

    $buku = $result->fetch_assoc();
    $stmt->close();

    // Set variabel untuk form
    $kode_buku   = $buku['kode_buku'];
    $judul       = $buku['judul'];
    $kategori    = $buku['id_kategori'];
    $pengarang   = $buku['pengarang'];
    $penerbit    = $buku['id_penerbit'];
    $tahun       = $buku['tahun_terbit'];
    $isbn        = $buku['isbn'];
    $harga       = $buku['harga'];
    $stok        = $buku['stok'];
    $deskripsi   = $buku['deskripsi'];
}

// Proses update jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $kode_buku   = sanitize($_POST['kode_buku']);
    $judul       = sanitize($_POST['judul']);
    $kategori    = (int)$_POST['kategori'];
    $pengarang   = sanitize($_POST['pengarang']);
    $penerbit    = (int)$_POST['penerbit'];
    $tahun       = (int)$_POST['tahun'];
    $isbn        = sanitize($_POST['isbn']);
    $harga       = (float)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $deskripsi   = sanitize($_POST['deskripsi']);
    
    // Validasi (sama seperti create)
    if (empty($kode_buku)){
         $errors[] = "Kode buku wajib diisi";
    }

    if (empty($judul)){
        $errors[] = "Judul buku wajib diisi";
    } elseif (strlen($judul) < 3) {
        $errors[] = "Judul minimal 3 karakter";
    }

    if ($kategori == 0){
        $errors[] = "Kategori wajib dipilih";
    } 

    if (empty($pengarang)){
        $errors[] = "Pengarang wajib diisi";
    } 

    if ($penerbit == 0){
        $errors[] = "Penerbit wajib diisi";
    } 

    if (empty($tahun) || $tahun < 1900 || $tahun > date('Y')) {
        $errors[] = "Tahun terbit tidak valid";
    }
    
    if ($harga < 0) {
        $errors[] = "Harga tidak boleh negatif";
    }

    if ($stok < 0){
        $errors[] = "Stok tidak boleh negatif";
    } 

    // Cek kode buku duplikat (kecuali untuk buku ini sendiri)
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id_buku FROM buku WHERE kode_buku = ? AND id_buku != ?");
        $stmt->bind_param("si", $kode_buku, $id_buku);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Kode buku sudah digunakan oleh buku lain";
        }
        $stmt->close();
    }

    // Jika tidak ada error, update database
    if (empty($errors)) {
        $stmt = $conn->prepare("
            UPDATE buku SET 
                kode_buku = ?, 
                judul = ?, 
                id_kategori = ?, 
                pengarang = ?, 
                id_penerbit = ?, 
                tahun_terbit = ?, 
                isbn = ?, 
                harga = ?, 
                stok = ?, 
                deskripsi = ? 
            WHERE id_buku = ?
        ");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssissisdssi",
            $kode_buku,
            $judul,
            $kategori,
            $pengarang,
            $penerbit,
            $tahun,
            $isbn,
            $harga,
            $stok,
            $deskripsi,
            $id_buku
        );

        if ($stmt->execute()) {
            header("Location: index.php?success=Data berhasil diupdate");
            exit();
        } else {
            $errors[] = "Error database: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <div class="card">
                <div class="card-header bg-warning">
                    <h4>Edit Data Buku</h4>
                </div>

                <div class="card-body">

                    <!-- Tampilkan Error -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $e): ?>
                                    <li><?= $e ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <!-- Kode Buku & Judul -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Kode Buku</label>
                                <input type="text" name="kode_buku" class="form-control" value="<?= $kode_buku ?>" required>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label>Judul Buku</label>
                                <input type="text" name="judul" class="form-control" value="<?= $judul ?>" required>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="1" <?= ($kategori == 1 ? 'selected' : '') ?>>Programming</option>
                                <option value="2" <?= ($kategori == 2 ? 'selected' : '') ?>>Database</option>
                                <option value="3" <?= ($kategori == 3 ? 'selected' : '') ?>>Web Design</option>
                                <option value="4" <?= ($kategori == 4 ? 'selected' : '') ?>>Networking</option>
                            </select>
                        </div>

                        <!-- Pengarang & Penerbit -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" value="<?= $pengarang ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Penerbit (ID)</label>
                                <input type="number" name="penerbit" class="form-control" value="<?= $penerbit ?>" required>
                            </div>
                        </div>

                        <!-- Tahun & ISBN -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tahun</label>
                                <input type="number" name="tahun" class="form-control" value="<?= $tahun ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>ISBN</label>
                                <input type="text" name="isbn" class="form-control" value="<?= $isbn ?>">
                            </div>
                        </div>

                        <!-- Harga & Stok -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" value="<?= $harga ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" value="<?= $stok ?>" required>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"><?= $deskripsi ?></textarea>
                        </div>

                        <hr>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Update Data Buku</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
closeConnection();
require_once '../../includes/footer.php';
?>