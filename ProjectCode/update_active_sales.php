<?php //Elegxe th vash gia prosfores oi opoies the eprepe na exoyn lhxei
include "db_conn.php";

$today = date_create(); //Arxikopoihsh metavlhths me thn shmerinh hmeromhnia 
$sql = "SELECT * FROM sales";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
        $price = $row['price'];
        $active_week = $row['below_week_price'];
        $active_day = $row['below_day_price'];
        $date = date_create($row['date']); //Perna sto date thn hmeromhnia eisagwgis ths prosforas
        $diff = date_diff($date, $today); //Vres th diafora metaxh twn hmeromhniwn
        $diff = $diff->format('%a');

        if($diff > 7 && $active_day == 0 && $active_week == 0) //An h diafora megalyterh apo 7 hmeres kai den threi ta krithria tote kane thn prosfora inactive 
        {
            $sql_update = "UPDATE sales SET active = 0 WHERE id='$id'";
            mysqli_query($conn,$sql_update);
        }else if($diff > 7) //An h diafora megalyterh apo 7 hmeres kai throuse prin ta krithria tote elegxe an throyntai akoma
        {
            $sql_weekly = "SELECT * FROM weekly_prices WHERE product_id='$product' AND date BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) AND DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)";
            $sql_daily = "SELECT * FROM daily_prices WHERE product_id='$product' AND date = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)";

            $result_weekly = mysqli_query($conn,$sql_weekly);

            if(mysqli_num_rows($result_weekly) > 0)
            {
                while($row_week = mysqli_fetch_array($result_weekly))
                {
                    $week_price = $row_week['price'];
                }
            }else
            {
                $week_price = 0;
            }

            $result_daily = mysqli_query($conn,$sql_daily);

            if(mysqli_num_rows($result_daily) > 0)
            {
                while($row_day = mysqli_fetch_array($result_daily))
                {
                    $daily_price = $row_day['price'];
                }
            }else
            {
                $daily_price = 0;
            } 

            $week_perc = $week_price * 0.8; //Ypologise tis times apo tis opoies an h dwsmenh einai xamhloterh tote o xrhsths amoivetai me pontoys
            $day_perc = $daily_price * 0.8;

            if($price <= $week_perc) //An h timh xamhlwterh apo 20% ths evdomadiaias enhmerwse oti plhrei ta krithria kai vale th nea hmeromhnia ypovolhs 
            {
                $sql = "UPDATE sales SET below_week_price = 1, date=CURRENT_DATE WHERE id='$id'";
                mysqli_query($conn,$sql);
            }

            if($price <= $day_perc) //An h timh xamhlwterh apo 20% ths prohgoymenhs hmeras enhmerwse oti plhrei ta krithria kai vale th nea hmeromhnia ypovolhs 
            {
                $sql = "UPDATE sales SET below_day_price = 1, date=CURRENT_DATE WHERE id='$id'";
                mysqli_query($conn,$sql);
            }
        }
    }
}