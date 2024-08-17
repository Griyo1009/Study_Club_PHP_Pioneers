<?php

    session_start();
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    include 'helper/koneksi.php';

    if (isset($_POST['move_tasks'])) {
        if (isset($_POST['taskCheckbox'])) {
            $ids = $_POST['taskCheckbox'];

            $db->autocommit(false);
            $moveStmt = $db->prepare("INSERT INTO completed_tasks (project_name, owner, start_date, end_date) SELECT project_name, owner, start_date, end_date FROM project WHERE id_project = ?");
            $deleteStmt = $db->prepare("DELETE FROM project WHERE id_project = ?");

            foreach ($ids as $id) {
                $moveStmt->bind_param("i", $id);
                $deleteStmt->bind_param("i", $id);

                if (!$moveStmt->execute() || !$deleteStmt->execute()) {
                    $db->rollback();
                    echo "Failed to move or delete task with ID: $id. Error: " . $db->error;
                    exit();
                }
            }

            $db->commit();
            $moveStmt->close();
            $deleteStmt->close();
            $db->autocommit(true);
        }
        header("Location: projects.php");
        exit();
    }

?>


<!-- home.html -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task</title>
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
          <a href="projects.php" class="nav-link active">
            <i class="bi bi-kanban"></i> Task
          </a>
        </li>
        <li class="nav-item">
          <a href="complete.php" class="nav-link ">
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
      <nav class="navbar navbar-expand-lg navbar-light"
        style="background-color: #f8e1e7; border-radius: 12px; margin: 10px;">
        <div class="container-fluid">
          <div class="d-flex">
            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn" style="background-color: #e0f7fa;" data-bs-toggle="modal"
              data-bs-target="#exampleModal">
              New Task
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="helper/add.php" method="POST">
                      <div class="form-group mb-3">
                        <label for="nama_project">Task Name</label>
                        <input type="text" class="form-control" name="project_name" id="project_name" required />
                      </div>
                      <div class="form-group mb-3">
                        <label for="progress">Progress</label>
                        <input type="number" class="form-control" name="progress" id="progress" min="0" max="100"
                          required />
                      </div>
                      <div class="form-group mb-3">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" name="owner" id="owner" required />
                      </div>
                      <div class="form-group mb-3">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required />
                      </div>
                      <div class="form-group mb-3">
                        <label for="end_date">Due Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required />
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
          
        </div>
      </nav>

      <!-- Content -->
      <div class="p-4" style="background-color: #f8e1e7; border-radius: 12px; margin: 10px;">
        <h2>All Task</h2>

        <div class="table-responsive">
    <form id="taskForm" action="projects.php" method="POST">
        <table class="table table-bordered" style="background-color: #f4c2c2;">
            <thead>
                <tr>
                    <th>
                        <center>
                            <input type="checkbox" id="checkAll">
                        </center>
                    </th>
                    <th>Task Name</th>
                    <th>Progress</th>
                    <th>Owner</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>
                        <center>
                            <svg id="i-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="20"
                                height="20" fill="none" stroke="currentcolor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2">
                                <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                            </svg>
                        </center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'helper/koneksi.php';
                $query_tampil = "SELECT * FROM project";
                $tampil = mysqli_query($db, $query_tampil);

                while ($data = mysqli_fetch_array($tampil)) {
                    $progress = $data['progress'];
                    // Menentukan warna progress bar berdasarkan nilai progress
                    if ($progress <= 20) {
                        $progress_color = '#dc3545'; // Merah
                    } elseif ($progress <= 40) {
                        $progress_color = '#fd7e14'; // Jingga
                    } elseif ($progress <= 60) {
                        $progress_color = '#ffc107'; // Kuning
                    } elseif ($progress < 100) {
                        $progress_color = '#9ACD32'; // Hijau muda
                    } else {
                        $progress_color = '#28a745'; // Hijau untuk 100%
                    }
                ?>
                    <tr>
                        <td>
                            <center>
                                <input type="checkbox" name="taskCheckbox[]" class="taskCheckbox"
                                    value="<?php echo $data['id_project']; ?>">
                            </center>
                        </td>
                        <td>
                            <?php echo $data['project_name'] ?>
                        </td>
                        <td>
                            <div class="progress mt-2">
                                <div class="progress-bar" role="progressbar"
                                    data-value="<?php echo $data['progress'] ?>"
                                    style="width: <?php echo $data['progress'] ?>%; background-color: <?php echo $progress_color ?>;"
                                    aria-valuenow="<?php echo $data['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                    <?php echo $data['progress'] ?>%
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php echo $data['owner'] ?>
                        </td>
                        <td>
                            <?php echo $data['start_date'] ?>
                        </td>
                        <td>
                            <?php echo $data['end_date'] ?>
                        </td>
                        <td>
                            <div class="button-container">
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?php echo $data['id_project'] ?>"
                                    class="btn btn-warning p-1">
                                    <svg id="i-compose" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                        width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                        <path d="M27 15 L27 30 2 30 2 5 17 5 M25 2 L30 7 15 22 10 22 10 17 25 2 Z" />
                                    </svg>
                                </a>
                                <a href="helper/delete.php?id_project=<?php echo $data['id_project'] ?>"
                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ' + '<?php echo $data['project_name'] ?>')"
                                    class="btn btn-danger p-1 mt-1">
                                    <svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                        width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                        <path d="M28 6 L4 6 M30 10 L26 10 26 28 6 28 6 10 2 10 2 6 10 6 12 2 20 2 22 6 30 6 30 10 Z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal<?php echo $data['id_project'] ?>" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="helper/update.php" method="POST">
                                        <div class="form-group mb-3">
                                            <label for="nama_project">Task Name</label>
                                            <input type="text" class="form-control" name="project_name"
                                                value="<?php echo $data['project_name'] ?>" id="project_name" required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="progress">Progress</label>
                                            <input type="number" class="form-control" name="progress"
                                                value="<?php echo $data['progress'] ?>" id="progress" min="0" max="100"
                                                required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="owner">Owner</label>
                                            <input type="text" class="form-control" name="owner"
                                                value="<?php echo $data['owner'] ?>" id="owner" required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" name="start_date"
                                                value="<?php echo $data['start_date'] ?>" id="start_date" required />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="end_date">Due Date</label>
                                            <input type="date" class="form-control" name="end_date"
                                                value="<?php echo $data['end_date'] ?>" id="end_date" required />
                                        </div>
                                        <input type="hidden" name="id_project" value="<?php echo $data['id_project'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit" name="move_tasks" class="btn btn-primary">Completed Tasks</button>
    </form>


  </div>
  </div>
  </div>

  </div>

  </div>




  <!-- JavaScript -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  
  <script>
    document.getElementById('checkAll').onclick = function() {
        var checkboxes = document.querySelectorAll('.taskCheckbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }


  </script>

</body>

</html>