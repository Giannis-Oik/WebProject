<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if (isset($_POST['upload'])) {
        // Check if a file has been selected for upload
        if (isset($_FILES['file_to_upload'])) {
            $file_name = $_FILES['file_to_upload']['name'];
            $file_tmp = $_FILES['file_to_upload']['tmp_name'];

            // Specify the directory where you want to store uploaded files
            $upload_directory = "./"; // Use "./" to represent the current directory

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
                // Database connection
                $sname = "localhost";
                $uname = "root";
                $password = "";
                $db_name = "test_db";
                $connect = mysqli_connect($sname, $uname, $password, $db_name, 4306);

                $filename = $upload_directory . $file_name; // Path to the uploaded file

                // Read and decode JSON data, with improved error handling
                $data = file_get_contents($filename);
                $array = json_decode($data, true);

                if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
                    echo "JSON Error: " . json_last_error_msg();
                } else {
                    $noChange = true; // Initialize a flag variable
                    foreach ($array as $row) {
                        $id = $row["id"];
                        $name = $row["name"];

                        // Check if the value with the given ID exists
                        $check_sql = "SELECT * FROM categories WHERE id = '$id' AND name = '$name'";
                        $result = mysqli_query($connect, $check_sql);

                        if (mysqli_num_rows($result) > 0) {
                            // The value exists, check if all fields are the same
                            $existingRow = mysqli_fetch_assoc($result);

                            if ($existingRow['name'] !== $name || $existingRow['id'] !== $id) {
                                // At least one field is different, perform an update
                                $update_sql = "UPDATE categories SET name = '$name' WHERE id = '$id''";
                                mysqli_query($connect, $update_sql);
                                echo "Record with ID '$id' updated successfully.<br>";
                            }
                            else {
                                // The value does not exist
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
