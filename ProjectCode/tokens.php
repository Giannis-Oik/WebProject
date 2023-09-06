<?php
include "db_conn.php";

    $sql = "SELECT count(*) as total FROM users";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $usercount = $row['total'];

    $currentday = date('d');
    $currentmonth = date('m');
    $currentday = 30;
    if($currentday == 1)
    {
        $tokens = $usercount*100;
        $sql = "UPDATE awards  SET tokens='$tokens' WHERE awards_id = 1";
        mysqli_query($conn,$sql);
    }

    if($currentmonth == 4 OR $currentmonth== 6 OR $currentmonth == 9 OR $currentmonth == 11)//Gia kathe mhna me 30 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 30)
        {
            $available_tokens = $row['tokens']*0.8;
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens;
            
            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    switch($count)
                    {
                        case 1:
                            $tokens = $available_tokens*0.25;
                            $remaining -= $tokens;
                            break;
                        case 2:
                            $tokens = $available_tokens*0.15;
                            $remaining -= $tokens;
                            break;
                        case 3:
                            $tokens = $available_tokens*0.1;
                            $remaining -= $tokens;
                            break;
                        case 4:
                            $tokens = $available_tokens*0.05;
                            $remaining -= $tokens;
                            break;
                        case 5:
                            $tokens = $available_tokens*0.02;
                            $remaining -= $tokens;
                            break;
                    }
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
        }
    }else if($currentmonth == 1 OR $currentmonth == 3 OR $currentmonth == 5 OR $currentmonth == 7 OR $currentmonth == 8 OR $currentmonth == 10 OR $currentmonth == 12)//Gia kathe mhna me 31 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 31)
        {
            $available_tokens = $row['tokens']*0.8;
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens;
            
            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    switch($count)
                    {
                        case 1:
                            $tokens = $available_tokens*0.25;
                            $remaining -= $tokens;
                            break;
                        case 2:
                            $tokens = $available_tokens*0.15;
                            $remaining -= $tokens;
                            break;
                        case 3:
                            $tokens = $available_tokens*0.1;
                            $remaining -= $tokens;
                            break;
                        case 4:
                            $tokens = $available_tokens*0.05;
                            $remaining -= $tokens;
                            break;
                        case 5:
                            $tokens = $available_tokens*0.02;
                            $remaining -= $tokens;
                            break;
                    }
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
                  
        }
    }else if($currentmonth == 2)//Gia fevrouario me 28 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 28)
        {
            $available_tokens = $row['tokens']*0.8;
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens;
            
            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    switch($count)
                    {
                        case 1:
                            $tokens = $available_tokens*0.25;
                            $remaining -= $tokens;
                            break;
                        case 2:
                            $tokens = $available_tokens*0.15;
                            $remaining -= $tokens;
                            break;
                        case 3:
                            $tokens = $available_tokens*0.1;
                            $remaining -= $tokens;
                            break;
                        case 4:
                            $tokens = $available_tokens*0.05;
                            $remaining -= $tokens;
                            break;
                        case 5:
                            $tokens = $available_tokens*0.02;
                            $remaining -= $tokens;
                            break;
                    }
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result))
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
              
        }
    }