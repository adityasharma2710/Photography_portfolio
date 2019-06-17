
<?php session_start(); ?>
<?php 
    if(!isset($_SESSION['username'])){ 
        header("location: ./login.php");
    }
?>
    
<?php include('header.php'); ?>
<?php $active_sidenav_tab = ""; ?>
<?php $active_sidenav_tab = ""; ?>

<?php include('sidenav.php'); ?>
   
<div class="main">
    <h1>Admin Panel</h1>
    <div class="echo">
       <?php
            echo "Welcome to Iskcon Monk";
       ?>
   </div>
</div>
    
<?php include('footer.php'); ?>