<?php include '../header.php';?>

   <header id="header" class="subpage_header"></header>
   <section>
      <div class="container--section coaches">
         <div class="coach--profile">
            <div class="coach__title">
               <i class="fas fa-user"></i>
               <span>Coach</span>
            </div>
               <?php
                  $c = @mysqli_connect('localhost', 'root', '', 'eloboost');
                  $c->set_charset("utf8");
                  $q = mysqli_query($c, "SELECT * FROM `coaches`");

                  $coach = 0; // id
                  for($a=1;$a<6;$a++) {
                     if(isset($_GET['coach'.$a])) {
                        $coach = $a; // id
                     }
                     elseif ($coach == 0) {
                        $coach = 1; // id
                     }
                     $div = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['division']; // division
                  }
                  $price = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['price']; // price for js

                  /***** division img *****/
                  for($division_num = 1;$division_num<6;$division_num++) {
                     if($division_num == 1) {$div_num = "I";} 
                     else if($division_num == 2) {$div_num = "II";}
                     else if($division_num == 3) {$div_num = "III";}
                     else if($division_num == 4) {$div_num = "IV";}
                     else if($division_num == 5) {$div_num = "V";}
                     if($div == ("Diamond ".$div_num)) {
                        $div_img = "Diamond_".$div_num;
                        break;
                     } else {$div_img = $div;}
                  }

                  $division = '../img/divisions'; // src
                  $folder = opendir($division);
                  $j = 0;
                  while(false !=($file = readdir($folder))){
                     if($file != "." && $file != ".."){
                        $pictures[$j] = $file;
                        $j++;
                     }
                  }
                  /***** /division img *****/
            
                  // thumbnail/avatar img
                  $thumbnail = '../img/thumbnails'; //src 
                  $folder = opendir($thumbnail);
                  $j = 0;
                  while(false !=($file = readdir($folder))){
                     if($file != "." && $file != ".."){
                        $pictures[$j] = $file;
                        $j++;
                     }
                  }
               ?>
            <p class="coach__nickname"><?php echo mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['nickname']; ?></p>
               <?php echo '<img class="thumbnail" src="'.$thumbnail.'/'.$pictures[$coach-1].'" alt="user_thumbnail">' ?>
            <hr />
            <p class="coach__heading">Division</p>
               <?php echo '<img class="coach__division" src="'.$division.'/'.$div_img.'.png" alt="division">' ?>
            <p class="coach__div">
               <?php echo $div; ?>
            </p>
            <hr />
            <p class="coach__heading">Roles</p>
            <p class="coach__roles">
               <?php 
                  echo mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['roles'];
               ?>
            </p>
            <hr />
            <p class="coach__heading">Languages</p>
            <div class="flags">
               <?php
                  $languages = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['languages'];
                  $flag = [];
                  $j = 0; // id of flag
                  $e = 0; //
                  if(strlen($languages) > 2) {
                     for($i=0;$i<(strlen($languages)/3);$i++) {
                        $flag[$j] = $languages[$e].$languages[$e+1];
                        echo '<img class="flag" src="../img/flags/'.$flag[$j].'.jpg" alt="pl_flag">';
                        $e=$e+4;
                        $j++;
                     }
                  } else {
                     echo '<img class="flag" src="../img/flags/'.$languages.'.jpg" alt="pl_flag">';
                  }
               ?>
            </div>
         </div>
         <div class="coach--about">
            <div class="coach__title">
               <i class="far fa-chart-bar"></i>
               <span>About</span>
            </div>
            <div class="coach__about__content">
               <?php
                  echo mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['about'];
               ?>
            </div>
        </div>
      </div>
      <div class="container--section coaches purchase">
         <div class="coach--purchase">
            <div class="coach__title">
               <i class="fas fa-shopping-cart"></i>
               <span>Purchase</span>
            </div>
            <form action="#" method="POST">
               <input id="slider-range" type="range" min="1" max="10" value="0" onchange="count()">
               <p>
                  <span id="hours">Hour: </span>
                  <span id="cenah"> 1</span>
                  Purchase: <span id="cenaz">
                     <?php
                        echo mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `coaches` WHERE ID='$coach'"))['price']."€";
                     ?>
                  </span>
               </p>
               <input type="button" class="btn purchase_btn" value="Buy">
            </form> 
         </div>
      </div>
   </section>
   <?php mysqli_close($c); ?>
   <?php include '../footer_subpage.php';?>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script>
   function count() {
      var coach_id = "<?php Print($coach); ?>";
      var price = <?php echo $price ?>;

      var slider_range = document.getElementById("slider-range").value;
      if(slider_range>1) {document.getElementById("hours").innerHTML = "Hours: ";}
      else if(slider_range==1) {document.getElementById("hours").innerHTML = "Hour: ";}
      document.getElementById("cenah").innerHTML = slider_range;
      document.getElementById("cenaz").innerHTML = slider_range*price + "€";
   }
</script>
<script src="../js/scroll-top.js"></script>
</body>
</html>