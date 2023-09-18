<?php
session_start();
include "db_conn.php";

$currentuser = $_SESSION['id'];

$sql = "SELECT name, id FROM products";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{
    $products[] = $row['name'];
    $prod_id[] = $row['id'];
}

?>

<!DOCTYPE html>
    <html>
    <head>
        <title>New sale submission</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #pid{
                color: #FFF;
            }

            input[name=stock]{
                margin: auto;
            }

            input[name=search]{
                position: sticky;
                top: 50px;
                width: 50%;
            }

            #tab{
                width: 50%;
                height: 100;
                align: left;
            }
        </style>
    </head>
    <body>

    <h4>Search for a product and show its product id</h4>
    <input id="searchbar" type="text" name="search" placeholder="Search products..."> <!-- Mpara anazhthshs kai pinakas me ola ta proionta pros anazhthsh -->
    
    <div style="overflow-x:auto;" id="tab">
    <table id="prod">
        <?php
            for($i = 0; $i < count($products); $i++)
            {
                echo '<tr> <td> Product name: '.$products[$i].' id: '.$prod_id[$i].'</td> </tr>';
            }
        ?>
    </table>
    </div>

    <h4>Select a product from the dropdown menu and submit the form to show its product id below</h4>
    <form method="post"> <!-- Forma h opoia emfanizei dropdown menu gia epilogh proiontos -->
        <div>
            <label for="products">Products:</label>
            <select name="products" id="products">
                <option value="">Select product</option>
                <?php
                    for ($i = 0; $i < count($products); $i++) 
                    {
                        echo '<option value="'.$products[$i].'">'.$products[$i].'</option>'."\n";
                    } 
                ?>
            </select>
        </div>
        <div>
            <button type="submit">Select product</button>
        </div>
    </form>

    <?php
        $product = filter_input(INPUT_POST, 'products', FILTER_SANITIZE_STRING); //Emfanish tou id toy epilegmenoy proiontos apo thn prohgoymenh forma. An h forma kenh tote epistrefei id = 0;

        $sql = "SELECT * FROM products WHERE name='$product'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
        }else {$row['id'] = 0;}
    ?>

    <h4>Sale submission form. Here you can submit the sale for a product providing the appropriate product id and shop id</h4> <!--Forma gia katathesi prosforas -->
    <form action="" method="post">
        <p id="pid"><?php echo "Your chosen product id is: ".$row['id']; ?></p>
        <div>
            <label for="shop">Insert the shop id from the map:</label>
            <input type="text" name="shop_id">
            
            <label for="product">Insert the product id from the product you chose:</label>
            <input type="text" name="product_id">
            
            <label for="price">Price of sale:</label>
            <input type="text" name="price">

            <label for="stock">In stock:</label>
            <input type="radio" name="stock" value="in">

            <label for="stock">Out of stock:</label>
            <input type="radio" name="stock" value="out">
        </div>
        <div>
            <button type="submit">Submit sale</button>
        </div>
    </form>

    <?php
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING); 
        $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_STRING); 
        $product = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_STRING); 
        $shop = filter_input(INPUT_POST, 'shop_id', FILTER_SANITIZE_STRING); 
        $date = date('Y-m-d');

        if($stock == "in" && isset($price) && isset($shop) && isset($product)) //Eisagwgi ths prosforas sth vash
        {
            $sql = "INSERT INTO sales(price,date,active,stock,shop_id,product_id, admin_id) VALUES('$price','$date',1,1,'$shop','$product','$currentuser')";
            mysqli_query($conn, $sql);
        }else if($stock == "out" && isset($price) && isset($shop) && isset($product))
        {
            $sql = "INSERT INTO sales(price,date,active,stock,shop_id,product_id, admin_id) VALUES('$price','$date',1,0,'$shop','$product','$currentuser')";
            mysqli_query($conn, $sql);
        }

        if(isset($shop) && isset($price) && isset($product) && isset($stock)) //An exei katatethei egkyrh prosfora antlhse ta dedomena timwn apo th vash kai elegxe ta krithria
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

            $earned = 0;
            if($price <= $week_perc) //An h timh xamhlwterh apo 20% ths evdomadiaias
            {
                $sql = "UPDATE admins SET score = score + 20, monthly_score = monthly_score + 20 WHERE id='$currentuser'";
                mysqli_query($conn,$sql);
                $sql = "UPDATE sales SET below_week_price = 1 WHERE price='$price' AND product_id='$product' AND shop_id='$shop'";
                mysqli_query($conn,$sql);
                $earned += 20;
            }

            if($price <= $day_perc) //An h timh xamhlwterh apo 20% ths prohgoymenhs hmeras
            {
                $sql = "UPDATE admins SET score = score + 50, monthly_score = monthly_score + 50 WHERE id='$currentuser'";
                mysqli_query($conn,$sql);
                $sql = "UPDATE sales SET below_day_price = 1 WHERE price='$price' AND product_id='$product' AND shop_id='$shop'";
                mysqli_query($conn,$sql);
                $earned += 50;
            }

            if($earned > 0)
            {
                echo "Your sale was published succesfully and you earned ".$earned." points";
            }else if($earned == 0)
            {
                echo "Your sale was published succesfully but you didnt earn any points";
            }
        }
    ?>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $('table').hide(); //Script to opoio analoga me thn anazhthsh toy xrhsth sto search bar emfanizei osa proionta moiazoun me to input
        $('#searchbar').on("keyup", function(){ 
            var searchVal = $('#searchbar').val();
            if(searchVal =="")
            {
                $('table').hide();
            }
            else
            {
                $('table').show();
                $('table tr td').show();
                $('table tr td:not(:contains("' + searchVal + '"))').hide();
            }
        });

        jQuery.expr[':'].contains = function(a, index, obj) { //Override ths contain function gia case sensitivity
            return jQuery(a).text().toUpperCase().indexOf(obj[3].toUpperCase()) >= 0;
        };
    </script>
</html>