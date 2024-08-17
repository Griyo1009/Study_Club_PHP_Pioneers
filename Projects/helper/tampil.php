<?php 
//koneksi
include 'koneksi.php';
//query
$query_tampil="SELECT * FROM tbanggota order by idanggota desc";
$data=mysqli_query($db,$query_tampil);
?>

<!-- Bagian Header Data -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Sistem Perpustakaan</title>
</head>

<?php 
  $no=1;
  //perulangan
  while ($d=mysqli_fetch_array($data)) {
  //perintah Menampilkan data
  echo $d['idanggota']."<br"; 

 ?>

<!-- Bagian Isi Data -->

<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Anggota</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="databuku.php">Buku</a>
        </li>
    </ul>
    <h1 align="center">Anggota</h1>
    <a href="tambahanggota.php">Tombol Tambah anggota</a>
    <table>
        <table border="1" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Anggota</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">JK</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
          $query_tampil="SELECT * FROM tbanggota order by idanggota desc";
          $data=mysqli_query($db,$query_tampil);
          $no=1;
          while ($d=mysqli_fetch_array($data)) {
            //perintah Menampilkan data
            $idanggota=$d['idanggota'];
            $nama=$d['nama'];
            $jk=$d['jeniskelamin'];
            $alamat=$d['alamat'];
            $status=$d['status'];
            // echo $d['idanggota']."<br";
            // echo $d['nama']."<br";
            // echo $d['jeniskelamin']."<br";
            // echo $d['alamat']."<br";         
            // echo $d['status']."<br";
            }
            ?>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo $idanggota?> </td>
                    <td><?php echo $nama?></td>
                    <td><?php echo $jk?></td>
                    <td><?php echo $alamat?></td>
                    <td><?php echo $status?></td>
                </tr>
            </tbody>
        </table>
    </table>

    <?php
  $no++;
 } 

 ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>