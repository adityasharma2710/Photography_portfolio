<?php
    require "./Vendor/php/class.upload.php";

    $handle = new upload($_FILES['image_field']);
    //print_r($_FILES['image_field']);
    echo pathinfo($_FILES['image_field']['name'],PATHINFO_FILENAME);
$handle->file_max_size = '150032768';  
echo $handle->log;
    if ($handle->uploaded) {
      $handle->file_max_size = '150032768'; 
      $handle->file_new_name_body   = pathinfo($_FILES['image_field']['name'],PATHINFO_FILENAME);
      $handle->image_resize         = true;
      $handle->image_x              = 100;
      $handle->image_ratio_y        = true;
      $handle->process('./files/');
      //$handle->process('/home/user/files/');
      if ($handle->processed) {
        echo 'image resized';
        $handle->clean();
      } else {
        echo 'error : ' . $handle->error;
      }
    } else {
        echo "123";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Images</title>
</head>
<body>
    <h1>Upload Images</h1>
    <form enctype="multipart/form-data" method="post" action="upload_images.php">
      <input type="file" size="32" name="image_field" value="">
      <input type="submit" name="Submit" value="upload">
    </form>
    
    <!-- To Prevent Data Submission on Refresh -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>