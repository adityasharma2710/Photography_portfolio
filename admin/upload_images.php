<?php
    require "./Vendor/php/class.upload.php";
    
    if(isset($_POST['submit'])){
        /*$handle = new upload($_FILES['image_field']);
        //print_r($_FILES['image_field']);
        //echo pathinfo($_FILES['image_field']['name'],PATHINFO_FILENAME);
        //echo $handle->log;
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
        }*/
        
        //echo "entered";
        //$images = $_FILES["image_fields"];
        //print_r($images);
        
        $total = count($_FILES['image_fields']['name']);
        
        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {
            $handle = new upload($_FILES['image_fields']['tmp_name'][$i]);
            
            
            if ($handle->uploaded) {
                
              /////////////////////////////     
              // Original Image     
              /////////////////////////////
                
              // File Naming    
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION); 
                  
              // Uploading Path    
              $handle->process('./files/raw/');
                
              /////////////////////////////     
              // Resized Image - Large    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_name_body_add = '_resized';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 1920;
              $handle->image_x              = 1920;
                
              // Compression of image    
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 80;  
                  
              // Uploading Path    
              $handle->process('./files/');
                
                
              /////////////////////////////     
              // Resized Image - Thumb Large    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_name_body_add = '_resized_thumb_large';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 800;
              $handle->image_x              = 800;
                
              // Compression of image    
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 95;  
                  
              // Uploading Path    
              $handle->process('./files/thumb_large');
                
              /////////////////////////////     
              // Resized Image - Thumb Small    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_name_body_add = '_resized_thumb_small';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 400;
              $handle->image_x              = 400;
                
              // Compression of image    
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 100;  
                  
              // Uploading Path    
              $handle->process('./files/thumb_small');    

              if ($handle->processed) {
                echo '<br>image resized';
                $handle->clean();
              } else {
                echo 'error : ' . $handle->error;
              }
            } else {
                echo "not uploaded";
            }
        }
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
      <input type="file" size="32" name="image_fields[]" value="" multiple>
      <input type="submit" name="submit" value="upload">
    </form>
    
    <!-- To Prevent Data Submission on Refresh -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>