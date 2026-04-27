-- TABEL ANGGOTA
CREATE TABLE anggota (
    id_anggota INT AUTO_INCREMENT PRIMARY KEY,
    kode_anggota VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telepon VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    pekerjaan VARCHAR(50),
    tanggal_daftar DATE NOT NULL,
    status ENUM('Aktif', 'Nonaktif') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- INSERT ANGGOTA
INSERT INTO anggota (...) VALUES
('AGT-001', 'Budi Santoso', 'budi.santoso@email.com', '081234567890', 'Jakarta', '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif'),
('AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', 'Aktif');

-- QUERY ANGGOTA
-- Semua anggota aktif
SELECT * FROM anggota WHERE status = 'Aktif';
 
-- Anggota perempuan
SELECT * FROM anggota WHERE jenis_kelamin = 'Perempuan';
 
-- Anggota mahasiswa
SELECT * FROM anggota WHERE pekerjaan = 'Mahasiswa';
 
-- Hitung anggota per pekerjaan
SELECT pekerjaan, COUNT(*) as jumlah 
FROM anggota 
GROUP BY pekerjaan;
 
-- Anggota terdaftar bulan Februari
SELECT * FROM anggota 
WHERE MONTH(tanggal_daftar) = 2 AND YEAR(tanggal_daftar) = 2024;
 
-- Hitung umur anggota
SELECT 
    nama,
    tanggal_lahir,
    YEAR(CURDATE()) - YEAR(tanggal_lahir) as umur
FROM anggota;

-- TABEL TRANSAKSI
CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE,
    tanggal_harus_kembali DATE NOT NULL,
    status ENUM('Dipinjam', 'Dikembalikan', 'Terlambat') DEFAULT 'Dipinjam',
    denda DECIMAL(10,2) DEFAULT 0,
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id_anggota)
);

-- INSERT TRANSAKSI
INSERT INTO transaksi (id_buku, id_anggota, tanggal_pinjam, tanggal_harus_kembali, status) 
VALUES 
(1, 1, '2024-02-01', '2024-02-08', 'Dipinjam'),
(2, 2, '2024-02-03', '2024-02-10', 'Dipinjam');

-- JOIN
SELECT 
    t.id_transaksi,
    b.judul AS nama_buku,
    a.nama AS nama_anggota,
    t.tanggal_pinjam,
    t.status
FROM transaksi t
JOIN buku b ON t.id_buku = b.id_buku
JOIN anggota a ON t.id_anggota = a.id_anggota;