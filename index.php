<?php
    require "./db.php";  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISKCON MONK</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="Vendors/css/lightgallery.min.css">
    <link rel="stylesheet" href="Vendors/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #2d2d2d;
            margin: 0;
            padding: 0;
        }
        
        nav {
            background: #fff;
            position: fixed;
            width: 100%;
            z-index: 10;
            top: 0;
            padding: 5px 0;
        }
        .nav {
            width: 80%;
            margin: 0 auto;
            
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .nav > ul {
            display: flex;
            justify-content: flex-end;
            
            flex-basis: 40%;
        }
        .nav > ul > li {
            list-style: none;
            margin-left: 30px;
            font-size: 18px;
        }
        .nav > ul > li > a {
            text-decoration: none;
            color: #444;
            padding: 15px 0;
            position: relative;
        }
        .nav > .logo {
            text-align: center;
            
            flex-basis: 20%;
        }
        
        .logo > img {
            width: 200px;
            height: auto;
        }
        
        .logo > h3 {
            margin: 0;
            font-size: 12px;
        }
        
        .nav > .nav-social {
            flex-basis: 40%;
        }
        
        .nav-social a {
            margin-right: 30px;
            text-decoration: none;
            color: #444;
        }
        
        .nav > ul > li > a:after {    
          background: none repeat scroll 0 0 transparent;
          bottom: 0;
          content: "";
          display: block;
          height: 2px;
          left: 50%;
          position: absolute;
          background: #000;
          transition: width 0.3s ease 0s, left 0.3s ease 0s;
          width: 0;
        }
        
        .nav > ul > li > a:hover:after { 
          width: 100%; 
          left: 0; 
        }
        
        .nav .fab {
            font-size: 30px;            
        }
        
        .fa-facebook:hover {
            color: #3b5998;
        }
        
        .fa-instagram:hover {
            color: #3f729b;
        }
        
        .images-section {
            width: 80%;
            margin: 0 auto;
            margin-top: 85px;
            margin-bottom: 20px;
        }
        .img-wrapper {
          display: flex;
          flex-wrap: wrap;
            
          visibility: hidden;
        }
        
        .img-a {
            background-color: #000;
            box-shadow: 0 0 100px black;
        }

        .img-a > img {
          display: block;
          width: 100%;
            
          border: 1px solid #4e4e4e;
          border-radius: 3px;
          box-shadow: 0px 0px 2px #b3b3b3;   
            
          opacity: 0.6;   
        }
        
        .img-a > img:hover {
            opacity: 1;
            transition: .5s;
            z-index: 5;
            box-shadow: none;
            position: relative;
            /*transform: scale(1.05);*/
            box-shadow: 0 0 20px #6b6b6b;
        }

        /* CSS to maintain the height of last row */

        .img-wrapper::after {
          flex-basis: 18rem;
        }

        .img-wrapper::after {
          content: '';
          flex-grow: 1000000;
        }
        
        footer {
            background-color: #fff;
            padding: 15px;
            
            display: flex;
            justify-content: center;
        }
        
        footer > p {
            margin: 0;
        }
    </style>
</head>
<body>
   
   <nav>
      <div class="nav">
          <div class="nav-social">
              <a href="#">
                  <i class="fab fa-facebook"></i>
              </a>
              <a href="#">
                  <i class="fab fa-instagram"></i>
              </a>
          </div>
          <div class="logo">
               <img src="Resources/img/logo.png" alt="">
               <h3>ISKCON MONK</h3>
          </div>
       <ul>
           <li><a href="#">Photostream</a></li>
           <li><a href="#">Album</a></li>
           <li><a href="#">About</a></li>
           <li><a href="#">Contact</a></li>
       </ul>
      </div>
   </nav>
    <section class="images-section">
       <div class="img-wrapper" id="lightgallery">
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
        </div>
    </section>
    
    <footer>
        <p>&#169; Copyright-2019 ISKCON Monk</p>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        //$(document).ready(function(){
        $(window).on('load', function () {
            $(".img-wrapper").css("visibility","visible");
            $(".img-a").each(function(i){

                var imgW = $(this).children().width();
                var imgH = $(this).children().height();

                var ratio = imgW/imgH;

                // Set Row Height Here
                var rowHeight = 15; // changeable value in rem

                // Set Margin between images Here
                var imgMargin = .25; // changeable value in rem

                $(this).css("flex-basis", (ratio * rowHeight) + 'rem');
                $(this).css("flex-grow", (ratio * 100));
                $(this).css("margin", imgMargin + "rem");
            });

        });
    </script>
    
    <script src="Vendors/js/js-migerate.js"></script>
    <script src="Vendors/js/js-migerate2.js"></script>
    <script src="Vendors/js/lightgallery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightgallery").lightGallery(); 
        });
    </script>
    
</body>
</html>