<?php
include 'koneksi.php'; 
//mengambil nilai post
$project_name=$_POST['project_name'];
$progress=$_POST['progress'];
$owner=$_POST['owner'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];


//query
$query_simpan = "INSERT INTO project (project_name, progress, owner, start_date, end_date) 
                VALUES ('$project_name', '$progress', '$owner', '$start_date', '$end_date')";

$simpan=mysqli_query($db,$query_simpan);




//cek
if ($simpan) {
	header("location: ../projects.php");
	exit();
}
else{
	echo "Kesalahan Memasukan Data <br>";
}
 ?>