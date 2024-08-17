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
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #fab2b2;
            margin-left: 250px; /
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
            background-image: url('picthome.jpeg.jpg');
            padding: 20px;
            background-size: cover;
            background-position: center;
            background-color: #fff;
            overflow-y: auto;
        }

        /* Calendar styles */
        .calendar {
        
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .month {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .month h3 {
            background-color: #ffe4e1;
            color: #ff6347;
            margin: 0;
            padding: 10px;
        }
        table {
            background-color: white;
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            background-color: white;
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .sunday {
            color: red;
        }
        .today {
            background-color: yellow;
            font-weight: bold;
            border: 2px solid #007BFF;
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
                <a href="calendar.php" class="nav-link active">
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
                <a href="feedback.php" class="nav-link">
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
    
    <!-- Main Content -->
    <div class="content flex-grow-1 p-4">
        <h1><strong>Kalender Tahun <?php echo date('Y'); ?></strong></h1>
        <div class="calendar">
            <?php
            $year = date('Y');
            $months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            foreach ($months as $index => $month) {
                $firstDayOfMonth = mktime(0, 0, 0, $index + 1, 1, $year);
                $daysInMonth = date('t', $firstDayOfMonth);
                $dayOfWeek = date('w', $firstDayOfMonth);
            ?>
            <div class="month">
                <h3><?php echo $month; ?></h3>
                <table>
                    <tr>
                        <th>Minggu</th>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                    </tr>
                    <tr>
                        <?php
                        for ($blank = 0; $blank < $dayOfWeek; $blank++) {
                            echo '<td></td>';
                        }

                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $currentDay = ($dayOfWeek + $day - 1) % 7;
                            $today = date('j');
                            $currentMonth = date('n');
                            $currentYear = date('Y');

                            // Check if this is today
                            $isToday = ($day == $today && $index + 1 == $currentMonth && $year == $currentYear);

                            echo '<td';
                            if ($currentDay == 0) echo ' class="sunday"';
                            if ($isToday) echo ' class="today"'; // Add class "today" if this is today
                            echo '>' . $day . '</td>';

                            if (($dayOfWeek + $day) % 7 == 0) {
                                echo '</tr><tr>';
                            }
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
