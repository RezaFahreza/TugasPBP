<?php
session_start();
require_once('../db_login.php');


if (isset($_GET['idloker'])) {
    $idloker = $_GET['idloker'];

    // Query database untuk mendapatkan data loker berdasarkan ID
    $query = "SELECT * FROM loker WHERE idloker = $idloker";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data loker tidak ditemukan.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang diinput dari form
    $idloker = $_POST['idloker'];
    $idperusahaan = $_POST['idperusahaan'];
    $nama = $_POST['nama'];
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

    // Validasi input (Anda dapat menambahkan validasi tambahan sesuai kebutuhan)
    if (empty($idperusahaan) || empty($nama) || empty($usia_min) || empty($usia_max) || empty($gaji_min) || empty($gaji_max) || empty($nama_cp) || empty($email_cp) || empty($no_telp_cp) || empty($tgl_update) || empty($tgl_aktif) || empty($tgl_tutup) || empty($status)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Query SQL untuk mengupdate data loker
        $update_query = "UPDATE loker SET idperusahaan='$idperusahaan', nama='$nama', usia_min='$usia_min', usia_max='$usia_max', gaji_min='$gaji_min', gaji_max='$gaji_max', nama_cp='$nama_cp', email_cp='$email_cp', no_telp_cp='$no_telp_cp', tgl_update='$tgl_update', tgl_aktif='$tgl_aktif', tgl_tutup='$tgl_tutup', status='$status' WHERE idloker='$idloker'";
        $update_result = $db->query($update_query);

        if ($update_result) {
            // Data berhasil diupdate, alihkan ke halaman lain atau lakukan tindakan lain sesuai kebutuhan.
            header("Location: ../index_loker.php");
            exit;
        } else {
            echo "Gagal mengupdate data loker: " . $db->error;
        }
    }
}

?>

<?php include('../header.html'); ?>

<div class="card mt-5">
    <div class="card-header text-center" style="font-size: 24px; font-weight: bold;">Edit Loker</div>
    <div class="card-body">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="idloker" value="<?php echo $row['idloker']; ?>">
            <!-- Isi form sesuai dengan kolom yang ingin diubah -->
            <div class="mb-3">
                <label for="idperusahaan" class="form-label">ID Perusahaan</label>
                <input type="text" class="form-control" name="idperusahaan" value="<?php echo $row['idperusahaan']; ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="usia_min" class="form-label">Usia Minimal</label>
                <input type="number" class="form-control" name="usia_min" value="<?php echo $row['usia_min']; ?>">
            </div>
            <div class="mb-3">
                <label for="usia_max" class= "form-label">Usia Maksimal</label>
                <input type="number" class="form-control" name="usia_max" value="<?php echo $row['usia_max']; ?>">
            </div>
            <div class="mb-3">
                <label for="gaji_min" class="form-label">Gaji Minimal</label>
                <input type="number" class="form-control" name="gaji_min" value="<?php echo $row['gaji_min']; ?>">
            </div>
            <div class="mb-3">
                <label for="gaji_max" class="form-label">Gaji Maksimal</label>
                <input type="number" class="form-control" name="gaji_max" value="<?php echo $row['gaji_max']; ?>">
            </div>
            <div class="mb-3">
                <label for="nama_cp" class="form-label">Nama CP</label>
                <input type="text" class="form-control" name="nama_cp" value="<?php echo $row['nama_cp']; ?>">
            </div>
            <div class="mb-3">
                <label for="email_cp" class="form-label">Email CP</label>
                <input type="text" class="form-control" name="email_cp" value="<?php echo $row['email_cp']; ?>">
            </div>
            <div class="mb-3">
                <label for="no_telp_cp" class="form-label">No. Telepon CP</label>
                <input type="text" class="form-control" name="no_telp_cp" value="<?php echo $row['no_telp_cp']; ?>">
            </div>
            <div class="mb-3">
                <label for="tgl_update" class="form-label">Tanggal Update</label>
                <input type="text" class="form-control" name="tgl_update" value="<?php echo $row['tgl_update']; ?>">
            </div>
            <div class="mb-3">
                <label for="tgl_aktif" class="form-label">Tanggal Aktif</label>
                <input type="text" class="form-control" name="tgl_aktif" value="<?php echo $row['tgl_aktif']; ?>">
            </div>
            <div class="mb-3">
                <label for="tgl_tutup" class="form-label">Tanggal Tutup</label>
                <input type="text" class="form-control" name="tgl_tutup" value="<?php echo $row['tgl_tutup']; ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" name="status" value="<?php echo $row['status']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php include('../footer.html'); ?>
