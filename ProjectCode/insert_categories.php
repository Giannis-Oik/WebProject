<?php
session_start();
include 'db_conn.php';

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_POST['upload']))
    {
        // Check if a file has been selected for upload
        if(isset($_FILES['file_to_upload']))
        {
            $file_name = $_FILES['file_to_upload']['name'];
            $file_tmp = $_FILES['file_to_upload']['tmp_name'];
            
            // Specify the directory where you want to store uploaded files
            $upload_directory = ""; // Use "./" to represent the current directory
            
            // Move the uploaded file to the desired directory
            if(move_uploaded_file($file_tmp, $upload_directory . $file_name))
            {
                $filename = $upload_directory . $file_name; // Path to the uploaded file
                
                // Read and decode JSON data, with improved error handling
                $data = file_get_contents($filename);
                $array = json_decode($data, true);
                
                if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
                    echo "JSON Error: " . json_last_error_msg();
                } else {
                    foreach($array as $row){
                        $id = $row["id"];
                        $name = $row["name"];

                        // Check if the value already exists in the database
                        $check_sql = "SELECT * FROM categories WHERE name = '$name' AND id='$id'";
                        $result = mysqli_query($conn, $check_sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "Value '$name', '$id' already exists in the database.<br>";
                        } else {
                            // Perform SQL insertion
                            $sql = "INSERT INTO categories(id,name) VALUES ('$id','$name')";
                             mysqli_query($conn, $sql);
                        }
                    }
                }
            }
            else
            {
                echo "Error inserting file.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Insert Categories</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div>
            <h1>Insert Categories</h1>
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
