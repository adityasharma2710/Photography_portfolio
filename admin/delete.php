<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: ./login.php");
} ?>


<?php
    
    require "./db.php";
    if(isset($_POST['file_id'])) {
        
        $file_id = $_POST['file_id'];
        $file_type = $_POST['file_type'];
        $file_back_url = $_POST['file_back_url'];
        
        $db->delete(
            $file_type, [
                // 'WHERE' clause
                'id' => $file_id
            ]
        );
        
        if($file_type === 'albums'){
            $db->delete(
                'images', [
                    // 'WHERE' clause
                    'album_id' => $file_id
                ]
            ); 
        }
        
        header("location: ./".$file_back_url);
    }

?>