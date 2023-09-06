<?php
session_start();
include "db_conn.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>LEADERBOARD</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="../jquery.simplePagination.js"></script>
        <link href="../simplePagination.css" rel="stylesheet" type="text/css" />
        <style>
            table {
            border: 1px solid black;
            border-collapse: collapse;
            border-color: #cc0828;
            }

            th, td{
                border: 1px solid black;
                border-collapse: collapse;
                border-color: #cc0828;
                padding: 10px;
                text-align: center;
            }

            tr:hover {background-color: #D6EEEE;}
        </style>
    </head>
    <body>
        <table id="leaderboard" style="width:50%">
                <tr>
                    <th style="width:20%">Ranking</th>
                    <th style="width:40%">Username</th>
                    <th style="width:20%">Total score</th>
                    <th style="width:20%">Total tokens</th>
                    <th style="width:40%">Monthly tokens</th>
                </tr>
        
        <?php 
            $sql = "SELECT user_name, score, tokens, monthly_tokens  FROM users ORDER BY score DESC";
            $result = mysqli_query($conn,$sql);
            $ranking = 1;
            
            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr><td>{$ranking}</td>
                    <td>{$row['user_name']}</td>
                    <td>{$row['score']}</td>
                    <td>{$row['tokens']}</td>
                    <td>{$row['monthly_tokens']}</td></tr>";
                    $ranking++;
                }
            }
        ?>

        </table>
    </body>
    </html>

    <script>
    </script>
    <?php
}
else
{
    header("Location: index.php");
    exit();
}