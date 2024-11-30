<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
$records = [];
if (isset ($_GET['name'])) {
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
                    <li class="item"><a href="index.php">Home</a></li>
                    <li class="item"><a href=""> About us</a></li>
                    <li class="item"><a href="">Contact us</a></li>
                    <li class="item"><a href="userindex.php" onclick="return confirm('Are you sure you want to LOGOUT?')"><div class="icon-container">
                    <svg class="icon1" viewBox="0 0 24 24" fill="#000000" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 12L13 12" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </div>
                    </a></li>
                </ul>
            </nav>
        </header>
        <a href="indiaform.php?name=<?php echo $name; ?>" class="add">+ADD GAMES</a>
    </div>
    <div class="container">
        <?php foreach ($records as $record) { ?>
            <div>
                <a href="detail.php?id=<?php echo $record['id']; ?>&name=<?php echo $name; ?>" class="details">
                    <div class="element1">
                        <img src="<?php echo $record['photo']; ?>" class='drink'>
                        <h1>
                            <?php echo htmlspecialchars($record['Title']); ?>
                        </h1>
                    </div>
                </a>
                <a href="edit.php?id=<?php echo $record['id']; ?>&name=<?php echo $name; ?>" class="edit"><img
                        src="./svg/edit.svg"></a>
                <a href="delete.php?id=<?php echo $record['id']; ?>&name=<?php echo $name; ?>" class="edit"
                    onclick="return confirm('Are you sure you want to delete this game?')"><img src="./svg/delete.svg"></a>
            </div>
        <?php } ?>
    </div>
</body>

</html>