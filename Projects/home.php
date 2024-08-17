<?php
    session_start();
    if (isset($_POST["logout"])){
        session_unset();
        session_destroy();
        header("location: login.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Daily List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
            transition: 0.3s ease;
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

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card.my-tasks {
            background-color: #ffe4e1;
        }

        .card.my-work-items {
            background-color: #e6e6fa;
        }

        .card.all-tasks {
            background-color: #f0fff0;
        }

        .card.tasks-not-completed {
            background-color: #fce4ec;
        }

        .card.tasks-completed {
            background-color: #e0f7fa;
        }

        .task-list .task-item {
            padding: 10px;
            border: 1px solid #f4c2c2;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
        }

        .task-list .task-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .task-item strong {
            color: #ff6347;
        }

        /* Custom styles for the tables */
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

        .card-title {
            color: #ff6347;
        }

        /* Custom styles for tabs */
        .nav-tabs .nav-link {
            border-radius: 0;
        }

        .nav-tabs .nav-link.active {
            color: #ff6347;
            background-color: #f8e1e7;
            border-color: #f8e1e7 #f8e1e7 #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex">

        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column flex-shrink-0 p-4 ">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fw-bold fs-1" style="font-family: Copperplate;">Daily List</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                    <a href="home.php" class="nav-link active">
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
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
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

        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
            <h2 style=" color: black;
            text-shadow: 
                -1px -1px 0 white,  
                1px -1px 0 white,
                -1px 1px 0 white,
                1px 1px 0 white; "><strong>Welcome
                <?= $_SESSION["username"]?> to Daily List!</strong>
            </h2>
            <p style=" color: black;;
            text-shadow: 
                -1px -1px 0 white,  
                1px -1px 0 white,
                -1px 1px 0 white,
                1px 1px 0 white; "><strong>Keep your life organized with Daily List :)</strong></p>

            <div class="row">
                <!-- Tasks Completed -->
                <div class="col-md-6">
                    <div class="card tasks-completed p-3 mb-4">
                        <h5 class="card-title">Tasks Completed</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Task Name</th>

                                    <th scope="col">Completion Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                include 'helper/koneksi.php';
                                
                                $query_tampil = "select * from completed_tasks";
                                $tampil = mysqli_query($db, $query_tampil);
                                
                                while ($data = mysqli_fetch_array($tampil)){
                                    ?> 
                                <tr>
                                    <td><?php echo $data['project_name']?></td>

                                    <td><?php echo $data['completed_date']?></td>
                                </tr>
                                
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tasks Not Completed -->
                <div class="col-md-6">
                    <div class="card tasks-not-completed p-3 mb-4">
                        <h5 class="card-title">Tasks Not Completed</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Task Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            include 'helper/koneksi.php';

                            $query_tampil = "select * from project";
                            $tampil = mysqli_query($db, $query_tampil);

                            while ($data = mysqli_fetch_array($tampil)){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $data['project_name']?>
                                    </td>
                                    <td>
                                        <?php echo $data['start_date']?>
                                    </td>
                                    <td>
                                        <?php echo $data['end_date']?>
                                    </td>
                                </tr>
                             <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- My Work Items -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card my-work-items p-3 mb-4">
                        <h5 class="card-title">My Work Items Due Today</h5>
                        <p>You don't have any overdue tasks. Keep it up!</p>
                    </div>
                </div>


                <!-- My Tasks -->
                <div class="col-md-6" >
    <div class="card my-tasks p-3">
        <h5 class="card-title">My Tasks</h5>
        <!-- Tabs for Open and Closed Tasks -->
        <ul class="nav nav-tabs" id="myTasksTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="open-tasks-tab" data-bs-toggle="tab" href="#open-tasks"
                    role="tab" aria-controls="open-tasks" aria-selected="true">Open Tasks</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="closed-tasks-tab" data-bs-toggle="tab" href="#closed-tasks"
                    role="tab" aria-controls="closed-tasks" aria-selected="false">Closed Tasks</a>
            </li>
        </ul>

        <div class="tab-content" id="myTasksTabContent">
            <!-- Open Tasks Tab -->
            <div class="tab-pane fade show active" id="open-tasks" role="tabpanel"
                aria-labelledby="open-tasks-tab">
                <div class="task-list mt-3" style="max-height: 300px; overflow-y: auto;">
                    <?php
                        include 'helper/koneksi.php';

                        $query_tampil = "select * from project";
                        $tampil = mysqli_query($db, $query_tampil);

                        while ($data = mysqli_fetch_array($tampil)){
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
                            <div class="task-item" style="padding-bottom: 5px; display: flex; align-items: center;">
                                <?php echo $data['project_name'] ?> -
                                <span class="text-muted" style="width: 150px; margin-left: 10px;">
                                    <div class="progress mt-2" style="width: 70%; max-width: 300px;">
                                        <div class="progress-bar" role="progressbar"
                                            data-value="<?php echo $data['progress'] ?>"
                                            style="width: <?php echo $data['progress'] ?>%; background-color: <?php echo $progress_color ?>;"
                                            aria-valuenow="<?php echo $data['progress'] ?>" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <?php echo $data['progress'] ?>%
                                        </div>
                                    </div>
                                </span><span style="margin-right: 10px;">-</span><strong>
                                    <?php echo $data['end_date'] ?>
                                </strong>
                            </div>

                                <?php } ?>
                                </div>
                            </div>

                            <!-- Closed Tasks Tab -->
                            <div class="tab-pane fade" id="closed-tasks" role="tabpanel" aria-labelledby="closed-tasks-tab">
                                <div class="task-list mt-3">
                                <?php
                                include 'helper/koneksi.php';
                                
                                $query_tampil = "select * from completed_tasks";
                                $tampil = mysqli_query($db, $query_tampil);
                                
                                while ($data = mysqli_fetch_array($tampil)){
                                    
                                ?> 
                                    <div class="task-item" style="padding-bottom: 5px; display: flex; align-items: center;">
                                        <?php echo $data['project_name'] ?> -
                                        <span class="text-muted" style="width: 150px; margin-left: 10px;">
                                            <div class="progress mt-2" style="width: 70%; max-width: 300px;">
                                                <div class="progress-bar" role="progressbar"
                                                    data-value="100"
                                                    style="width: 100%; background-color: #28a745;"
                                                    aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    100%
                                                </div>
                                            </div>
                                        </span><span style="margin-right: 10px;">-</span><strong>
                                            <?php echo $data['completed_date'] ?>
                                        </strong>
                                    </div>
                                <?php } ?>   
                                </div>
                            </div>
                        </div> <!-- Penutup div.tab-content -->
                    </div> <!-- Penutup div.card -->
                </div>



                <!-- End of Tasks Summary -->

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>