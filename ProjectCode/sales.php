<?php
session_start();
include "db_conn.php";

?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Check sales</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            input[name=like]
            {
                background-image: url(like.png);
                background-repeat: no-repeat;
                background-size: contain;
                margin: 5px 10px 5px 10px;
                width: 32px;
                height: 32px;
                border: none;
            }
            
            input[name=dislike]
            {
                background-image: url(dont-like.png);
                background-repeat: no-repeat;
                background-size: contain;
                margin: 5px 10px 5px 10px;
                width: 32px;
                height: 32px;
                border: none;
            }
            
            input[name=on_stock]
            {
                background-image: url(in-stock.png);
                background-repeat: no-repeat;
                background-size: contain;
                margin: 5px 10px 5px 10px;
                width: 32px;
                height: 32px;
                border: none;
            }
            
            input[name=out_of_stock]
            {
                background-image: url(out-of-stock.png);
                background-repeat: no-repeat;
                background-size: contain;
                margin: 5px 10px 5px 10px;
                width: 32px;
                height: 32px;
                border: none;
            }

            .form-inline {
                display: flex;
                flex-flow: row wrap;
                align-items: center;
                width: 15%;
            }
        </style>
    </head>
    <body>
        <form>
            <h2>Please insert the id of the shop</h2><br> 
            <input type="text" name="input" placeholder="0" pattern="[0-9]{1-3}">
        </form>
    </body>
    </html>

<?php 

if(isset($_GET['input']))
{
    $input = $_GET['input']; //Analoga me to shop id poy edwse o xrhsths antlhsh dedomenwn prosforas kai proiontos
    $sql = "SELECT products.name, sales.price, sales.date, sales.id, sales.likes, sales.dislikes, sales.stock, sales.user_id FROM sales INNER JOIN products ON sales.product_id = products.id WHERE sales.shop_id = '$input' AND active = 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_array($result))
        {
            $user = $row['user_id'];
            $sales_id = $row['id'];
            $price = $row['price'];
            $date = $row['date'];
            $name = $row['name'];
            $stock = $row['stock'];
            $likes = $row['likes'];
            $dislikes = $row['dislikes'];

            $sqluser = "SELECT user_name, score FROM users WHERE id='$user'"; //Antlhsh user name score tou xrhsth poy epevale thn prosfora
            $res = mysqli_query($conn, $sqluser);
            $r = mysqli_fetch_assoc($res);
            $user_name = $r['user_name'];
            $score = $r['score'];

            if($stock > 0)
            {
                echo '<p>'.'Product: '.$name.'<br>'.'Price: '.$price.'<br>'.'Date submitted: '.$date.'<br>'.'Likes: '.$likes.'<br>'.'Dislikes: '.$dislikes.'<br>'.'Stock: In stock <br>'.'Username: '.$user_name.'<br>'.'Score: '.$score.'</p>'; //Emfanisi prosforas

            }else
            {
                echo '<p>'.'Product: '.$name.'<br>'.'Price: '.$price.'<br>'.'Date submitted: '.$date.'<br>'.'Likes: '.$likes.'<br>'.'Dislikes: '.$dislikes.'<br>'.'Stock: Out of stock <br>'.'Username: '.$user_name.'<br>'.'Score: '.$score.'</p>'; //Emfanisi prosforas

            }
        
            echo '<form class="form-inline" action="" method="post">'; //Dhmiourgia formas gia ta like,dislike kai ta koympia gia to apothema
            echo '<input type="hidden" name="id" value='.$sales_id.'>';
            if($stock > 0) //An yparxei apothema
            {
                echo '<input type="submit" name="like" value="">';
                echo '<input type="submit" name="dislike" value="">';
                echo '<input type="submit" name="on_stock" value="">';
                echo '<input type="submit" name="out_of_stock" value="">';
            }else //An den yparxei apothema
            {
                echo '<input type="submit" name="on_stock" value="">';
                echo '<input type="submit" name="out_of_stock" value="">';
            }
            echo '</form>';
        }
    }else { echo '<p>There are no active sales in this shop</p>';}
}

if(isset($_POST['like'])) //An egine submit like 
{
    $id = $_POST['id'];

    $sql = "UPDATE sales SET likes = likes + 1 WHERE id='$id'"; //Ayxhse likes kata 1
    $result = mysqli_query($conn,$sql);

    $sql = "SELECT user_id FROM sales WHERE id='$id'"; 
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $user = $row['user_id'];

    $sql = "UPDATE users SET score = score + 5 WHERE id='$user'"; //Ayxhse score xrhsth
    mysqli_query($conn,$sql);

}else if(isset($_POST['dislike'])) //An egine submit dislike
{
    $id = $_POST['id'];

    $sql = "UPDATE sales SET dislikes = dislikes + 1 WHERE id='$id'"; //Ayxhse dislikes kata 1
    $result = mysqli_query($conn,$sql);

    $sql = "SELECT user_id FROM sales WHERE id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $user = $row['user_id'];

    $sql = "UPDATE users SET score = score - 1 WHERE id='$user'"; //Meiwse score xrhsth
    mysqli_query($conn,$sql);

}else if(isset($_POST['on_stock'])) //An egine submit to koympi poy dhlwnei oti yparxei apothema
{
    $id = $_POST['id'];

    $sql = "UPDATE sales SET stock = 1 WHERE id='$id'"; //H meavlhth stock dhlwnetai ws 1 poy shmainei oti stock yparxei
    mysqli_query($conn,$sql);

}else if(isset($_POST['out_of_stock'])) //An egine submit to koympi poy dhlwnei oti den yparxei apothema
{
    $id = $_POST['id'];

    $sql = "UPDATE sales SET stock = 0 WHERE id='$id'"; //H meavlhth stock dhlwnetai ws 0 poy shmainei oti stock den yparxei
    mysqli_query($conn,$sql);
}