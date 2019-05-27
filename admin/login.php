<?php
    require "./db.php";
    session_start();
    if(isset($_SESSION['username'])){
        header("location: ./home.php");
    } else {
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $db->select('users', ['username'=> $username]);

            if($db->row_array()){
                $db_username = $db->row_array()['username'];
                $db_password = $db->row_array()['password'];

                if($username === $db_username && $password === $db_password){
                    echo "logged in !!!";
                    $_SESSION['username'] = $db_username;
                    header("location: ./home.php");
                } else {
                    echo "Please Check Your Username & Password";
                }
            } else {
                echo "user not Exist !!!";
            }
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login Here</h1>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="submit">
    </form>
    
    <!-- To Prevent Data Submission on Refresh -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>