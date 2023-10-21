<?php
session_start();
require_once('db_login.php');

// function getCategories() {
//     global $db;
//     $query = "SELECT * FROM categories";
//     $result = $db->query($query);
//     $categories = array();
//     while ($row = $result->fetch_assoc()) {
//         $categories[$row['categoryid']] = $row['name'];
//     }
//     return $categories;
// }

// function getCategoryName($categoryId) {
//     $categories = getCategories();
//     return isset($categories[$categoryId]) ? $categories[$categoryId] : '';
// }

$sql = "SELECT * FROM loker";
$result = $db->query($sql);
?>
<?php include('header.html'); ?>
<div class="card mt-5">
    <div class="card-header text-center" style="font-size: 24px; font-weight: bold;">Info Loker</div>
        <div class="card-body">
            <table class="table table-striped">
            <thead>
                <tr>
                    <td>idloker</td>
                    <td>idperusahaan</td>
                    <td>nama</td>
                    <td>usia_min</td>
                    <td>usia_max</td>
                    <td>gaji_min</td>
                    <td>gaji_max</td>
                    <td>nama_cp</td>
                    <td>email_cp</td>
                    <td>no_telp_cp</td>
                    <td>tgl_update</td>
                    <td>tgl_aktif</td>
                    <td>tgl_tutup</td>
                    <td>status</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['idloker'] . '</td>';
                        echo '<td>' . $row['idperusahaan'] . '</td>';
                        echo '<td>' . $row['nama'] . '</td>';
                        echo '<td>' . $row['usia_min'] . '</td>';
                        echo '<td>' . $row['usia_max'] . '</td>';
                        echo '<td>' . $row['gaji_min'] . '</td>';
                        echo '<td>' . $row['gaji_max'] . '</td>';
                        echo '<td>' . $row['nama_cp'] . '</td>';
                        echo '<td>' . $row['email_cp'] . '</td>';
                        echo '<td>' . $row['no_telp_cp'] . '</td>';
                        // echo '<td>' . getCategoryName($row['categoryid']) . '</td>';
                        echo '<td>' . $row['tgl_update'] . '</td>';
                        echo '<td>' . $row['tgl_aktif'] . '</td>';
                        echo '<td>' . $row['tgl_tutup'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '<td><a href="./CRUD_loker/edit_loker.php?idloker=' . $row['idloker'] . '" class="btn btn-primary">Edit</a> | <a href="./CRUD_loker/delete_loker.php?idloker=' . $row['idloker'] . '"class="btn btn-danger">Delete</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">Tidak ada data loker.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="search_loker.php" class="btn btn-info float-end">Search</a>
        <a href="./CRUD_loker/add_loker.php" class="btn btn-primary float-end">Tambah Loker</a>
    </div>
</div>
<?php include('footer.html'); ?>
