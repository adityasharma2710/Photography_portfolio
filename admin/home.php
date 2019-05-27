<?php
    echo "welcome to home";
?>
<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){ ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <a href="upload_images.php">Upload Images</a>
    <a href="upload_album.php">Upload Album</a>
    
    <a href="logout.php">Logout</a>
    
</body>
</html>    
    

<?php } else {
    header("location: ./login.php");
} ?>

<?php //session_destroy(); ?>