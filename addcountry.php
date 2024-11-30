<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $file1 = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "Images/" . $file1);

    $sql = "INSERT INTO country (Name, svg) VALUES ('$name','Images/$file1')";
    $sql1 = $sql1 = "CREATE TABLE $name (
        id1 INT(11),
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        Title VARCHAR(255),
        country VARCHAR(255),
        status VARCHAR(255),
        size int,
        tlimit VARCHAR(255),
        edetails LONGTEXT,
        ephoto VARCHAR(400),
        cdetails LONGTEXT,
        cphoto VARCHAR(400),
        fdetails LONGTEXT,
        fphoto VARCHAR(255),
        rules LONGTEXT,
        photo VARCHAR(255),
        vlink VARCHAR(255),
        terms LONGTEXT,
        types LONGTEXT,
        playerlist LONGTEXT,
        time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        artiphoto VARCHAR(255),
        artinfo LONGTEXT,
        nop varchar(400),
        timelimit varchar(400) DEFAULT '0',
        coo varchar(400),
        vidname varchar(400)
    )";
    
    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD-COUNTRY</title>
    <link rel="stylesheet" href="./css/add.css">
    <link rel="stylesheet" href="./css/styles.css">
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
    </div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="Name">Name of country:</label>
            <input type="text" placeholder="Enter country name" name="Name" required>
            <label for="file">Photo in svg format:</label>
            <input type="file" name="file" required>
            <button type="submit" name='submit'>SUBMIT</button>
        </form>
    </div>
</body>

</html>