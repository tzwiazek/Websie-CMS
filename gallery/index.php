<?php include '../header.php';?>
   <div class="pop"></div>
   <header id="header" class="subpage_header"></header>
   <section>
      <div class="container--section gallery">
         <?php
            $num_of_ele = 0;
            $folder = opendir('../img/gallery');
            while($file = readdir($folder)) {
               if ($file<>'.' && $file<>'..' && !is_dir('../img/gallery'.$file)) {$num_of_ele++;}
            }
            closedir($folder);

            for($i = 1;$i<$num_of_ele;$i++) {
               echo "<div class='box__gallery'><img src='../img/gallery/$i.png' alt='gallery_img' /></div>";
            }
         ?>
      </div>
   </section>
   <?php include '../footer_subpage.php';?>
<script src="../js/eloboost_gallery.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="../js/scroll-top.js"></script>
</body>
</html>
