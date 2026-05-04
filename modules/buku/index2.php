<?php
$page_title = "Data Buku";
require_once '../../config/database.php';
require_once '../../includes/header.php';
 
// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
 
// Search
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
 
// Build query
if (!empty($search)) {
    $query = "SELECT * FROM buku 
              WHERE judul LIKE ? OR pengarang LIKE ? OR kategori LIKE ?
              ORDER BY created_at DESC 
              LIMIT ? OFFSET ?";
    
    $search_param = "%$search%";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $search_param, $search_param, $search_param, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Count total
    $count_query = "SELECT COUNT(*) as total FROM buku 
                    WHERE judul LIKE ? OR pengarang LIKE ? OR kategori LIKE ?";
    $stmt_count = $conn->prepare($count_query);
    $stmt_count->bind_param("sss", $search_param, $search_param, $search_param);
    $stmt_count->execute();
    $total_rows = $stmt_count->get_result()->fetch_assoc()['total'];
    
} else {
    $query = "SELECT * FROM buku ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $total_rows = $conn->query("SELECT COUNT(*) as total FROM buku")->fetch_assoc()['total'];
}
 
$total_pages = ceil($total_rows / $limit);
?>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2><i class="bi bi-book"></i> Data Buku Perpustakaan</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="create.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Buku Baru
            </a>
        </div>
    </div>
    
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show">';
        echo '<i class="bi bi-check-circle"></i> ' . htmlspecialchars($_GET['success']);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '</div>';
    }
    
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show">';
        echo '<i class="bi bi-x-circle"></i> ' . htmlspecialchars($_GET['error']);
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
        echo '</div>';
    }
    ?>

    <!-- Search -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           value="<?php echo htmlspecialchars($search); ?>"
                           placeholder="Cari judul, pengarang, atau kategori...">
                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="index.php" class="btn btn-secondary">Reset</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Daftar Buku
                <?php if (!empty($search)): ?>
                    <span class="badge bg-light text-dark">
                        "<?php echo htmlspecialchars($search); ?>"
                    </span>
                <?php endif; ?>
            </h5>
        </div>

        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = $offset + 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['kode_buku']; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['id_kategori']; ?></td>
                        <td><?php echo $row['pengarang']; ?></td>
                        <td><?php echo $row['id_penerbit']; ?></td>
                        <td><?php echo $row['tahun_terbit']; ?></td>
                        <td><?php echo number_format($row['harga']); ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id_buku']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['id_buku']; ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li>
                        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
            <?php endif; ?>

            <?php else: ?>
                <p>Tidak ada data</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
if (isset($stmt)) $stmt->close();
if (isset($stmt_count)) $stmt_count->close();
closeConnection();
require_once '../../includes/footer.php';
?>