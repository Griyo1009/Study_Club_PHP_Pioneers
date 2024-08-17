<?php
    session_start();
    if (isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();
    } 

    // Proses form hanya jika metode permintaan adalah POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //mengambil nilai post
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';

        // Validasi sederhana
        if (!empty($nama) && !empty($email) && !empty($pesan)) {
            include 'helper/koneksi.php'; 
            
            //query
            $query_simpan = "INSERT INTO feedback (nama, email, pesan) 
                            VALUES ('$nama', '$email', '$pesan')";

            $simpan = mysqli_query($db, $query_simpan);

            //cek
            if ($simpan) {
                // Redirect jika berhasil
                header("location: feedback.php");
                exit();
            } else {
                echo "Kesalahan Memasukan Data <br>";
            }
        } else {
            echo "Harap isi semua bidang!";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('picthome.jpeg.jpg');
            background-size: cover;
            background-position: center;
            margin-left: 250px; 
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #fab2b2;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto; 
        }

        .sidebar .nav-link {
            color: #333;
            font-weight: bold;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link.active {
            background-color: #f8e1e7;
            color: #333;
        }

        .sidebar .nav-link:hover {
            background-color: #d1a7a7;
            color: #f3e3e3;
        }

        .content {
            padding: 20px;
            overflow-y: auto; 
        }
        
 
    .container
    {
        background-color: pink;
        padding: 50px;
        border-radius: 12px;
        
    }
    
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column flex-shrink-0 p-4">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fw-bold fs-1" style="font-family: Copperplate;">Daily List</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="calendar.php" class="nav-link">
                        <i class="bi bi-calendar"></i> Calendar
                    </a>
                </li>
                <li>
                    <a href="projects.php" class="nav-link">
                        <i class="bi bi-kanban"></i> Task
                    </a>
                </li>                        
                <li class="nav-item">
                    <a href="complete.php" class="nav-link">
                         <i class="bi bi-check-square-fill"></i> Completed Task
                    </a>
                </li>
                <hr>
            </ul>
            <ul class="nav nav-pills flex-column mb-auto">
                <hr>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link active">
                        <i class="bi bi-chat-left-text"></i> Feedback
                    </a>
                </li>
                <hr>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/img/profile.png" alt="" width="30" height="30" class="rounded-circle me-2">
                    <strong><?= $_SESSION["username"]?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="home.php" method="POST" style="display:inline;">
                            <button class="dropdown-item" type="submit" name="logout">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- Content -->
        <div class="content flex-grow-1 p-4">
            <div class="container">
                
                        <h1><strong>THANK YOU FOR JOINING THIS WEB !!</strong></h1>
                        <p><strong>Please give me your feedback about this website.</strong></p>
                    
                    
                        <form method="POST" action="feedback.php">
                            <div class="form-group">
                                <label for="nama"><strong>Nama Anda:</strong></label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                            </div><br>
                            <div class="form-group">
                                <label for="email"><strong>E-mail Anda:</strong></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                            </div><br>
                            <div class="form-group">
                                    <label for="pesan"><strong>Feedback Anda:</strong></label>
                                    <textarea name="pesan" id="pesan" class="form-control" cols="30" rows="7" placeholder="Maksimal Pesan 250 karakter" maxlength="250"></textarea>
                                </div><br>
                            <input class="btn btn-primary" type="submit" value="POST">
                        </form>
                    
               
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
