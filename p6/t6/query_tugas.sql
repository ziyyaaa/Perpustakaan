-- ========== STATISTIK BUKU ==========
-- 1. Total buku seluruhnya
SELECT COUNT(*) AS total_buku FROM buku;

-- 2. Total nilai inventaris
SELECT SUM(harga * stok) AS total_inventaris FROM buku;

-- 3. Rata-rata harga buku
SELECT AVG(harga) AS rata_rata_harga FROM buku;

-- 4. Buku termahal
SELECT judul, harga 
FROM buku
ORDER BY harga DESC
LIMIT 1;

-- 5. Buku dengan stok terbanyak
SELECT judul, stok 
FROM buku
ORDER BY stok DESC
LIMIT 1;

-- ========== FILTER dan PENCARIAN ==========
-- 1. Buku Programming harga < 100000
SELECT * 
FROM buku
WHERE kategori = 'Programming' AND harga < 100000;

-- 2. Judul mengandung PHP atau MySQL
SELECT * 
FROM buku
WHERE judul LIKE '%PHP%' OR judul LIKE '%MySQL%';

-- 3. Buku terbit tahun 2024 (karena INT, langsung =)
SELECT * 
FROM buku
WHERE tahun_terbit = 2024;

-- 4. Stok antara 5 - 10
SELECT * 
FROM buku
WHERE stok BETWEEN 5 AND 10;

-- 5. Pengarang Budi Raharjo
SELECT * 
FROM buku
WHERE pengarang = 'Budi Raharjo';

-- ========== GROUPING dan AGREGASI ==========
-- 1. Jumlah buku & total stok per kategori
SELECT kategori, COUNT(*) AS jumlah_buku, SUM(stok) AS total_stok
FROM buku
GROUP BY kategori;

-- 2. Rata-rata harga per kategori
SELECT kategori, AVG(harga) AS rata_rata_harga
FROM buku
GROUP BY kategori;

-- 3. Kategori dengan nilai inventaris terbesar
SELECT kategori, SUM(harga * stok) AS total_inventaris
FROM buku
GROUP BY kategori
ORDER BY total_inventaris DESC
LIMIT 1;

-- ========== UPDATE DATA ==========
-- 1. Naikkan harga Programming 5%
UPDATE buku
SET harga = harga * 1.05
WHERE kategori = 'Programming';

-- 2. Tambah stok 10 jika stok < 5
UPDATE buku
SET stok = stok + 10
WHERE stok < 5;

-- ========== LAPORAN KHUSUS ==========
-- 1. Buku yang perlu restocking
SELECT * 
FROM buku
WHERE stok < 5;

-- 2. Top 5 buku termahal
SELECT judul, harga
FROM buku
ORDER BY harga DESC
LIMIT 5;