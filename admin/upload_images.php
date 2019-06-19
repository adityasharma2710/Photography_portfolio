<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])){
    header("location: ./login.php");
} ?>
    

<?php

    // https://github.com/tschoffelen/db.php
    // https://www.verot.net/php_class_upload_samples.htm

    require "./db.php";
    require "./Vendor/php/class.upload.php";
    //echo date("d-m-Y H:i:s");
    if(isset($_POST['submit'])){
        // Image Count
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
              $handle->process('../files/raw/');
                
              /////////////////////////////     
              // Resized Image - Large    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              //$handle->file_name_body_add = '_resized';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 1920;
              $handle->image_x              = 1920;
                
              // Compression of image 
                
              //https://stackoverflow.com/questions/415801/allowed-memory-size-of-33554432-bytes-exhausted-tried-to-allocate-43148176-byte
              // It will take unlimited memory usage of server     
              ini_set('memory_limit', '-1');
                
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 80;  
                  
              // Uploading Path    
              $handle->process('../files/');
                
                
              /////////////////////////////     
              // Resized Image - Thumb Large    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_name_body_pre = 'thumb_large_';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 800;
              $handle->image_x              = 800;
                
              // Compression of image
              ini_set('memory_limit', '-1');    
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 95;  
                  
              // Uploading Path    
              $handle->process('../files/thumb_large');
                
              /////////////////////////////     
              // Resized Image - Thumb Small    
              /////////////////////////////
                
              // File Naming      
              $handle->file_new_name_body   = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_FILENAME );
              $handle->file_name_body_pre = 'thumb_small_';
              $handle->file_new_name_ext    = pathinfo($_FILES['image_fields']['name'][$i], PATHINFO_EXTENSION);
                
              // Resizing of image    
              $handle->image_resize         = true;
              $handle->image_ratio          = true;
              $handle->image_y              = 400;
              $handle->image_x              = 400;
                
              // Compression of image 
              ini_set('memory_limit', '-1');    
              $handle->image_convert = 'jpg';
              $handle->jpeg_quality = 100;  
                  
              // Uploading Path    
              $handle->process('../files/thumb_small');    
              
              // To increase the excecution time    
              ini_set('max_execution_time', 300);
                
              if ($handle->processed) {
                $date = date("Y-m-d H:i:s");
                $img_url_raw = "files/raw/" . $_FILES['image_fields']['name'][$i];  
                $img_url = $_FILES['image_fields']['name'][$i];  
                $db->insert(
                    'images', [
                        'img_url_raw' => $img_url_raw,
                        'img_url' => $img_url,
                        'date' => $date
                    ]
                );  
                  
                echo 'Uploading Succesfull !!!';
                $handle->clean();
              } else {
                echo 'error : ' . $handle->error;
              }
            } else {
                echo "Not Uploaded !!!";
            }
        }
    }
    
?>

<?php include('header.php'); ?>
<?php $active_sidenav_tab = "Upload Images"; ?>
<?php include('sidenav.php'); ?>
   
