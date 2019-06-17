<?php 
    $active_img_tab = "";
    $active_alb_tab = "";
    if( $active_sidenav_tab === "Upload Images" ) {
        $active_img_tab = "active-sidenav-tab";
    } elseif( $active_sidenav_tab === "Upload Album" ) {
        $active_alb_tab = "active-sidenav-tab";
    }

?>
   

<div class="btnn-sidenav sidenav">
    <a class="btnn-sidenav-tab" href="../" target="_blank">Visit Site</a>
    <a class="btnn-sidenav-tab <?php echo $active_img_tab; ?>" href="upload_images.php">Upload Images</a>
    <a class="btnn-sidenav-tab <?php echo $active_alb_tab; ?>" href="upload_album.php">Upload Album</a>
</div>