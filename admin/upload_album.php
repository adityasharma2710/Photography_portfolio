<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: ./login.php");
} ?>

<?php require "./db.php"; ?>

<?php include('header.php'); ?>
<?php $active_sidenav_tab = "Upload Album"; ?>
<?php include('sidenav.php'); ?>
   
<div class="main">
    <h1>Upload Album Here</h1>
    <div class="uploadSection">
        <form action="album_images.php" method="post" enctype="multipart/form-data">
            <input type="text" name="album_name" placeholder="Album Name">
            <input type="submit" name="album_submit" value="Create Album">
        </form>
    </div>
    <div class="editSection">
        <h2>Edit Albums</h2>
        <hr>
        <div class="editAlbumRowContainer">
        <?php
            $db->select('albums',false ,false, 'id DESC');
            foreach($db->result_array() as $db_row) {
                $album_id = $db_row['id']; 
                $album_name = $db_row['album_name']; 
        ?>
            <div class="editAlbumRow">
                <div class="albumName">
                    <?php echo $album_name; ?>
                </div>
                <div class="actionButtons">
                    <form action="album_images.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="album_name" value="<?php echo $album_name; ?>">
                        <input class="btnn-update" type="submit" name="album_submit" value="Edit">
                    </form>
                    
                    <button class="btnn-delete">
                        Delete
                    </button>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</div>

<!-- To Prevent Data Submission on Refresh -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    
<?php include('footer.php'); ?>
