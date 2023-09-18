<?php
session_start();
include "db_conn.php";

$sql="SELECT name FROM categories";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
    $categories[]=$row['name'];
}
$sql="SELECT name FROM subcategories";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
    $subcategories[]=$row['name'];
}



if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) 
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Daily sales number stats</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            #percent
            {
                height: 50vh; 
                width: 50%;
            }
        </style>
    </head>
    <body>
        <h4>Select at least a category and a week from the options below to show the stats for the percentage sales price for the items of selected category for that week</h4>
        <p>If you dont select a subcategory then the stats will be from all items in that category</p>
        <form method="post"> <!-- Forma h opoia emfanizei dropdown menus gia kathgories, ypokathgories kai evdomadwn mesw ths opoias epilegei o admin poia statistika na emfanisei -->
            <div>
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="">Select category</option>
                    <?php
                        for ($i = 0; $i < count($categories); $i++) 
                        {
                            echo '<option value="'.$categories[$i].'">'.$categories[$i].'</option>'."\n";
                        } 
                    ?>
                </select>
                
                <label for="subcategory">Subcategory:</label>
                <select name="subcategory" id="subcategory">
                    <option value="">Select subcategory</option>
                    <?php
                        for ($i = 0; $i < count($subcategories); $i++) 
                        {
                            echo '<option value="'.$subcategories[$i].'">'.$subcategories[$i].'</option>'."\n";
                        } 
                    ?>
                </select>

                <label for="week">Week:</label>
                <select name="week" id="week">
                    <option value="">Select week</option>
                    <option value="1">Week 1</option>
                    <option value="2">Week 2</option>
                    <option value="3">Week 3</option>
                    <option value="4">Week 4</option>
                </select>
            </div>
            <div>
                <button type="submit">Select</button>
                <button type="button" onclick="location.href='admin_home.php'">Home</button>
            </div>
        </form>
        <div>
            <canvas id="percent"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <?php 
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
            $subcategory = filter_input(INPUT_POST, 'subcategory', FILTER_SANITIZE_STRING);
            $week = filter_input(INPUT_POST, 'week', FILTER_SANITIZE_STRING);

            if($category && $week)
            {
                if($week == 1)
                {
                    $sql = "SELECT category_id FROM subcategories WHERE name='$subcategory'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $id = $row['category_id'];
                        }
                    }else{ $id = 0;}
                    
                    $sql = "SELECT * FROM categories WHERE id= '$id'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $name = $row['name'];
                        }
                    }else { $name = "";}

                    if($name == $category)
                    {   
                        $sql = "SELECT * FROM subcategories WHERE name='$subcategory'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $subcat_id = $row['id'];
                            }
                        }

                        $sql = "SELECT * FROM products WHERE subcategory='$subcat_id'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/01' AND '2023/09/07'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {1: total, 2: total, 3: total, 4: total, 5: total, 6: total, 7: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 1 of September',
                                            data: total_array,
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
                    else
                    {
                        $sql = "SELECT id FROM categories WHERE name='$category'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $cat_id = $row['id'];
                            }
                        }
                        
                        $sql = "SELECT * FROM products WHERE category='$cat_id'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/01' AND '2023/09/07'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {1: total, 2: total, 3: total, 4: total, 5: total, 6: total, 7: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 1 of September',
                                            data: total_array,
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
                }
                else if($week == 2)
                {
                    $sql = "SELECT category_id FROM subcategories WHERE name='$subcategory'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $id = $row['category_id'];
                        }
                    }else{ $id = 0;}
                    
                    $sql = "SELECT * FROM categories WHERE id= '$id'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $name = $row['name'];
                        }
                    }else { $name = "";}

                    if($name == $category)
                    {   
                        $sql = "SELECT * FROM subcategories WHERE name='$subcategory'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $subcat_id = $row['id'];
                            }
                        }

                        $sql = "SELECT * FROM products WHERE subcategory='$subcat_id'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/08' AND '2023/09/14'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {8: total, 9: total, 10: total, 11: total, 12: total, 13: total, 14: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 2 of September',
                                            data: total_array,
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
                    else
                    {
                        $sql = "SELECT id FROM categories WHERE name='$category'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $cat_id = $row['id'];
                            }
                        }
                        
                        $sql = "SELECT * FROM products WHERE category='$cat_id'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/08' AND '2023/09/14'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {8: total, 9: total, 10: total, 11: total, 12: total, 13: total, 14: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 2 of September',
                                            data: total_array,
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
                }
                else if($week == 3)
                {
                    $sql = "SELECT category_id FROM subcategories WHERE name='$subcategory'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $id = $row['category_id'];
                        }
                    }else{ $id = 0;}
                    
                    $sql = "SELECT * FROM categories WHERE id= '$id'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $name = $row['name'];
                        }
                    }else { $name = "";}

                    if($name == $category)
                    {   
                        $sql = "SELECT * FROM subcategories WHERE name='$subcategory'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $subcat_id = $row['id'];
                            }
                        }

                        $sql = "SELECT * FROM products WHERE subcategory='$subcat_id'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/15' AND '2023/09/21'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {15: total, 16: total, 17: total, 18: total, 19: total, 20: total, 21: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 3 of September',
                                            data: total_array,
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
                    else
                    {
                        $sql = "SELECT id FROM categories WHERE name='$category'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $cat_id = $row['id'];
                            }
                        }
                        
                        $sql = "SELECT * FROM products WHERE category='$cat_id'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/15' AND '2023/09/21'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {15: total, 16: total, 17: total, 18: total, 19: total, 20: total, 21: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 3 of September',
                                            data: total_array,
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
                }
                else if($week == 4)
                {
                    $sql = "SELECT category_id FROM subcategories WHERE name='$subcategory'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $id = $row['category_id'];
                        }
                    }else{ $id = 0;}
                    
                    $sql = "SELECT * FROM categories WHERE id= '$id'";
                    $result = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $name = $row['name'];
                        }
                    }else { $name = "";}

                    if($name == $category)
                    {   
                        $sql = "SELECT * FROM subcategories WHERE name='$subcategory'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $subcat_id = $row['id'];
                            }
                        }

                        $sql = "SELECT * FROM products WHERE subcategory='$subcat_id'";
                        $result = mysqli_query($conn,$sql);
                        
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/22' AND '2023/09/28'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                {22: total, 23: total, 24: total, 25: total, 26: total, 27: total, 28: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 4 of September',
                                            data: total_array,
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
                    else
                    {
                        $sql = "SELECT id FROM categories WHERE name='$category'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $cat_id = $row['id'];
                            }
                        }
                        
                        $sql = "SELECT * FROM products WHERE category='$cat_id'";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $prod_id[] = $row['id'];
                            }
                        }

                        $prices = array();
                        $percent = array();
                        for($i = 0; $i < count($prod_id); $i++)
                        {
                            $prod = $prod_id[$i];
                            $sum = 0;
                            $count = 0;

                            $sql = "SELECT SUM(price) as sum, COUNT(*) as count FROM sales WHERE product_id='$prod'";
                            $result = mysqli_query($conn,$sql);
                        
                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    $sum = $row['sum'];
                                    $count = $row['count'];
                                    if($sum == 0 || $count == 0)
                                    {
                                        $prices[$prod] = 0;
                                    }
                                    else 
                                    {
                                        $prices[$prod] = $sum/$count;
                                    }
                                }
                            }

                            $sql = "SELECT price FROM weekly_prices WHERE product_id='$prod' AND date BETWEEN '2023/09/22' AND '2023/09/28'";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                    if($prices[$prod] != 0)
                                    {
                                        $percent[$prod] = (($row['price'] - $prices[$prod])/$row['price'])*100;
                                        $percent[$prod] = ceil($percent[$prod]);
                                    }else
                                    {
                                        $percent[$prod] = 0;
                                    }
                                }
                            }
                        }

                        $total = 0;
                        foreach($percent as $prod_price)
                        {
                            $total += $prod_price;
                        }

                        $total = ($total/count($percent));

                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                var total = <?php echo $total ?>;

                                var total_array = {22: total, 23: total, 24: total, 25: total, 26: total, 27: total, 28: total};
                                const chart = document.getElementById('percent');

                                new Chart(chart, {
                                    type: 'bar',
                                    data: {
                                        labels: [],
                                        datasets: [{
                                            label: 'Mean sales percentage for week 4 of September',
                                            data: total_array,
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
                }
            }
            else
            {
                echo "Please select a category and a week to show";
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