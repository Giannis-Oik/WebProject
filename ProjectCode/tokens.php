<?php
include "db_conn.php";

    $sql = "SELECT count(*) as total FROM users"; //Metrima xrhstwn poy einai eggegramenoi kai arxikopoihsh ths metavlhths user count
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $usercount = $row['total'];

    $sql = "SELECT made, given FROM awards WHERE awards_id = 1"; //Arxikopoihsh metavlhtwn poy elegxoun an exei ektelestei to token system h oxi
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $given = $row['given'];
    $made = $row['made'];

    $currentday = date('d');
    $currentmonth = date('m');
   
    if($currentday == 1 AND $made == 0) //Elegxos gia to an einai h mera prwth toy mhna kai an exoun dhmiourghthei h oxi ta tokens gia auto to mhna
    {
        $made = 1;
        $tokens = $usercount*100;
        $sql = "UPDATE awards  SET tokens='$tokens', made='$made', given=0 WHERE awards_id = 1"; //Apothkeysh twn tokens toy mhna sth vash opws kai enhmerwsh twn metavlhtwn elegxou
        mysqli_query($conn,$sql);
        $sql = "UPDATE users SET monthly_score = 0"; //Mhdenise to mhnaio score kathe xrhsth afou einai prwth toy mhna
        mysqli_query($conn,$sql);
    }

    if($currentmonth == 4 OR $currentmonth== 6 OR $currentmonth == 9 OR $currentmonth == 11)//Gia kathe mhna me 30 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1"; 
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 30 AND $given == 0) //An teleytaia hmera toy mhna k den exoun dothei tokens se xrhstes
        {
            $given = 1;
            $available_tokens = $row['tokens']*0.8; //Ypologise ta diathesima gia na dothoun kai ypologise thn katataxi twn xrhstwn gia ton mhna ayton
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens; 
            
            if(mysqli_num_rows($result)) //Moirase stoys 5 xrhstes me to megalytero score ena pososto apo ta synolika diathesima tokens kai ypologise ta poso apomenoyn
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
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'"; //Enhmerwse ta mhnaia tokens toy kathe xrhsth  
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)) 
            {
                while($row = mysqli_fetch_array($result)) //Moirase ta tokens poy apomenoyn isomerws se olous kai enhmerwse to synoliko kai to mhnaio arithmo tokens gia kathe xrhsth
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
            $sql = "UPDATE awards  SET given='$given', made=0 WHERE awards_id = 1"; //Enhmerwsh sth vash gia tis metavlhtes elegxou
            mysqli_query($conn,$sql);
        }
    }else if($currentmonth == 1 OR $currentmonth == 3 OR $currentmonth == 5 OR $currentmonth == 7 OR $currentmonth == 8 OR $currentmonth == 10 OR $currentmonth == 12)//Gia kathe mhna me 31 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 31 AND $given == 0) //An teleytaia hmera toy mhna k den exoun dothei tokens se xrhstes
        {
            $given = 1;
            $available_tokens = $row['tokens']*0.8; //Ypologise ta diathesima gia na dothoun kai ypologise thn katataxi twn xrhstwn gia ton mhna ayton
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens;
            
            if(mysqli_num_rows($result)) //Moirase stoys 5 xrhstes me to megalytero score ena pososto apo ta synolika diathesima tokens kai ypologise ta poso apomenoyn
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
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'"; //Enhmerwse ta mhnaia tokens toy kathe xrhsth  
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result)) //Moirase ta tokens poy apomenoyn isomerws se olous kai enhmerwse to synoliko kai to mhnaio arithmo tokens gia kathe xrhsth
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
            $sql = "UPDATE awards  SET given='$given', made=0 WHERE awards_id = 1"; //Enhmerwsh sth vash gia tis metavlhtes elegxou
            mysqli_query($conn,$sql);  
        }
    }else if($currentmonth == 2 )//Gia fevrouario me 28 hmeres
    {
        $sql = "SELECT tokens FROM awards WHERE awards_id = 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

        if($currentday == 28 AND $given == 0) //An teleytaia hmera toy mhna k den exoun dothei tokens se xrhstes
        {
            $given = 1;
            $available_tokens = $row['tokens']*0.8; //Ypologise ta diathesima gia na dothoun kai ypologise thn katataxi twn xrhstwn gia ton mhna ayton
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);
            $count = 1;
            $remaining = $available_tokens;
            
            if(mysqli_num_rows($result)) //Moirase stoys 5 xrhstes me to megalytero score ena pososto apo ta synolika diathesima tokens kai ypologise ta poso apomenoyn
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
                    $sql_update = "UPDATE users SET monthly_tokens='$tokens' WHERE id='$id'"; //Enhmerwse ta mhnaia tokens toy kathe xrhsth  
                    mysqli_query($conn,$sql_update);
                    $count++;
                }
            }

            $remaining = round($remaining/$usercount); //Ypologise ta tokens poy paramenoyn gia diamoirasmo stoys xrhstes
            $sql = "SELECT * FROM users ORDER BY monthly_score DESC";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_array($result)) //Moirase ta tokens poy apomenoyn isomerws se olous kai enhmerwse to synoliko kai to mhnaio arithmo tokens gia kathe xrhsth
                {
                    $tokens = $row['monthly_tokens'] + $remaining;
                    $total = $row['tokens'] + $tokens;
                    $id = $row['id'];
                    $sql_update = "UPDATE users SET tokens='$total' ,monthly_tokens='$tokens' WHERE id='$id'";
                    mysqli_query($conn,$sql_update);
                }
            }
            $sql = "UPDATE awards  SET given='$given', made=0 WHERE awards_id = 1"; //Enhmerwsh sth vash gia tis metavlhtes elegxou
            mysqli_query($conn,$sql);  
        }
    }