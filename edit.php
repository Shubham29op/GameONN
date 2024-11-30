
<?php
$conn = mysqli_connect('localhost', 'root', '', 'sports');
if (!$conn) {
    echo 'Connection error' . mysqli_connect_error();
}
if (isset ($_GET['name'])) {
    $name1 = mysqli_real_escape_string($conn, $_GET['name']);
}
if (isset ($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM $name1 WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    if (isset ($_POST['submit'])) {
        $id1 = mysqli_real_escape_string($conn, $_POST['id1']);
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $team_size = mysqli_real_escape_string($conn, $_POST['size']);
        $time_limit = mysqli_real_escape_string($conn, $_POST['limit']);
        $equipment_details = mysqli_real_escape_string($conn, $_POST['Equipment']);
        $costume_details = mysqli_real_escape_string($conn, $_POST['costume']);
        $footwear_details = mysqli_real_escape_string($conn, $_POST['footwear']);
        $rules = mysqli_real_escape_string($conn, $_POST['Rules']);
        $video_links = mysqli_real_escape_string($conn, $_POST['video']);
        $terminologies_used = mysqli_real_escape_string($conn, $_POST['term']);
        $other_related_types = mysqli_real_escape_string($conn, $_POST['types']);
        $celebrity_players = mysqli_real_escape_string($conn, $_POST['list']);
        $art = mysqli_real_escape_string($conn, $_POST['art']);
        $nsize = mysqli_real_escape_string($conn, $_POST['nsize']);
        $tl = mysqli_real_escape_string($conn, $_POST['tl']);
        $vname = mysqli_real_escape_string($conn, $_POST['vname']);

        $file1 = !empty ($_FILES['file1']['name']) ? "Images/" . $_FILES['file1']['name'] : $record['photo'];
        $file2 = !empty ($_FILES['file2']['name']) ? "Images/" . $_FILES['file2']['name'] : $record['ephoto'];
        $file3 = !empty ($_FILES['file3']['name']) ? "Images/" . $_FILES['file3']['name'] : $record['cphoto'];
        $file4 = !empty ($_FILES['file4']['name']) ? "Images/" . $_FILES['file4']['name'] : $record['fphoto'];
        $file5 = !empty ($_FILES['file5']['name']) ? "Images/" . $_FILES['file5']['name'] : $record['artiphoto'];


        move_uploaded_file($_FILES['file1']['tmp_name'], $file1);
        move_uploaded_file($_FILES['file2']['tmp_name'], $file2);
        move_uploaded_file($_FILES['file3']['tmp_name'], $file3);
        move_uploaded_file($_FILES['file4']['tmp_name'], $file4);
        move_uploaded_file($_FILES['file5']['tmp_name'], $file5);
        $sql = "UPDATE $name1 SET id1='$id1', Title = '$name', photo='$file1', country = '$country', status = '$status', size = '$team_size', tlimit = '$time_limit', edetails = '$equipment_details', ephoto = '$file2', cdetails = '$costume_details', cphoto = '$file3', fdetails = '$footwear_details', fphoto = '$file4', rules = '$rules', vlink = '$video_links', terms = '$terminologies_used', types = '$other_related_types', playerlist = '$celebrity_players', artiphoto = '$file5', artinfo='$art', nop='$nsize', timelimit='$tl', vidname='$vname' WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
            header('Location: india.php?name=' . $name1);
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
} else {
    echo 'ID not specified';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/edit.css">
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
        <h2>Edit Game</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="id1">Sr. No.:</label>
            <input type="text" id="id1" name="id1" placeholder="Enter Sr. No."
                value="<?php echo htmlspecialchars($record['id1']); ?>"><br>
            <label for="Name">Title:</label>
            <input type="text" id="Name" name="Name" placeholder="Enter sports title"
                value="<?php echo htmlspecialchars($record['Title']); ?>"><br>
            <label for="file1">Photo:</label>
            <input type="file" name="file1"><br>
            <?php if (!empty ($record['photo'])): ?>
                <img src="<?php echo $record['photo']; ?>" alt="Current Photo" style="max-width: 200px;"><br>
            <?php endif; ?>

            <label for="country">Country of origin:</label>
            <input type="text" id="country" name="country" placeholder="Enter Country Name"
                value="<?php echo htmlspecialchars($record['country']); ?>"><br>

            <label for="status">National/International Status:</label>
            <input type="text" id="status" name="status" placeholder="Enter status"
                value="<?php echo htmlspecialchars($record['status']); ?>"><br>

            <label for="size">Number of players:</label>
            <input type="text" id="size" name="size" placeholder="Enter team size"
                value="<?php echo htmlspecialchars($record['size']); ?>"><br>

            <label for="nsize">Number of players (for filter enter integer only):</label>
            <input type="text" placeholder="Enter no. of players" name="nsize" value="<?php echo htmlspecialchars($record['nop']); ?>"><br>
            <label for="tl">Time limit in minutes (for filter enter only integer):</label>
            <input type="text" placeholder="Enter 0 if not applicable" name="tl" value="<?php echo htmlspecialchars($record['timelimit']); ?>"><br>
            <label for="limit">Time limit:</label>
            <input type="text" id="limit" name="limit" placeholder="Enter time limit"
                value="<?php echo htmlspecialchars($record['tlimit']); ?>"><br>

            <label for="Equipment">Equipment details:</label>
            <textarea id="Equipment" name="Equipment"
                placeholder="Enter equipments"><?php echo htmlspecialchars($record['edetails']); ?></textarea><br>

            <label for="file2">Equipment Photo:</label>
            <input type="file" name="file2"><br>
            <?php if ($record['ephoto'] !== 'Images/'): ?>
                <img src="<?php echo $record['ephoto']; ?>" alt="Current Equipment Photo" style="max-width: 200px;"><br>
            <?php endif; ?>

            <label for="costume">Costume details:</label>
            <textarea id="costume" name="costume"
                placeholder="Enter costume details"><?php echo htmlspecialchars($record['cdetails']); ?></textarea><br>

            <label for="file3">Costume Photo:</label>
            <input type="file" name="file3"><br>
            <?php if ($record['cphoto'] !== 'Images/'): ?>
                <img src="<?php echo $record['cphoto']; ?>" alt="Current Costume Photo" style="max-width: 200px;"><br>
            <?php endif; ?>

            <label for="footwear">Footwear details:</label>
            <textarea id="footwear" name="footwear"
                placeholder="Enter footwear details"><?php echo htmlspecialchars($record['fdetails']); ?></textarea><br>
            <label for="file4">Footwear Photo:</label>
            <input type="file" name="file4"><br>
            <?php if ($record['fphoto'] !== 'Images/'): ?>
                <img src="<?php echo $record['fphoto']; ?>" alt="Current Footwear Photo" style="max-width: 200px;"><br>
            <?php endif; ?>

            <label for="Rules">Rules:</label>
            <textarea id="Rules" name="Rules"
                placeholder="Enter rules"><?php echo htmlspecialchars($record['rules']); ?></textarea><br>
            
            <label for="vname">Video name:</label>
            <textarea type="vname" placeholder="Enter video name" name="vname"><?php echo htmlspecialchars($record['vidname']); ?></textarea>

            <label for="video">Video links:</label>
            <textarea type="text" id="video" name="video"
                placeholder="Enter video link"><?php echo htmlspecialchars($record['vlink']); ?></textarea><br>

            <label for="term">Terminologies used:</label>
            <textarea type="text" id="term" name="term"
                placeholder="Enter Terminologies used"><?php echo htmlspecialchars($record['terms']); ?></textarea><br>

            <label for="types">Other related types:</label>
            <textarea type="text" id="types" name="types"
                placeholder="Enter other related types"><?php echo htmlspecialchars($record['types']); ?></textarea><br>

            <label for="list">Celebrity players:</label>
            <textarea type="text" id="list" name="list"
                placeholder="Enter Celebrity players list"><?php echo htmlspecialchars($record['playerlist']); ?></textarea><br>

            <label for="file5">Artifact Photo:</label>
            <input type="file" name="file5"><br>
            <?php if ($record['artiphoto'] !== 'Images/'): ?>
                <img src="<?php echo $record['artiphoto']; ?>" alt="Current Additional Photo" style="max-width: 200px;"><br>
            <?php endif; ?>
            <label for="art">Artifact detail:</label>
            <textarea type="text" placeholder="Enter Artifact detail"
                name="art"><?php echo htmlspecialchars($record['artinfo']); ?></textarea><br>
            <input type="submit" name="submit" value="Save Changes">
        </form>
    </div>

</body>

</html>