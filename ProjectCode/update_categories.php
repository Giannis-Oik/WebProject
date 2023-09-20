<?php
session_start();
include 'db_conn.php';

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if (isset($_POST['upload'])) {
        // Check an exei epilexthei arxeio gia na ginei upload
        if(isset($_FILES['file_to_upload']))
        {
            $file_name = $_FILES['file_to_upload']['name'];
            $file_tmp = $_FILES['file_to_upload']['tmp_name'];
            
            // Orizei/specify to directory gia na ginei store to arxeio pou tha ginei upload
            $upload_directory = ""; 
            
            //To arxeio tha ginei move se afto to directory
            if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            
                $filename = $upload_directory . $file_name; // Path sto uploaded file
                
                // Diavazei kai kanei decode apo to arxeio JSON ta dedomena
                $data = file_get_contents($filename);
                $array = json_decode($data, true);

                if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
                    echo "JSON Error: " . json_last_error_msg();
                } else {
                    foreach ($array as $row) {
                        $id = $row["id"];
                        $name = $row["name"];

                        // Check an iparxei i timi hdh
                        $check_sql = "SELECT * FROM categories WHERE id = '$id' AND name = '$name'";
                        $result = mysqli_query($conn, $check_sql);

                        if (mysqli_num_rows($result) > 0) {
                            $existingRow = mysqli_fetch_assoc($result);

                            if ($existingRow['name'] !== $name || $existingRow['id'] !== $id) {
                                // An ena apo afta einai diaforetiko, tote kane update
                                $update_sql = "UPDATE categories SET name = '$name' WHERE id = '$id''";
                                mysqli_query($conn, $update_sql);
                            }
                            else {
                                // An den iparxei h kathgoria
                                echo "No such value to update: '$name','$id''.<br>";
                            }
                        } 
                    }
                }
            } else {
                echo "Error updating file.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Update Subcategories</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div>
            <h1>Update Subcategories</h1>
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
} else {
    header("Location: index.php");
    exit();
}
?>
