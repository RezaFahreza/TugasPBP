<?php
session_start();
require_once('db_login.php');

// Query to fetch job openings grouped by status
$query = "SELECT l.*, COUNT(a.idapply) as total_applied
          FROM loker l
          LEFT JOIN apply_loker a ON l.idloker = a.idloker
          GROUP BY l.idloker, l.status
          ORDER BY l.status";

$result = $db->query($query);

if (!$result) {
    die("Error: " . $db->error);
}

?>

<?php include ("header.html");?>
<div class="card mt-5">
    <div class="card-header text-center" style="font-size: 24px; font-weight: bold;">Daftar Loker</div>
        <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Job Title</th>
                <th>Status</th>
                <th>Total Applied</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                $jobStatus = $row['status'];
                $statusText = ($jobStatus == 1) ? "Aktif" : ($jobStatus == 2 ? "Proses Seleksi" : "Ditutup");
                echo "<tr>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $statusText . "</td>";
                echo "<td>" . $row['total_applied'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index_loker.php" class="btn btn-info float-end">Loker</a>
</div>

<?php include ("footer.html"); ?>

<?php
$db->close(); // Close the database connection
?>