<?php include_once('header.php'); ?>

<section class="album-section">
    <?php
            $db->select('images',false ,false, 'id DESC');
            foreach($db->result_array() as $db_row)
            {
                $img_url = str_replace(' ', '', "./files/".$db_row['img_url']); 
                $img_url_thumb_large = str_replace(' ', '', "./files/thumb_large/thumb_large_".$db_row['img_url']); 
                $img_url_thumb_small = str_replace(' ', '', "./files/thumb_small/thumb_small_".$db_row['img_url']); 
                
        ?>
        <a class="img-a" href="<?php echo $img_url; ?>" >
            <img src="<?php echo $img_url_thumb_small; ?>">
        </a>
        <?php
            }
        ?>
</section>

<?php include_once('footer.php'); ?>