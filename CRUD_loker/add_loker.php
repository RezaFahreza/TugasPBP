<?php
session_start();
require_once('../db_login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idloker = $_POST['idloker'];
    $idperusahaan = $_POST['idperusahaan'];
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $usia_min = $_POST['usia_min'];
    $usia_max = $_POST['usia_max'];
    $gaji_min = $_POST['gaji_min'];
    $gaji_max = $_POST['gaji_max'];
    $nama_cp = $_POST['nama_cp'];
    $email_cp = $_POST['email_cp'];
    $no_telp_cp = $_POST['no_telp_cp'];
    $tgl_update = $_POST['tgl_update'];
    $tgl_aktif = $_POST['tgl_aktif'];
    $tgl_tutup = $_POST['tgl_tutup'];
    $status = $_POST['status'];
    

    $insertQuery = "INSERT INTO loker (idloker, idperusahaan, nama, tipe, usia_min, usia_max, gaji_min, gaji_max, nama_cp, email_cp, no_telp_cp, tgl_update, tgl_aktif, tgl_tutup, status) VALUES ('$idloker', '$idperusahaan', '$nama', '$tipe', $usia_min, $usia_max, $gaji_min, $gaji_max, '$nama_cp', '$email_cp', $no_telp_cp, '$tgl_update', '$tgl_aktif', '$tgl_tutup', 'status')";
    $insertResult = $db->query($insertQuery);

    if ($insertResult) {
        header("Location: ../index_loker.php");
        exit;
    } else {
        echo "Gagal menambahkan buku baru: " . $db->error;
    }
}
?>

<?php include('../header.html'); ?>

<div class="container mt-5">
    <h1>Tambah Loker</h1>
    <form method="POST">
        <div class="form-group">
            <label for="isbn">Id Loker:</label>
            <input type="text" class="form-control" id="idloker" name="idloker" required>
        </div>
        <div class="form-group">
            <label for="title">ID Perusahaan:</label>
            <input type="text" class="form-control" id="idperusahaan" name="idperusahaan" required>
        </div>
        <div class="form-group">
            <label for="isbn">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="title">Usia Minimal:</label>
            <input type="text" class="form-control" id="usia_min" name="usia_min" required>
        </div>
        <div class="form-group">
            <label for="isbn">Usia Maksimal:</label>
            <input type="text" class="form-control" id="usia_max" name="usia_max" required>
        </div>
        <div class="form-group">
            <label for="title">Gaji Minimal:</label>
            <input type="text" class="form-control" id="gaji_min" name="gaji_min" required>
        </div>
        <div class="form-group">
            <label for="isbn">Gaji Maksimal:</label>
            <input type="text" class="form-control" id="gaji_max" name="gaji_max" required>
        </div>
        <div class="form-group">
            <label for="title">Nama CP:</label>
            <input type="text" class="form-control" id="nama_cp" name="nama_cp" required>
        </div>
        <div class="form-group">
            <label for="isbn">Email CP:</label>
            <input type="text" class="form-control" id="email_cp" name="email_cp" required>
        </div>
        <div class="form-group">
            <label for="title">No.Telp CP:</label>
            <input type="text" class="form-control" id="no_telp_cp" name="no_telp_cp" required>
        </div>
        <div class="form-group">
            <label for="isbn">Tanggal Update:</label>
            <input type="text" class="form-control" id="tgl_update" name="tgl_update" required>
        </div>
        <div class="form-group">
            <label for="title">Tanggal Aktif:</label>
            <input type="text" class="form-control" id="tgl_aktif" name="tgl_aktif" required>
        </div>
        <div class="form-group">
            <label for="isbn">Tanggal Tutup:</label>
            <input type="text" class="form-control" id="tgl_tutup" name="tgl_tutup" required>
        </div>
        <div class="form-group">
            <label for="title">Status:</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary float-end">Add</button>
    </form>
</div>
<link rel="stylesheet" type="text/css" href="style/style.css">
<?php include('../footer.html'); ?>
