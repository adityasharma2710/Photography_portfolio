<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: ./login.php");
} ?>


<?php

    if(isset($_POST['file_id'])) {
        echo $_POST['file_id'];
    }

?>