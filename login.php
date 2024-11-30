<?php
$sus = mysqli_connect("localhost", "root", "", "sports");

if (mysqli_connect_error()) {
    echo "Cannot Connect";
}

if (isset($_POST['username'], $_POST['password'])) {

    $query = "SELECT * FROM `login` WHERE `Name`=? AND `Pass`=?";
    
    if ($stmt = mysqli_prepare($sus, $query)) {

        mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['password']);
        
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            echo "Login successful";
            header("Location:index.php");
        } else {
            echo "<script>alert('Incorrect Password or Username');</script>";
        }
        
        mysqli_stmt_close($stmt);
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPORTS MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Fira+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <section id="home">
        <h1 class="h.primary">Welcome to GameOn!</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, deleniti aliquam natus quae amet nisi, laborum odit quas mollitia possimu!</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque atque eos minima? Asperiores </p>
    
    </section>
    
    <div id="login-container">
        <div id="login-form">
            <h2>Admin Login</h2>
            <form action="#" method="POST">
                <input type="text" name="username" placeholder="Username" >
                <input type="password" name="password" placeholder="Password" >
                <button type="submit" name="Signin">Login</button>
            </form>
            <div id="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
</html>
