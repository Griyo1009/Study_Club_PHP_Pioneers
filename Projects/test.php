
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Tahun Ini</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
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
            background-color: #007BFF;
            color: white;
            margin: 0;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
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
    <h1>Kalender Tahun <?php echo date('Y'); ?></h1>
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
                            
                            // Cek apakah ini adalah hari ini
                            $isToday = ($day == $today && $index + 1 == $currentMonth && $year == $currentYear);
                        
                            echo '<td';
                            if ($currentDay == 0) echo ' class="sunday"';
                            if ($isToday) echo ' class="today"'; // Tambahkan kelas "today" jika ini adalah hari ini
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
</body>
</html>