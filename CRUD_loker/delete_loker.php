<?php
session_start();
require_once('../db_login.php');

if (isset($_GET['idloker'])) {
    $idloker = $_GET['idloker'];
    $query = "SELECT * FROM loker WHERE idloker = '$idloker'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
    } else {
        echo "Loker dengan ID $idloker tidak ditemukan.";
        exit;
    }
} else {
    echo "idloker tidak valid.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteQuery = "DELETE FROM loker WHERE idloker = '$idloker'";
    $deleteResult = $db->query($deleteQuery);

    if ($deleteResult) {
        header("Location: ../index_loker.php");
        exit;
    } else {
        echo "Gagal menghapus data buku: " . $db->error;
    }
}
?>
<?php include('../header.html'); ?>
<div class="container mt-5">
    <h1>Delete Book</h1>
    <p>Anda yakin ingin menghapus buku dengan ID <?php echo $idloker; ?> Bernama "<?php echo $nama; ?>"?</p>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Hapus</button>
        <a href="../index_loker.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<link rel="stylesheet" type="text/css" href="style/style.css">
<?php include('../footer.html'); ?>