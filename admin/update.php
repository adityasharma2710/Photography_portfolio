<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: ./login.php");
} ?>


<?php
    
    require "./db.php";

    if(isset($_POST['file_id'])) {
        $file_id = $_POST['file_id'];
        $imgAlbumInc = $_POST['imgAlbumInc'.$file_id];
        $ser_imgAlbumInc = base64_encode(serialize($imgAlbumInc));
        $file_back_url = $_POST['file_back_url'];
        
        if($imgAlbumInc) {
            //echo "Album change";
            $db->update(
                'images', [
                    // fields to be updated
                    'album_id' => $ser_imgAlbumInc
                ], [
                    // 'WHERE' clause
                    'id' => $file_id
                ]
            );
            
            header("location: ./".$file_back_url);
        } 
    }
?>