<div class="main">   
    <h1>Upload Images</h1>
    <div class="uploadSection">
        <form enctype="multipart/form-data" method="post" action="upload_images.php">
          <input type="file" size="32" name="image_fields[]" value="" multiple>
          <input type="submit" name="submit" value="upload">
        </form>
    </div>
    
    <div class="editSection">
            <h2>Edit Images</h2>
            <hr>
            <div class="editImgRowContainer">
            <?php
                $db->select('images', false, false, 'id DESC');
                foreach($db->result_array() as $db_row)
                {
                    
                    $img_ID = $db_row['id'];
                    $imgAlbum_ID = $db_row['album_id'];
                    $img_url = str_replace(' ', '-', "../files/".$db_row['img_url']); 
                    $img_url_thumb_large = str_replace(' ', '-', "../files/thumb_large/thumb_large_".$db_row['img_url']); 
                    $img_url_thumb_small = str_replace(' ', '-', "../files/thumb_small/thumb_small_".$db_row['img_url']); 

            ?>
                <div class="editImgRow">
                    <!--<a class="editImgLink" href="<?php //echo $img_url; ?>" >-->
                    <img class="editRowImg" src="<?php echo $img_url_thumb_small; ?>">
                    <!--</a>-->
                    <hr>
                    
                    
                    <!-- Update Album -->
                    <form>
                        <div class="multiselect">

                            <div class="selectBox" id="selectBox<?php echo $img_ID; ?>" pointID="<?php echo $img_ID; ?>" onclick="showCheckboxes('<?php echo $img_ID; ?>')">
                                <p class="selectDropdown"><span id="chkb_v<?php echo $img_ID; ?>">Select Album</span> &#9662;</p>
                            </div>
                            
                            <div class="checkboxes" id="checkBox<?php echo $img_ID; ?>" onclick="checkbox_update('<?php echo $img_ID; ?>')">
                               
                                <?php 
                                    $db->select('albums', false, false, 'id DESC');
                                    foreach($db->result_array() as $db_row) {
                                        $album_ID = $db_row['id'];
                                        $album_name = $db_row['album_name'];
                                        $checked = "";
                                        if($imgAlbum_ID === $album_ID){
                                            $checked = "checked";
                                        }
                                ?>
                                        <label for="<?php echo $album_ID.'_'.$img_ID; ?>">
                                        <input type="checkbox" id="<?php echo $album_ID.'_'.$img_ID; ?>" name="chkb<?php echo $img_ID; ?>" value="<?php echo $album_ID; ?>" <?php echo $checked ?>/><?php echo $album_name; ?></label>
                                <?php        
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Delete File -->
                    <form action="delete.php" method="post" enctype="multipart/form-data" id="form_del_<?php echo $img_ID; ?>">
                        <input type="hidden" name="file_id" value="<?php echo $img_ID; ?>">
                        <input type="hidden" name="file_type" value="images">
                        <input type="hidden" name="file_back_url" value="upload_images.php">
                        <input class="btnn-delete" type="submit" name="delete_submit" value="Delete">
                    </form>
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
   
<script>
    var elementToDel = document.getElementsByClassName("btnn-delete");
    
    for (i = 0; i < elementToDel.length; i++) {
        elementToDel[i].addEventListener("click", function(event){
            event.preventDefault();
            var del_cnf = confirm("Confirm DELETE");
            
            if(del_cnf){
                var formToSubmit = this.parentElement.getAttribute("id");
                document.getElementById(formToSubmit).submit();
            }
        });
    }

</script>
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

    function showCheckboxes(pointID) {
        var checkboxes = document.getElementById("checkBox"+pointID);
        if (checkboxes.style.display === "block") {
            checkboxes.style.display = "none";
        } else {
            checkboxes.style.display = "block";
        }
        checkbox_update(pointID);
    }

    function checkbox_update(pointID) {
        console.log("chk"+pointID);
        var yourArray = [];
        $("input:checkbox[name='chkb"+pointID+"']:checked").each(function(){
            yourArray.push($(this).val());
        });
        console.log(yourArray.length);
        $("#chkb_v"+pointID).html( yourArray.length + " Selected");
    }

    $(document).ready(function(){
        //checkbox_update();
    });

//    window.addEventListener('click', function(e){
//
//        var selectBox = document.getElementsByClassName('selectBox');
//        var checkboxes = document.getElementsByClassName('checkboxes');
//        
//        for(i=0; i<selectBox.length; i++){
//            var pointID = 0;
//
//            if (selectBox[i].contains(e.target)){
//                
//                pointID = selectBox[i].getAttribute("pointID");
//
//                console.log(pointID);
//                // Clicked in box
//                showCheckboxes(i, pointID);
//            } else {
//                // Clicked outside the box
//                checkboxes[i].style.display = "none";
//            }
//        }
//        
//    });
        
//    window.addEventListener('click', function(e){
//        var checkboxes = document.getElementsByClassName('checkboxes');
//        for(i=0; i<checkboxes.length; i++){
//            if(checkboxes[i].contains(e.target)) {
//              checkbox_update();
//                console.log(i);
//            } else {
//                // Clicked outside the box
//                //checkboxes[i].style.display = "none";
//                //checkbox_update();
//            }
//        }
//
//    });

</script>
    
<?php include('footer.php'); ?>