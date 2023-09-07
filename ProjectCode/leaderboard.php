<?php
session_start();
include "db_conn.php";
$sql = "SELECT user_name, score, tokens, monthly_tokens  FROM users GROUP BY id ORDER BY score DESC";
$result = mysqli_query($conn,$sql);
            
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $users_array[] = "Username: ". $row['user_name'] . ",\t user score: " . $row['score'] . ",\t all-time tokens: " . $row['tokens'] . ",\t tokens of this month: " . $row['monthly_tokens'] . "";
    }
}

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <title>LEADERBOARD</title>
        <link rel="stylesheet" type="text/css" href="style.css">

        <style>
            .list {
                text-align: center;
                width: 50%;
                border: 1px solid black;
            }

            .list .item {
                border: 1px solid black;
                padding: 10px; 
            }

            .list .item:hover {
                background: rgba(0, 0, 0, 0.05);
            }

            .pagenumbers {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }

            .pagenumbers button {
                width: 40px;
                height: 40px;

                appearance: none;
                border: none;
                outline: none;
                cursor: pointer;

                background-color: #ff0019;

                margin: 5px;
                transition: 0.4s;

                color: #FFF;
                font-size: 15px;
                text-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
                box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
            }

            .pagenumbers button.active {
                background-color: #00ff40;
                box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.2);
            }
        </style>
    </head>
    <body>
        <h1>All-time user score leaderboard</h1>
        <div class="list" id="list"></div>
        <div class="pagenumbers" id="pagination"></div>
    <script>
        const users = <?php echo json_encode($users_array); ?>;
        const list_element = document.getElementById("list");
        const page_element = document.getElementById("pagination");

        let current_page = 1;
        let rows = 10;
        let page_count = Math.ceil(users.length/rows);

        function DisplayBoard(items, wrapper, rows_ppg, page)
        {
            wrapper.innerHTML = "";
            page--;

            let start = rows_ppg*page;
            let end = rows_ppg + start;
            let page_items = items.slice(start, end);

            for(let i = 0; i < page_items.length; i++)
            {
                let item = page_items[i];

                let item_element = document.createElement('div');
                item_element.classList.add('item');
                item_element.innerText = item;

                wrapper.appendChild(item_element);
            }
        }

        function PageButton(page, items)
        {
            let button = document.createElement('button');
            button.innerText = page;

            if(current_page == page) {button.classList.add('active');}

            button.addEventListener('click', function(){
                current_page = page;
                DisplayBoard(items, list_element, rows, current_page);

                let btn = document.querySelector('.pagenumbers button.active');
                btn.classList.remove('active');

                button.classList.add('active');
            });

            return button;
        }

        function DisplayPages(items, wrapper, page)
        {
            wrapper.innerHTML = "";

            for(let i = 1; i < page_count + 1; i++)
            {
                let button = PageButton(i, items);
                wrapper.appendChild(button);
            }
        }


        DisplayBoard(users, list_element, rows, current_page);
        DisplayPages(users, page_element, current_page);
    </script>
    </body>
    </html>

    <?php
}
else
{
    header("Location: index.php");
    exit();
}