<?php
    session_start();
    if (isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit(); // Menambahkan exit setelah header untuk menghentikan eksekusi script
    } 
?>
<?php
include 'helper/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['taskIds']) && !empty($_POST['taskIds'])) {
        $taskIds = $_POST['taskIds'];
        $taskIdsString = implode(',', $taskIds);
        
        // Pindahkan data ke tabel completed_tasks
        $query_move = "INSERT INTO completed_tasks (project_name, owner, start_date, end_date,)
                       SELECT project_name, owner, start_date, end_date 
                       FROM project 
                       WHERE id_project IN ($taskIdsString)";
        $move_result = mysqli_query($db, $query_move);

        // Hapus data dari tabel project setelah dipindahkan
        if ($move_result) {
            $query_delete = "DELETE FROM project WHERE id_project IN ($taskIdsString)";
            $delete_result = mysqli_query($db, $query_delete);
        }

        // Redirect kembali ke halaman task
        header("Location: projects.php");
        exit();
    }
}
?>


<!-- home.html -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Completed Task</title>
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

        .table {
          background-color: #fff5f7;
          border-radius: 8px;
          overflow: hidden;
        }

        .table thead {
          background-color: #f8e1e7;
        }

        .table thead th {
          color: #333;
          border-bottom: 2px solid #f4c2c2;
        }

        .table tbody tr {
          border-bottom: 1px solid #f4c2c2;
        }

        .table tbody tr:last-child {
          border-bottom: none;
        }

        .table tbody td {
          color: #555;
        }

        .min-w-100 {
          min-width: 80px;
        }

        .button-container {
          display: flex;
          justify-content: space-between;
          align-items: center;

          width: 100%;
        }

        .button-container .btn {
          width: 40%;
          text-align: center;

        }

        .button-container .btn:nth-child(1) {
          margin-right: auto;

        }

        .button-container .btn:nth-child(2) {
          margin-left: auto;

        }
  </style>

</head>

<body style="background-color: #f8e1e7;">
  <!-- Include Navbar -->
  <div class="d-flex">
    <!-- navbar.html -->
    <nav class="sidebar d-flex flex-column flex-shrink-0 p-4 ">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fw-bold fs-1" style="font-family: Copperplate;">Daily List</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
                    <a href="home.php" class="nav-link ">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="calendar.php" class="nav-link ">
                        <i class="bi bi-calendar"></i> Calendar
                    </a>
                </li>

                <li>
                    <a href="projects.php" class="nav-link">
                        <i class="bi bi-kanban"></i> Task
                    </a>
                </li>                        
                <li class="nav-item">
                    <a href="complete.php" class="nav-link active ">
                         <i class="bi bi-check-square-fill"></i> Completed Task
                    </a>
                </li>
              <hr>
            </ul>
            <ul class="nav nav-pills flex-column mb-auto">
              <hr>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link ">
                        <i class="bi bi-chat-left-text"></i> Feedback
                    </a>
                    </li>
                    <hr>
                </ul>
                <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="assets/img/profile.png" alt="" width="30" height="30" class="rounded-circle me-2">
          <strong>
            <?= $_SESSION["username"]?>
          </strong>
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

    <div class="content flex-grow-1">
      <!-- Top Navbar -->
      

      <!-- Content -->
      <div class="p-4" style="background-color: #f8e1e7; border-radius: 12px; margin: 10px;">
        <h2>Completed Task</h2>

        <?php
              include 'helper/koneksi.php';
              $query_tampil = "SELECT * FROM completed_tasks";
              $tampil = mysqli_query($db, $query_tampil);
              ?>
              <div class="table-responsive">
                <table class="table table-bordered" style="background-color: #f4c2c2;">
                  <thead>
                    <tr>
                      <th>Task Name</th>
                      <th>Progress</th>
                      <th>Owner</th>
                      <th>Start Date</th>
                      <th>Due Date</th>
                      <th>Completed Date</th>
                    </tr>
                  </thead>
                 


                  <tbody>
                    <?php while ($data = mysqli_fetch_array($tampil)) { ?>
                    <tr>
                      <td><?php echo $data['project_name']; ?></td>
                      <td>100%</td>
                      <td><?php echo $data['owner']; ?></td>
                      <td><?php echo $data['start_date']; ?></td>
                      <td><?php echo $data['end_date']; ?></td>
                      <td><?php echo $data['completed_date']; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                
          </table>
        </div>
      </div>
    </div>

  </div>

  </div>
  



  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
 

</body>

</html>