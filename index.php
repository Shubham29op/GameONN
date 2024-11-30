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
            <a href="filter.php" class="add"><img src="./svg/filter.svg" class="filtericon"></a>

        </header>
        <a href="addcountry.php" class="add1">+ADD COUNTRY</a>
    </div>
    <div class="scrolll">
        <button class="icon" onclick="scrollr()"><img src="./svg/before.svg" class="next"></button>

        <div class="scroll">
            <?php foreach ($records as $record) { ?>
                <div class="element">
                    <a href="india.php?name=<?php echo $record['name']; ?>" class="details">
                        <div class="content">
                            <img src="<?php echo $record['svg']; ?>" class='drink'>
                            <h1>
                                <?php echo htmlspecialchars($record['name']); ?>
                            </h1>
                        </div>
                    </a>
                    <a href="deletecountry.php?name=<?php echo $record['name'];?>" class="edit"
                    onclick="return confirm('Are you sure you want to delete this game?')"><img src="./svg/delete.svg"></a>
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