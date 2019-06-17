<?php include_once('header.php'); ?>

<section class="album-section">
    <?php
        $db->select('albums',false ,false, 'id DESC');
        foreach($db->result_array() as $db_row)
        {
            $album_name = $db_row['album_name']; 
    ?>
        
        <p class="album-name">
            <a class="" href="" >
                <?php echo $album_name; ?>
            </a>
        </p>
        
    <?php
        }
    ?>
</section>

<?php include_once('footer.php'); ?>