<?php include '../header.php';?>

   <header id="header" class="subpage_header"></header>
   <section>
      <div class="container--section">
        
      <?php
         $q = mysqli_query($connect, "SELECT * FROM `coaches`");
         while($r = mysqli_fetch_assoc($q)) {
            echo "
            <div class='box card'>
               <div class='card__container'>
                  <p class='card-question''>"; echo $r['nickname']; echo"</p>
                  <p>"; echo $r['price']; echo" €/h</p>
                  <div class='card-separator'></div>
                  <div class='c_card'>
                     <div class='c_left''>
                        <p>Roles:</p>
                        <p>"; echo $r['roles']; echo"</p>
                     </div>
                     <div class='c_right tooltip'>
                        <img src='../img/divisions/";
                        if($r['division'] == "Challenger") echo "challenger";
                        else if($r['division'] == "Master") echo "master";
                        else if($r['division'] == "Diamond I") echo "diamond_I"; 
                        else if($r['division'] == "Diamond II") echo "diamond_II"; 
                        else if($r['division'] == "Diamond III") echo "diamond_III"; 
                        else if($r['division'] == "Diamond IV") echo "diamond_IV"; 
                        else if($r['division'] == "Diamond V") echo "diamond_V"; 
                        echo".png' alt='division'>
                        <span class='tooltiptext'>"; echo $r['division']; echo"</span>
                     </div>
                     <div style='clear:both'></div>
                     <div class='c_champs'>
                        <p>Top 5 champions:</p>
                        <div class='c_c_box'>";

                           $num_of_ele = -8; // number of champions in folder, -8 elements, which are mastery ranks image
                           $folder = opendir('../img/mastery');
                           while($file = readdir($folder)) {
                              if ($file<>'.' && $file<>'..' && !is_dir('../img/mastery'.$file)) {$num_of_ele++;}
                           }
                           closedir($folder);

                           $main_champs = [];
                           $champions = ["Aatrox", "Ahri", "Akali", "Alistar", "Amumu", "Anivia", "Annie", "Ashe", "AurelionSol", "Azir", "Bard", "Blitzcrank", "Brand", "Braum", "Caitlyn", "Camile", "Cassiopeia", "Chogath", "Corki", "Darius", "Diana", "Draven", "DrMundo", "Ekko", "Elise", "Evelynn", "Ezreal", "Fiddlestick", "Fiora", "Fizz", "Galio", "Gangplank", "Garen", "Gnar", "Gragas", "Graves", "Hecarim", "Heimerdinger", "Illaoi", "Irelia", "Ivern", "Janna", "JarvanIV", "Jax", "Jayce", "Jhin", "Kalista", "Karma", "Karthus", "Kassadin", "Katarina", "Kayle", "Kennen", "Khazix", "Kindred", "Kled", "Kogmaw", "Leblanc", "LeeSin", "Leona", "Lissandra", "Lucian", "Lulu", "Lux", "Malphite", "Malzahar", "Maokai", "MasterYi", "MissFortune", "Mordekaiser", "Morgana", "Nami", "Nasus", "Nautilus", "Nidalee", "Nocturne", "Nunu", "Olaf", "Orianna", "Ornn", "Pantheon", "Poppy", "Quinn", "Rakan", "Rammus", "RekSai", "Renekton", "Rengar", "Riven", "Rumble", "Ryze", "Sejuani", "Shaco", "Shen", "Shyvana", "Singed", "Sion", "Sivir", "Skarner", "Sona", "Soraka", "Swain", "Syndra", "TahmKench", "Taliyah", "Talon", "Taric", "Teemo", "Thresh", "Tristana", "Trundle", "Tryndamere", "TwistedFate", "Twitch", "Udyr", "Urgot", "Varus", "Vayne", "Veigar", "Velkos", "Vi", "Viktor", "Vladimir", "Volibear", "Warwick", "Wukong", "Xayah", "Xerath", "XinZhao", "Yasuo", "Yorick", "Zac", "Zed", "Ziggs", "Zilean", "Zoe", "Zyra"];
                           for($i=0;$i<$num_of_ele;$i++) {
                              if (strpos($r['main_champions'], $champions[$i]) !== false) {array_push($main_champs, $champions[$i]);}
                            }
                           for($j=0;$j<5;$j++) {
                              echo "<img class='coach_main_champ' src='../img/mastery/"; echo $main_champs[$j]; echo".png' alt='champion'>";
                           }

                        echo "</div>
                     </div>
                  </div>
                  <form class='coach--sumbit' method='get' action='coaching/coaches.php'>
                     <a href='coaches.php?coach$r[ID]'>
                         <span class='text'>View profile</span>
                         <span class='line -right'></span>
                         <span class='line -top''></span>
                         <span class='line -left'></span>
                         <span class='line -bottom'></span>
                     </a>
                  </form>
                  <div class='card-separator'></div>
               </div>
            </div>"; 
         }
      ?>
      </div>
   </section>
   <?php include '../footer_subpage.php';?>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="../js/scroll-top.js"></script>
</body>
</html>