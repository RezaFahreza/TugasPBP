<?php
require_once("db_login.php");

if (isset($_GET['idloker'])) {
    $idloker = $_GET['idloker'];

    // Retrieve job applicants at different stages

    // Count the number of applicants for each stage
    $queryTahap1 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't1'";

    $queryTahap2 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't2'";

    $queryTahap3 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't3'";

    $resultTahap1 = $db->query($queryTahap1);
    $resultTahap2 = $db->query($queryTahap2);
    $resultTahap3 = $db->query($queryTahap3);

    $countTahap1 = $resultTahap1->fetch_assoc()['count'];
    $countTahap2 = $resultTahap2->fetch_assoc()['count'];
    $countTahap3 = $resultTahap3->fetch_assoc()['count'];

    // Determine the status of the job listing
    $status_loker = "";

    if ($countTahap1 > 0 && $countTahap2 == 0 && $countTahap3 == 0) {
        $status_loker = "Aktif";
    } elseif ($countTahap2 > 0) {
        $status_loker = "Proses Seleksi";
    } elseif ($countTahap1 == 0 && $countTahap2 == 0 && $countTahap3 > 0) {
        $status_loker = "Ditutup";
    }

    // Update the job listing status in the database
    $updateStatusQuery = "UPDATE loker SET status = '$status_loker', tgl_update = NOW() WHERE idloker = $idloker";
    $db->query($updateStatusQuery);

    echo $status_loker; // Mengembalikan status sebagai respons
}
?>