<?php
session_start();
include "db_conn.php";

$image774 = '<img src="https://shop-cdn-m.mediazs.com/bilder/purina/one/sterilcat/8/400/324705_nestle_purina_one_sterilcat_rind_mhi_de_8.jpg" width="100px" height="100px">';
$image978 = '<img src="https://greenmall.gr/wp-content/uploads/2018/11/198694.jpg" width="100px" height="100px">';
$image897 = '<img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQdZjVFw_Y6JXDlBBT36p_A07xs3BF4mEP4THBvhohxMu8-crr_o06ISOqck6-zj44p5nAj1kq7gPy7N6_XmB5VVHJMqP0mhQvCiLJ2tjP4WV32FE-QLqeGdD-cbQBz&usqp=CAc" width="100px" height="100px">';
$image930 = '<img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTrjqplE9tEbMHupaNW5f3mlxiG14qjcNfYFcWl6Peb6wjgYOd7R1jJeG7k2sUBrqg54ufZ7jUSh3yAAcLOKdyKp60Aq8sBNmZar0L2kukl6y7mx6SyCrvkVNW-sVCoIVCeeMyRN1cy&usqp=CAc" width="100px" height="100px">';
$image980 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA_%CE%9C%CE%B5%CF%81%CE%BB%CE%AF%CE%BD_%CE%9B%CE%B1%CE%BD%CE%B5_%CE%9B%CE%B5%CE%B9%CF%84_%CE%9D%CE%B1%CE%B2%CE%B5%CE%BB_%CE%9B%CE%B5%CE%B9%CF%84_%CE%95%CE%B3%CF%87_%CE%A7%CF%85%CE%BC_%CE%A3%CF%85%CF%83%CE%BA%CE%9D%CE%B1.jpg" width="100px" height="100px">';
$image1018 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%93%CE%B1%CF%84%CE%A6%CE%B7_%CE%9C%CE%BF%CF%83%CF%87%CE%B1%CF%81%CE%B9_%CE%A0%CE%B1%CF%84%CE%B5_Friskies_400%CE%93%CE%A1.jpg" width="100px" height="100px">';
$image1060= '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9D%CF%84%CE%BF%CE%BC%CE%AC%CF%84%CE%B5%CF%82_%CE%95%CE%B9%CF%83_%CE%91.jpg" width="100px" height="100px">';
$image1077 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Coca_Cola_250ML_%CE%9C%CF%80%CE%BF%CF%85%CE%BA_%CE%A0%CE%B5%CF%81%CE%B9%CE%B5%CF%87%CE%BF%CE%BC%CE%B5%CE%BD%CE%BF.png" width="100px" height="100px">';
$image1110 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%93%CE%B1%CF%84%CE%A6%CE%B7_Whiskas_%CE%A0%CE%BF%CF%85%CE%BB_%CE%A3%CE%B5_%CE%A3%CE%B1%CE%BB%CF%84%CF%83%CE%B1_100%CE%93%CE%A1.jpg" width="100px" height="100px">';
$image1112 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9A%CE%BF%CE%BB%CE%BF%CE%BA%CF%85%CE%B8%CE%AC%CE%BA%CE%B9%CE%B1_%CE%95%CE%B3%CF%87.jpg" width="100px" height="100px">';
$image1142 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9C%CE%AE%CE%BB%CE%B1_%CE%A3%CF%84%CE%AC%CF%81%CE%BA%CE%B9%CE%BD_%CE%A7%CF%8D%CE%BC%CE%B1.jpg" width="100px" height="100px">';
$image1152 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Coca_Cola_2x1%2C5lit.jpg" width="100px" height="100px">';
$image1153 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Sprite_%CE%91%CE%BD%CE%B1%CF%88%CF%85%CE%BA%CF%84%CE%B9%CE%BA%CF%8C_%CE%9B%CE%B5%CE%BC%CE%BF%CE%BD%CE%AC%CE%B4%CE%B1_6X330ml.jpg" width="100px" height="100px">';
$image1178 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A7%CF%85%CE%BC%CF%8C%CF%82_%CE%8C%CE%BB%CF%85%CE%BC%CF%80%CE%BF%CF%82_%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA%CE%AC%CE%BB%CE%B9_%CE%A6%CF%85%CF%83%CE%B9%CE%BA%CF%8C%CF%82_1%2C5lit.jpg" width="100px" height="100px">';
$image1201 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9A%CE%B1%CF%81%CF%80%CE%BF%CF%8D%CE%B6%CE%B9%CE%B1_%CE%9C%CE%AF%CE%BD%CE%B9_%CE%95%CE%B3%CF%87.jpg" width="100px" height="100px">';
$image1203 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A6%CE%A1%CE%9F%CE%A5%CE%A4%CE%9F%CE%A0OTO_FRULITE_%CE%A0%CE%9F%CE%A1%CE%A4%CE%92%CE%95%CE%A1%CE%99%CE%9A_500ML.jpg" width="100px" height="100px">';
$image1224 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9A%CF%81%CE%B5%CE%BC%CE%BC%CF%8D%CE%B4%CE%B9%CE%B1_%CE%9E%CE%B1%CE%BD%CE%B8%CE%AC_%CE%9E%CE%B5%CF%81%CE%AC_%CE%95%CE%B9%CF%83.jpg" width="100px" height="100px">';
$image1236 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9D%CF%84%CE%BF%CE%BC%CE%AC%CF%84%CE%B5%CF%82_%CE%95%CE%B3%CF%87_%CE%A5%CF%80%CE%B1%CE%B9%CE%B8%CF%81_%CE%92.jpg" width="100px" height="100px">';
$image1260 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%9C%CF%80%CF%81%CF%8C%CE%BA%CE%BF%CE%BB%CE%B1_%CE%A0%CF%81%CE%AC%CF%83%CE%B9%CE%BD%CE%B1_%CE%95%CE%B3%CF%87.jpg" width="100px" height="100px">';
$image1266 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A7%CF%85%CE%BC%CE%BF%CF%83_%CE%A3%CF%85%CE%BC%CF%80Cool_Hellas_%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA%CE%B1%CE%BB1LT.jpg" width="100px" height="100px">';
$image1305 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Frulite_%CE%A3%CE%B1%CE%B3%CE%BA%CE%BF%CF%85%CE%AF%CE%BD%CE%B9-%CE%9C%CE%B1%CE%BD%CF%84%CE%B1%CF%81%CE%AF%CE%BD%CE%B9_1lit.jpg" width="100px" height="100px">';
$image1322 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Fanta_%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA%CE%AC%CE%BB%CE%B9_1%2C5%CE%BB%CE%B9%CF%84.jpg" width="100px" height="100px">';
$image1332 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/Tuborg_%CE%A3%CE%BF%CE%B4%CE%B1_%CE%9A%CE%BF%CF%85%CF%84%CE%B9_330ML.jpg" width="100px" height="100px">';
$image1336 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA_%CE%9C%CE%B5%CF%81%CE%BB%CE%AF%CE%BD_%CE%9B%CE%B1%CE%BD%CE%B5_%CE%9B%CE%B5%CE%B9%CF%84_%CE%9D%CE%B1%CE%B2%CE%B5%CE%BB_%CE%9B%CE%B5%CE%B9%CF%84_%CE%95%CE%B3%CF%87_%CE%A7%CF%85%CE%BC_%CE%A3%CF%85%CF%83%CE%BA%CE%9D%CE%B1.jpg" width="100px" height="100px">';
$image1337 = '<img src="https://warply.s3.amazonaws.com/applications/ed840ad545884deeb6c6b699176797ed/products/%CE%A7%CF%85%CE%BC%CF%8C%CF%82_%CE%8C%CE%BB%CF%85%CE%BC%CF%80%CE%BF%CF%82_%CE%A0%CE%BF%CF%81%CF%84%CE%BF%CE%BA%CE%AC%CE%BB%CE%B9_%CE%A6%CF%85%CF%83%CE%B9%CE%BA%CF%8C%CF%82_1lit.jpg" width="100px" height="100px">';


