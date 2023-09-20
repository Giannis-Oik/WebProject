<?php //Arxeio pou diagrafei ta products
session_start();
include 'db_conn.php';

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_POST['upload']))
    {
        // Check an exei epilexthei arxeio gia na ginei upload
        if(isset($_FILES['file_to_upload']))
        {
            $file_name = $_FILES['file_to_upload']['name'];
            $file_tmp = $_FILES['file_to_upload']['tmp_name'];
            
            // Orizei/speci to directory gia na ginei store to arxeio pou tha ginei upload
            $upload_directory = ""; 
            
            //To arxeio tha ginei move se afto to directory
            if(move_uploaded_file($file_tmp, $upload_directory . $file_name))
            {
                $filename = $upload_directory . $file_name; // Path sto uploaded file
                
                // Diavazei kai kanei decode apo to arxeio JSON ta dedomena
                $data = file_get_contents($filename);
                $array = json_decode($data, true);
                
                if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
                    echo "JSON Error: " . json_last_error_msg();
                } else {
                    foreach($array as $row){
                        $id = $row["id"];
                        $name = $row["name"];
                        $category = $row["category"];
                        $subcategory = $row["subcategory"];

                        //SQL Delete
                        $sql = "DELETE FROM products WHERE id = '$id' AND name = '$name' AND category = '$category' AND subcategory = '$subcategory'";
                        mysqli_query($conn, $sql);
                    
                        if (mysqli_query($conn, $sql)) {
                            //An den vrei to product
                            if (mysqli_affected_rows($conn) > 0) {
                                echo "No such value to delete: '$name , '$id'";
                            }
                        }
                    }
                }
            }
            else
            {
                echo "Error deleting file.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Products</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div>
            <h1>Delete Products</h1>
            <form method="post" enctype="multipart/form-data">
                <label for="file_to_upload">Upload JSON file:</label>
                <input type="file" name="file_to_upload" required>
                <input type="submit" name="upload" value="Upload">
            </form>
        </div>
        <div>
            <a href="admin_home.php">Back to Home</a>
        </div>
    </body>
    </html>

    <?php
}
else
{
    header("Location: index.php");
    exit();
}
?>
