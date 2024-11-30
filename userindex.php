<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}
$sql = 'SELECT id, name, time, svg FROM country ORDER BY time';
$result = mysqli_query($conn, $sql);
$records = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORTS MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="hero">
        <header id="navbar">

            <a class="logo">GameOn</a>
            <nav class="header">
                <ul>
                    <li class="item"><a href="#">Home</a></li>
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
        <a href="filter.php" class="add"><img src="./svg/filter.svg" class="filtericon"></a>
    </div>
    <div class="scrolll">
        <button class="icon" onclick="scrollr()"><img src="./svg/before.svg" class="next"></button>

        <div class="scroll">
            <?php foreach ($records as $record) { ?>
                <div class="element">
                    <a href="userindia.php?name=<?php echo $record['name']; ?>" class="details">
                        <div class="content">
                            <img src="<?php echo $record['svg']; ?>" class='drink'>
                            <h1>
                                <?php echo htmlspecialchars($record['name']); ?>
                            </h1>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <button class="icon" onclick="scrolll()"><img src="./svg/next.svg" class="next"></button>
    </div>
    <script src="index.js"></script>
    </div>
    </div>
</body>

</html>