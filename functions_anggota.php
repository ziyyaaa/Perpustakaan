<?php
// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}
 
// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $jumlah = 0;
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] === "Aktif") {
            $jumlah++;
        }
    }
    return $jumlah;
}
 
// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $anggota) {
        $total += $anggota["total_pinjaman"];
    }
    return count($anggota_list) > 0 ? $total / count($anggota_list) : 0;
}
 
// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $anggota) {
        if ($anggota["id"] === $id) {
            return $anggota;
        }
    }
    return null;
}
 
// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $teraktif = null;
    foreach ($anggota_list as $anggota) {
        if ($teraktif === null || $anggota["total_pinjaman"] > $teraktif["total_pinjaman"]) {
            $teraktif = $anggota;
        }
    }
    return $teraktif;
}
 
// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] === $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
 
// 7. Function untuk validasi email
function validasi_email($email) {
    return !empty($email) && strpos($email, "@") !== false && strpos($email, ".") !== false;
}
 
// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        "01" => "Januari", "02" => "Februari", "03" => "Maret",
        "04" => "April", "05" => "Mei", "06" => "Juni",
        "07" => "Juli", "08" => "Agustus", "09" => "September",
        "10" => "Oktober", "11" => "November", "12" => "Desember"
    ];
    
    $pecah = explode("-", $tanggal);
    return $pecah[2] . " " . $bulan[$pecah[1]] . " " . $pecah[0];
}

// Bonus
function sort_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a["nama"], $b["nama"]);
    });
    return $anggota_list;
}

function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if (stripos($anggota["nama"], $keyword) !== false) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
?>