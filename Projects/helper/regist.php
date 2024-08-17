<?php
include 'koneksi.php'; 
$register_message = "";
//mengambil nilai post
$username=$_POST['username'];
$password=$_POST['password'];

//query
$query_simpan = "INSERT INTO account (username, password) 
                VALUES ('$username', '$password')";

$simpan=mysqli_query($db,$query_simpan);

//cek
if ($simpan) {
	$register_messsage = "Akun Berhasil Terdaftar, Silahkan Login";
	header("location: ../register.php");
	exit();
}
else{
	echo "Kesalahan Memasukan Data <br>";
}
 ?>

 