$currentuser = $_SESSION['id'];

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

            input[name=delete]
            {
                background-image: url(delete.png);
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
    $sql = "SELECT products.name, sales.product_id, sales.price, sales.date, sales.id, sales.likes, sales.dislikes, sales.stock, sales.user_id FROM sales INNER JOIN products ON sales.product_id = products.id WHERE sales.shop_id = '$input' AND active = 1";
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
            $prod_id = $row['product_id'];

            $sqluser = "SELECT user_name, score FROM users WHERE id='$user'"; //Antlhsh user name score tou xrhsth poy epevale thn prosfora
            $res = mysqli_query($conn, $sqluser);
            $r = mysqli_fetch_assoc($res);
            $user_name = $r['user_name'];
            $score = $r['score'];

            switch ($prod_id)
            {
                case 774:
                    echo $image774;
                    break;
                case 978:
                    echo $image978;
                    break;
                case 897:
                    echo $image897;
                    break;
                case 930:
                    echo $image930;
                    break;
                case 980:
                    echo $image980;
                    break;
                case 1018:
                    echo $image1018;
                    break;
                case 1060:
                    echo $image1060;
                    break;
                case 1077:
                    echo $image1077;
                    break;
                case 1110:
                    echo $image1110;
                    break;
                case 1112:
                    echo $image1112;
                    break;
                case 1142:
                    echo $image1142;
                    break;
                case 1152:
                    echo $image1152;
                    break;
                case 1153:
                    echo $image1153;
                    break;
                case 1178:
                    echo $image1178;
                    break;
                case 1201:
                    echo $image1201;
                    break;
                case 1203:
                    echo $image1203;
                    break;
                case 1224:
                    echo $image1224;
                    break;
                case 1236:
                    echo $image1236;
                    break;
                case 1260:
                    echo $image1260;
                    break;
                case 1266:
                    echo $image1266;
                    break;
                case 1305:
                    echo $image1305;
                    break;
                case 1322:
                    echo $image1322;
                    break;
                case 1332:
                    echo $image1332;
                    break;
                case 1336:
                    echo $image1336;
                    break;
                case 1337:
                    echo $image1337;
                    break;
                default:
                    echo "No available image for this product";
                    break;
            }

            if($stock > 0)
            {
                echo '<p>'.'Product: '.$name.'<br>'.'Price: '.$price.'<br>'.'Date submitted: '.$date.'<br>'.'Likes: '.$likes.'<br>'.'Dislikes: '.$dislikes.'<br>'.'Stock: In stock <br>'.'Username: '.$user_name.'<br>'.'Score: '.$score.'</p>'; //Emfanisi prosforas

            }else
            {
                echo '<p>'.'Product: '.$name.'<br>'.'Price: '.$price.'<br>'.'Date submitted: '.$date.'<br>'.'Likes: '.$likes.'<br>'.'Dislikes: '.$dislikes.'<br>'.'Stock: Out of stock <br>'.'Username: '.$user_name.'<br>'.'Score: '.$score.'</p>'; //Emfanisi prosforas

            }
        
            echo '<form class="form-inline" action="sales.php?input='.$input.'" method="post">'; //Dhmiourgia formas gia ta like,dislike kai ta koympia gia to apothema
            echo '<input type="hidden" name="id" value='.$sales_id.'>';
            if($stock > 0) //An yparxei apothema
            {
                echo '<input type="submit" name="like" value="">';
                echo '<input type="submit" name="dislike" value="">';
                echo '<input type="submit" name="on_stock" value="">';
                echo '<input type="submit" name="out_of_stock" value="">';
                echo '<input type="submit" name="delete" value="">';
            }else //An den yparxei apothema
            {
                echo '<input type="submit" name="on_stock" value="">';
                echo '<input type="submit" name="out_of_stock" value="">';
                echo '<input type="submit" name="delete" value="">';
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

    $sql = "UPDATE users SET score = score + 5, monthly_score = monthly_score + 5 WHERE id='$user'"; //Ayxhse score xrhsth
    mysqli_query($conn,$sql);

    $sql = "UPDATE admins SET likes = likes + 1 WHERE id ='$currentuser'"; //Update arithmou likes gia ton xrhsth 
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

    $sql = "UPDATE users SET score = score - 1, monthly_score = monthly_score - 1 WHERE id='$user'"; //Meiwse score xrhsth
    mysqli_query($conn,$sql);

    $sql = "UPDATE admins SET dislikes = dislikes + 1 WHERE id ='$currentuser'"; //Update arithmou dislikes gia ton xrhsth 
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

}else if(isset($_POST['delete']))
{
    $id = $_POST['id'];

    $sql = "DELETE FROM sales WHERE id='$id'"; //Diegrapse thn prosfora
    mysqli_query($conn,$sql);
}