<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}
if (isset ($_GET['name'])) {
    $name1 = mysqli_real_escape_string($conn, $_GET['name']);
}
if (isset ($_GET['id'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "DELETE FROM $name1 WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: india.php?name=' . $name1);
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
} else {
    echo 'ID not specified';
}

mysqli_close($conn);
?>