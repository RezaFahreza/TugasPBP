<?php
session_start();
require_once('db_login.php');

$sql = "SELECT l.idloker, p.nama AS nama_perusahaan, l.nama, l.tgl_update, l.tgl_aktif, l.tgl_tutup, l.status
        FROM loker l
        INNER JOIN perusahaan p ON l.idperusahaan = p.idperusahaan
        ORDER BY l.status"; // Urutkan berdasarkan status

$result = $db->query($sql);

// Kelompokkan lowongan pekerjaan berdasarkan status
$loker_by_status = array();
while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    if (!isset($loker_by_status[$status])) {
        $loker_by_status[$status] = array();
    }
    $loker_by_status[$status][] = $row;
}
?>
<?php include('header.html'); ?>
<div class="card mt-5">
    <div class="card-header text-center" style="font-size: 24px; font-weight: bold;">Info Loker</div>
    <div class="card-body">
        <?php
        // Iterate through each status group
        foreach ($loker_by_status as $status => $loker_group) {
            echo '<h3>' . $status . '</h3>'; // Display the status as a heading
        ?>
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Lowongan</th>
                        <th>Tanggal Update</th>
                        <th>Tanggal Aktif</th>
                        <th>Tanggal Tutup</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_number = 1; // Initialize the row number counter
                    foreach ($loker_group as $row) {
                        echo '<tr>';
                        echo '<td>' . $row_number . '</td>'; // Display the row number
                        echo '<td>' . $row['nama_perusahaan'] . '</td>'; // Display the company name
                        echo '<td>' . $row['nama'] . '</td>';
                        echo '<td>' . $row['tgl_update'] . '</td>';
                        echo '<td>' . $row['tgl_aktif'] . '</td>';
                        echo '<td>' . $row['tgl_tutup'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td><a class="btn btn-link" href="./CRUD_loker/view_loker.php?idloker=' . $row['idloker'] . '" role="button">Details</a><a href="./CRUD_loker/edit_loker.php?idloker=' . $row['idloker'] . '" class="btn btn-primary">Edit</a><a href="./CRUD_loker/delete_loker.php?idloker=' . $row['idloker'] . '"class="btn btn-danger">Delete</a></td>';
                        echo '</tr>';
                        $row_number++; // Increment the row number counter
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
        <a href="./CRUD_loker/add_loker.php" class="btn btn-primary float-end">Tambah Loker</a>
    </div>
</div>
<?php include('footer.html'); ?>