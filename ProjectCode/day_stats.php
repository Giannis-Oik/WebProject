<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Daily sales number stats</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #dayChart {
                height: 50vh; 
                width: 50%;
            }
        </style>
    </head>
    <body>
        <form method="post">
            <div>
                <label for="year">Year:</label>
                <select name="year" id="year">
                    <option value="">Select year</option>
                    <?php
                        $year_start=2000;
                        $year_end=date('Y');
                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) 
                        {
                            echo '<option value="'.$i_year.'">'.$i_year.'</option>'."\n";
                        } 
                    ?>
                </select>

                <label for="month">Month:</label>
                <select name="month" id="month">
                    <option value="">Select month</option>
                    <?php
                        for ($i_month = 1; $i_month <= 12; $i_month++) 
                        {
                            echo '<option value="'.$i_month.'">('.$i_month.') '. date('F', mktime(0,0,0,$i_month)).'</option>'."\n";
                        } 
                    ?>
                </select>
            </div>
            <div>
                <button type="submit">Select</button>
                <button type="button" onclick="location.href='admin_home.php'">Home</button>
            </div>
        </form>
        <div>
            <canvas id="dayChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <?php 
            $day = array();
            $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
            $month = filter_input(INPUT_POST, 'month', FILTER_SANITIZE_STRING);
            echo "<script> var month = '$month';</script>";
            echo "<script> var year = '$year';</script>";

            if($year AND $month)
            {
                if($month == 4 OR $month == 6 OR $month == 9 OR $month == 11)
                {
                    for($i = 1; $i <= 30; $i++)
                    {
                        $sql = "SELECT COUNT(*) as total FROM sales WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND DAY(date)='$i'";
                        $results = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($results);
                        
                        $day[$i-1] = $row['total'];
                    }
                    ?>
                    <script>
                    function getMonthName(monthNumber) {
                        const date = new Date();
                        date.setMonth(monthNumber - 1);

                        return date.toLocaleString('en-US', {
                            month: 'long',
                        });
                    }
                    var month_name = getMonthName(month);
                    var passed_array = <?php echo json_encode($day); ?>;
                    const days = document.getElementById('dayChart');
                
                    new Chart(days, {
                        type: 'bar',
                        data: {
                            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30],
                            datasets: [{
                                label: 'Count of submitted sales per day for '+month_name+' of '+year,
                                data: passed_array,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    </script> 
                    <?php
                }else if($month == 1 OR $month == 3 OR $month == 5 OR $month == 7 OR $month == 8 OR $month == 10 OR $month == 12)
                {
                    for($i = 1; $i <= 31; $i++)
                    {
                        $sql = "SELECT COUNT(*) as total FROM sales WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND DAY(date)='$i'";
                        $results = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($results);
                        
                        $day[$i-1] = $row['total'];
                    }
                    ?>
                    <script>
                    function getMonthName(monthNumber) {
                        const date = new Date();
                        date.setMonth(monthNumber - 1);

                        return date.toLocaleString('en-US', {
                            month: 'long',
                        });
                    }
                    var month_name = getMonthName(month);
                    var passed_array = <?php echo json_encode($day); ?>;
                    const days = document.getElementById('dayChart');
                
                    new Chart(days, {
                        type: 'bar',
                        data: {
                            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
                            datasets: [{
                                label: 'Count of submitted sales per day for '+month_name+' of '+year,
                                data: passed_array,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    </script> 
                    <?php
                }else if($month == 2)
                {
                    for($i = 1; $i <= 28; $i++)
                    {
                        $sql = "SELECT COUNT(*) as total FROM sales WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND DAY(date)='$i'";
                        $results = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($results);
                        
                        $day[$i-1] = $row['total'];
                    }
                    ?>
                    <script>
                    function getMonthName(monthNumber) {
                        const date = new Date();
                        date.setMonth(monthNumber - 1);

                        return date.toLocaleString('en-US', {
                            month: 'long',
                        });
                    }
                    var month_name = getMonthName(month);
                    var passed_array = <?php echo json_encode($day); ?>;
                    const days = document.getElementById('dayChart');
                
                    new Chart(days, {
                        type: 'bar',
                        data: {
                            labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28],
                            datasets: [{
                                label: 'Count of submitted sales per day for '+month_name+' of '+year,
                                data: passed_array,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    </script> 
                    <?php
                }
            }else
            {
                echo "You didnt select both year and a month";
            }
        ?>
    </body>
    </html>
    <?php
}
else
{
    header("Location: index.php");
    exit();
}