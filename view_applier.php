<?php
session_start();
require_once("db_login.php");

// Fungsi untuk mengonversi jenis kelamin
function getGender($gender)
{
    if ($gender == 'L') {
        return 'Laki-laki';
    } elseif ($gender == 'P') {
        return 'Perempuan';
    } else {
        return 'Tidak Diketahui';
    }
}

if (isset($_POST['action'])) {
    $noktp = $_POST['noktp'];
    $action = $_POST['action'];

    // Query untuk mengambil idloker berdasarkan noktp
    $queryIdLoker = "SELECT idloker FROM apply_loker WHERE noktp = '$noktp'";
    $resultIdLoker = $db->query($queryIdLoker);

    if (!$resultIdLoker) {
        die("Could not query the database: <br />" . $db->error . "<br>Query:" . $queryIdLoker);
    }

    if ($resultIdLoker->num_rows == 1) {
        $rowIdLoker = $resultIdLoker->fetch_object();
        $idloker = $rowIdLoker->idloker;

        if ($action == 'lolos') {
            // Update tahapan applier menjadi 't2'
            $updateQuery = "UPDATE tahapan_apply SET idtahapan = 't2' WHERE idapply = (SELECT idapply FROM apply_loker WHERE noktp = '$noktp')";
            $result = $db->query($updateQuery);
        } elseif ($action == 'tidak_lolos') {
            // Hapus applier dari tahapan_apply
            $deleteQuery = "DELETE FROM tahapan_apply WHERE idapply = (SELECT idapply FROM apply_loker WHERE noktp = '$noktp')";
            $result = $db->query($deleteQuery);
        }
        header("Location: ./Seleksi/seleksi_administrasi.php?idloker=$idloker");
    } else {
        echo "Loker tidak ditemukan.";
    }
}

?>


<?php include('header.html') ?>

<?php 
if (isset($_GET['noktp'])) {
    $noktp = $_GET['noktp'];

    // Query untuk mengambil idloker berdasarkan noktp
    $queryIdLoker = "SELECT DISTINCT apply_loker.idloker
                    FROM apply_loker
                    WHERE apply_loker.noktp = '$noktp'";
    $resultIdLoker = $db->query($queryIdLoker);

    if (!$resultIdLoker) {
        die("Could not query the database: <br />" . $db->error . "<br>Query:" . $queryIdLoker);
    }

    if ($resultIdLoker->num_rows > 0) {
        // Loop melalui hasil query untuk mengambil idloker yang sesuai
        $idLokerArray = array();
        while ($rowIdLoker = $resultIdLoker->fetch_object()) {
            $idLokerArray[] = $rowIdLoker->idloker;
        }
    }
}
?>

<?php
if (isset($_GET['noktp'])) {
    $noktp = $_GET['noktp'];
    
    // Query untuk mengambil data lengkap applier berdasarkan Nomor KTP
    $query = "SELECT pencaker.*, tahapan.nama as tahapan
              FROM pencaker
              LEFT JOIN apply_loker ON pencaker.noktp = apply_loker.noktp
              LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
              LEFT JOIN tahapan ON tahapan_apply.idtahapan = tahapan.idtahapan
              WHERE pencaker.noktp = '$noktp'";
    $result = $db->query($query);

    if (!$result) {
        die("Could not query the database: <br />" . $db->error . "<br>Query:" . $query);
    }
    if ($result->num_rows == 1) {
        $row = $result->fetch_object();
?>

        <div class="card mt-5">
            <div class="card-header">
                <h3 class="mb-4">Detail Applier</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <table class="table mt-3">
                        <tr>
                            <th>Nomor KTP:</th>
                            <td><?php echo $row->noktp; ?></td>
                        </tr>
                        <tr>
                            <th>Nama:</th>
                            <td><?php echo $row->nama; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin:</th>
                            <td><?php echo getGender($row->jenis_kelamin); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir:</th>
                            <td><?php echo $row->tempat_lahir; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir:</th>
                            <td><?php echo $row->tanggal_lahir; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat:</th>
                            <td><?php echo $row->alamat; ?></td>
                        </tr>
                        <tr>
                            <th>Kota:</th>
                            <td><?php echo $row->kota; ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?php echo $row->email; ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon:</th>
                            <td><?php echo $row->no_telp; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar:</th>
                            <td><?php echo $row->tgl_daftar; ?></td>
                        </tr>
                        <tr>
                            <th>Tahapan:</th>
                            <td><?php echo $row->tahapan; ?></td>
                        </tr>
                        <tr>
                            <th>Foto KTP:</th>
                            <td>
                                <?php
                                $fotoKTP = $row->file_ktp;
                                $fotoKTPPath = 'uploads/' . $fotoKTP;
                                if (file_exists($fotoKTPPath)) {
                                    echo '<img src="' . $fotoKTPPath . '" alt="Foto KTP" width="200">';
                                } else {
                                    echo 'Foto KTP tidak tersedia.';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <div class="form-group mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" name="action" value="lolos" class="btn btn-success">Lolos Administrasi</button>
                        <button type="submit" name="action" value="tidak_lolos" class="btn btn-danger">Tidak Lolos</button>
                    </div>
                    <input type="hidden" name="noktp" value="<?php echo $noktp; ?>">
                </form>
            </div>
        </div>

<?php
    } else {
        echo "Applier tidak ditemukan.";
    }
} else {
    echo "Invalid Nomor KTP.";
}
?>

<?php include('footer.html') ?>