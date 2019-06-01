<?php
    echo "upload your album here";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Album</title>
</head>
<body>
    <h1>Upload Album Here</h1>
    <form action="album_images.php" method="post" enctype="multipart/form-data">
        <input type="text" name="album_name" placeholder="Album Name">
        <input type="submit" name="album_submit" value="Create Album">
    </form>
    
    <!-- To Prevent Data Submission on Refresh -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>