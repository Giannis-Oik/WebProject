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
        $date = date_create($row['date']); //Perna sto date thn hmeromhnia eisagwgis ths prosforas
        $diff = date_diff($date, $today); //Vres th diafora metaxh twn hmeromhniwn
        $diff = $diff->format('%a');

        if($diff > 7) //An h diafora megalyterh apo 7 hmeres tote kane thn prosfora inactive
        {
            $sql_update = "UPDATE sales SET active = 0 WHERE id='$id'";
            mysqli_query($conn,$sql_update);
        }
    }
}