<?php
include 'koneksi.php';
//mengambil Nilai Post


$id_project = $_POST['id_project'];
$project_name = $_POST['project_name'];
$progress = $_POST['progress'];
$owner = $_POST['owner'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];


//query 
$query_update="UPDATE `project` 
                 SET `project_name` = '$project_name', 
				 	 `progress` = '$progress',
                     `owner` = '$owner', 
                     `start_date` = '$start_date', 
                     `end_date` = '$end_date'
                     
                 WHERE `project`.`id_project` = '$id_project'";

$update=mysqli_query($db,$query_update);

if ($update) {
    header("location: ../projects.php");
}
else{
	echo "gagal <br>";
}

 ?>
