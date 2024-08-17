<?php
include 'koneksi.php';

// Mengambil nilai post
$id_project = $_GET['id_project'];

// Query
$query_hapus = "DELETE FROM project WHERE id_project = '$id_project'";
$hapus = mysqli_query($db, $query_hapus);

// Cek
if ($hapus) {
    header("location: ../projects.php");
    exit();
    
} else {
    echo "Gagal menghapus data: " . mysqli_error($db);
}
?>