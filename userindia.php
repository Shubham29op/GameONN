<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
$records = [];
if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $sql = "SELECT id, Title, country, status, size, tlimit, edetails, ephoto, cdetails, cphoto, fdetails, fphoto, rules, photo, vlink, terms, types, playerlist, artiphoto, artinfo FROM $name";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo 'No records found.';
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORTS MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/india.css">
</head>

<body>
    <div class="hero">
        <header id="navbar">
            <a class="logo">GameOn</a>
            <nav class="header">
                <ul>
                    <li class="item"><a href="userindex.php">Home</a></li>
                    <li class="item"><a href=""> About us</a></li>
                    <li class="item"><a href="">Contact us</a></li>
                    <li class="item"><a href="login.php">
                    <div class="icon1">
                        <svg fill="#FFFFFF"  viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z"/>
                        </svg>
                    </div>
                    </a></li>
                </ul>
            </nav>
        </header>
    </div>
    <div class="container">
        <?php foreach ($records as $record) { ?>
            <div>
                <a href="userdetail.php?id=<?php echo $record['id']; ?>&name=<?php echo $name; ?>" class="details">
                    <div class="element1">
                        <img src="<?php echo $record['photo']; ?>" class='drink'>
                        <h1>
                            <?php echo htmlspecialchars($record['Title']); ?>
                        </h1>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</body>

</html>