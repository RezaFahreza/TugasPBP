<?php
require_once("db_login.php");

if (isset($_GET['idloker'])) {
    $idloker = $_GET['idloker'];

    // Retrieve job applicants at different stages

    // Tahap 1 (Administrasi)
    $queryTahap1 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't1'";

    $resultTahap1 = $db->query($queryTahap1);
    $rowTahap1 = $resultTahap1->fetch_assoc();
    $countTahap1 = $rowTahap1['count'];

    // Tahap 2 (Wawancara)
    $queryTahap2 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't2'";

    $resultTahap2 = $db->query($queryTahap2);
    $rowTahap2 = $resultTahap2->fetch_assoc();
    $countTahap2 = $rowTahap2['count'];

    // Tahap 3 (Lolos Wawancara)
    $queryTahap3 = "SELECT COUNT(*) AS count FROM apply_loker
        LEFT JOIN tahapan_apply ON apply_loker.idapply = tahapan_apply.idapply
        WHERE apply_loker.idloker = $idloker AND tahapan_apply.idtahapan = 't3'";

    $resultTahap3 = $db->query($queryTahap3);
    $rowTahap3 = $resultTahap3->fetch_assoc();
    $countTahap3 = $rowTahap3['count'];

    // Determine the status of the job listing
    $status_loker = "";
    if ($countTahap1 > 0 && $countTahap2 == 0 && $countTahap3 == 0) {
        $status_loker = "Aktif";
    }
    if ($countTahap2 > 0) {
        $status_loker = "Proses Seleksi";
    }
    if ($countTahap3 > 0 && $countTahap2 == 0) {
        $status_loker = "Ditutup";
    }

    // Update the job listing status in the database
    $updateStatusQuery = "UPDATE loker SET status = '$status_loker', tgl_update = NOW() WHERE idloker = $idloker";
    $db->query($updateStatusQuery);

    echo $status_loker; // Mengembalikan status sebagai respons
}
