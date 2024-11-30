<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}

if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    
    // SQL query to drop the associated table
    $dropTableSQL = "DROP TABLE IF EXISTS $name";

    // SQL query to delete the country from the 'country' table
    $deleteCountrySQL = "DELETE FROM country WHERE Name = '$name'";
    
    // Execute queries
    if (mysqli_query($conn, $dropTableSQL) && mysqli_query($conn, $deleteCountrySQL)) {
        header('Location: index.php'); // Redirect after deletion
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
