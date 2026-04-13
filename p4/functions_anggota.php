<?php
// 1. Hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $anggota) {
        if ($anggota['status'] == "Aktif") {
            $total++;
        }
    }
    return $total;
}

// 3. Hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $anggota) {
        $total += $anggota['total_pinjam'];
    }
    return count($anggota_list) > 0 ? $total / count($anggota_list) : 0;
}

// 4. Cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $anggota) {
        if ($anggota['id'] == $id) {
            return $anggota;
        }
    }
    return null;
}

// 5. Cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $teraktif = null;
    foreach ($anggota_list as $anggota) {
        if ($teraktif == null || $anggota['total_pinjam'] > $teraktif['total_pinjam']) {
            $teraktif = $anggota;
        }
    }
    return $teraktif;
}

// 6. Filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if ($anggota['status'] == $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}

// 7. Validasi email
function validasi_email($email) {
    return !empty($email) && strpos($email, '@') !== false && strpos($email, '.') !== false;
}

// 8. Format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        1 => "Januari","Februari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"
    ];

    $pecah = explode('-', $tanggal);
    return $pecah[2] . " " . $bulan[(int)$pecah[1]] . " " . $pecah[0];
}

// BONUS 1: Sort anggota by nama (A-Z)
function sort_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a['nama'], $b['nama']);
    });
    return $anggota_list;
}

// BONUS 2: Search anggota by nama
function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if (stripos($anggota['nama'], $keyword) !== false) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
?>