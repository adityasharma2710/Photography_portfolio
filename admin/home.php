
<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){ ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    
    <style>
        nav {
            display: flex;
            justify-content: center;
            
            background-color: darkgray;
            padding: 5px;
        }
        
        .btnn {
            padding: 5px 10px;
            background-color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        
        .btnn-logout {
            
        }
        
        .btnn-uploading {
            text-align: center;    
            display: flex;
            flex-direction: column;
        }
        
        .btnn-img-upload {
            border: 1px solid black;
            align-self: center;
            margin-bottom: 5px;
        }
        
        .echo {
            text-align: center;
        }
        
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
   <nav>
       <a class="btnn btnn-logout" href="logout.php">Logout</a>
   </nav>
   <div class="echo">
       <?php
            echo "welcome to home";
       ?>
   </div>
    
    <h1>Admin Panel</h1>
    
    <div class="btnn-uploading">
        <a class="btnn btnn-img-upload" href="upload_images.php">Upload Images</a>
        <a class="btnn btnn-img-upload" href="upload_album.php">Upload Album</a>
    </div>
    
</body>
</html>    
    

<?php } else {
    header("location: ./login.php");
} ?>

<?php //session_destroy(); ?>