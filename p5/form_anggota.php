<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
$errors = [];
$successData = [];

$data = [
    "nama" => "",
    "email" => "",
    "telepon" => "",
    "alamat" => "",
    "jk" => "",
    "tgl_lahir" => "",
    "pekerjaan" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($data as $key => $val) {
        $data[$key] = htmlspecialchars(trim($_POST[$key] ?? ""));
    }

    // Validasi
    if (strlen($data["nama"]) < 3) {
        $errors["nama"] = "Nama minimal 3 karakter";
    }

    if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email tidak valid";
    }

    if (!preg_match('/^08[0-9]{8,11}$/', $data["telepon"])) {
        $errors["telepon"] = "Format telepon harus 08xxxxxxxxxx (10-13 digit)";
    }

    if (strlen($data["alamat"]) < 10) {
        $errors["alamat"] = "Alamat minimal 10 karakter";
    }

    if (empty($data["jk"])) {
        $errors["jk"] = "Pilih jenis kelamin";
    }

    if (!empty($data["tgl_lahir"])) {
        $birth = new DateTime($data["tgl_lahir"]);
        $today = new DateTime();
        $age = $today->diff($birth)->y;

        if ($age < 10) {
            $errors["tgl_lahir"] = "Umur minimal 10 tahun";
        }
    } else {
        $errors["tgl_lahir"] = "Tanggal lahir wajib diisi";
    }

    if (empty($data["pekerjaan"])) {
        $errors["pekerjaan"] = "Pilih pekerjaan";
    }

    // Succes
    if (empty($errors)) {
        $successData = $data;

        // Reset Form
        foreach ($data as $key => $val) {
            $data[$key] = "";
        }
    }
}
?>

<div class="container mt-5">
    <h3 class="mb-4">Form Registrasi Anggota</h3>

    <div class="card p-4 shadow-sm">
        <form method="POST">

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama"
                    class="form-control <?= isset($errors["nama"]) ? 'is-invalid' : '' ?>"
                    value="<?= $data["nama"] ?>">
                <div class="invalid-feedback"><?= $errors["nama"] ?? "" ?></div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                    class="form-control <?= isset($errors["email"]) ? 'is-invalid' : '' ?>"
                    value="<?= $data["email"] ?>">
                <div class="invalid-feedback"><?= $errors["email"] ?? "" ?></div>
            </div>

            <!-- Telepon -->
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon"
                    class="form-control <?= isset($errors["telepon"]) ? 'is-invalid' : '' ?>"
                    value="<?= $data["telepon"] ?>">
                <div class="invalid-feedback"><?= $errors["telepon"] ?? "" ?></div>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                    class="form-control <?= isset($errors["alamat"]) ? 'is-invalid' : '' ?>"><?= $data["alamat"] ?></textarea>
                <div class="invalid-feedback"><?= $errors["alamat"] ?? "" ?></div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Laki-laki"
                        <?= $data["jk"]=="Laki-laki"?"checked":"" ?>>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jk" value="Perempuan"
                        <?= $data["jk"]=="Perempuan"?"checked":"" ?>>
                    <label class="form-check-label">Perempuan</label>
                </div>
                <div class="text-danger small"><?= $errors["jk"] ?? "" ?></div>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir"
                    class="form-control <?= isset($errors["tgl_lahir"]) ? 'is-invalid' : '' ?>"
                    value="<?= $data["tgl_lahir"] ?>">
                <div class="invalid-feedback"><?= $errors["tgl_lahir"] ?? "" ?></div>
            </div>

            <!-- Pekerjaan -->
            <div class="mb-3">
                <label class="form-label">Pekerjaan</label>
                <select name="pekerjaan"
                    class="form-select <?= isset($errors["pekerjaan"]) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih --</option>
                    <?php foreach (["Pelajar","Mahasiswa","Pegawai","Lainnya"] as $opt): ?>
                        <option value="<?= $opt ?>" <?= $data["pekerjaan"]==$opt?"selected":"" ?>>
                            <?= $opt ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $errors["pekerjaan"] ?? "" ?></div>
            </div>

            <button class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>

    <!-- SUCCESS -->
    <?php if (!empty($successData)): ?>
        <div class="card mt-4 shadow-sm border-success">

            <div class="card-header bg-success text-white text-center">
                <h5 class="mb-0">Registrasi Berhasil!</h5>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><b>Nama:</b> <?= $successData["nama"] ?></li>
                    <li class="list-group-item"><b>Email:</b> <?= $successData["email"] ?></li>
                    <li class="list-group-item"><b>Telepon:</b> <?= $successData["telepon"] ?></li>
                    <li class="list-group-item"><b>Alamat:</b> <?= $successData["alamat"] ?></li>
                    <li class="list-group-item"><b>Jenis Kelamin:</b> <?= $successData["jk"] ?></li>
                    <li class="list-group-item"><b>Tanggal Lahir:</b> <?= $successData["tgl_lahir"] ?></li>
                    <li class="list-group-item"><b>Pekerjaan:</b> <?= $successData["pekerjaan"] ?></li>
                </ul>
            </div>

        </div>
    <?php endif; ?>

</div>

</body>
</html>