<?php
$page = basename(__FILE__, '.php');
include 'header.php';
?>
   <header id="header">
      <div class="header--container">
         <h1><?php
               $header_text = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['header_text'];
               $header_text_arr = explode("; ", $header_text, substr_count($header_text, ';')+1);
               for($i=0;$i<=substr_count($header_text, ';');$i++) {
                  echo $header_text_arr[$i]."<br>";
                  echo $header_text_arr[$i+1];
                  echo "<span>".$header_text_arr[$i+2]."</span>";
                  break;
               }
            ?></h1>
      </div>
      <svg fill="#f2f2f2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="50" viewBox="0 0 100 100" preserveAspectRatio="none">
         <path d="M0 0 L50 100 L100 0 L100 100 L0 101 Z"></path>
      </svg>
   </header>
   <section id="home-top">
      <div class="container--section">
         <?php
            $q = mysqli_query($connect, "SELECT * FROM `index.php`");
            while($r = mysqli_fetch_assoc($q)) {
               for($i=1;$i<=3;$i++) {
                  echo "
                  <div class='box box__desc'>
                     <div class='box__title'>
                        <i class='fas "; echo $r["box".$i."_icon"]; echo"'></i>
                     </div>
                     <div class='box__content''>
                        <h4>"; echo $r["box".$i."_title"]; echo"</h4>
                        <p>";
                        if(empty($r["box".$i."_b"])) {
                           $box_content = explode(";", $r["box".$i."_content"]);
                        } else {
                           $box_content = explode($r["box".$i."_b"], $r["box".$i."_content"]);
                        }
                        echo $box_content[0];
                        if(!empty($r["box".$i."_b"])) {
                           echo "<span>".$r["box".$i."_b"]."</span>";
                           echo $box_content[1];
                        }
                        echo"</p>
                     </div>
                  </div>";
               }
            }
         ?>
      </div>
   </section>
   <section id="highlight" class="highlight--section">
      <div class="container--section highlight--container">
        <?php
            $q = mysqli_query($connect, "SELECT * FROM `index.php`");
            while($r = mysqli_fetch_assoc($q)) {
               for($i=1;$i<=4;$i++) {
                  echo "
                  <div class='box box__highlight'>
                     <h1 class='count'>";echo $r["highlight".$i."_num"]; echo"</h1>
                     <p>";echo $r["highlight".$i."_text"]; echo"</p>
                  </div>";
               }
            }
         ?>
      </div>
   </section>
   <section id="boosters" class="boosters--section">
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
                           <img src='img/divisions/";
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
                              $folder = opendir('img/mastery');
                              while($file = readdir($folder)) {
                                 if ($file<>'.' && $file<>'..' && !is_dir('img/mastery'.$file)) {$num_of_ele++;}
                              }
                              closedir($folder);

                              $main_champs = [];
                              $champions = ["Aatrox", "Ahri", "Akali", "Alistar", "Amumu", "Anivia", "Annie", "Ashe", "AurelionSol", "Azir", "Bard", "Blitzcrank", "Brand", "Braum", "Caitlyn", "Camile", "Cassiopeia", "Chogath", "Corki", "Darius", "Diana", "Draven", "DrMundo", "Ekko", "Elise", "Evelynn", "Ezreal", "Fiddlestick", "Fiora", "Fizz", "Galio", "Gangplank", "Garen", "Gnar", "Gragas", "Graves", "Hecarim", "Heimerdinger", "Illaoi", "Irelia", "Ivern", "Janna", "JarvanIV", "Jax", "Jayce", "Jhin", "Kalista", "Karma", "Karthus", "Kassadin", "Katarina", "Kayle", "Kennen", "Khazix", "Kindred", "Kled", "Kogmaw", "Leblanc", "LeeSin", "Leona", "Lissandra", "Lucian", "Lulu", "Lux", "Malphite", "Malzahar", "Maokai", "MasterYi", "MissFortune", "Mordekaiser", "Morgana", "Nami", "Nasus", "Nautilus", "Nidalee", "Nocturne", "Nunu", "Olaf", "Orianna", "Ornn", "Pantheon", "Poppy", "Quinn", "Rakan", "Rammus", "RekSai", "Renekton", "Rengar", "Riven", "Rumble", "Ryze", "Sejuani", "Shaco", "Shen", "Shyvana", "Singed", "Sion", "Sivir", "Skarner", "Sona", "Soraka", "Swain", "Syndra", "TahmKench", "Taliyah", "Talon", "Taric", "Teemo", "Thresh", "Tristana", "Trundle", "Tryndamere", "TwistedFate", "Twitch", "Udyr", "Urgot", "Varus", "Vayne", "Veigar", "Velkos", "Vi", "Viktor", "Vladimir", "Volibear", "Warwick", "Wukong", "Xayah", "Xerath", "XinZhao", "Yasuo", "Yorick", "Zac", "Zed", "Ziggs", "Zilean", "Zoe", "Zyra"];
                              for($i=0;$i<$num_of_ele;$i++) {
                                 if (strpos($r['main_champions'], $champions[$i]) !== false) {array_push($main_champs, $champions[$i]);}
                               }
                              for($j=0;$j<5;$j++) {
                                 echo "<img class='coach_main_champ' src='img/mastery/"; echo $main_champs[$j]; echo".png' alt='champion'>";
                              }
                           echo "</div>
                        </div>
                     </div>
                     <form class='coach--sumbit' method='get' action='coaching/coaches.php'>
                        <a href='coaching/coaches.php?coach$r[ID]'>
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
   <section id="parallax">
      <div class="container--section">
         <div id="owl-demo" class="owl-carousel owl-theme">
            <?php
               $q = mysqli_query($connect, "SELECT * FROM `index.php`");
               while($r = mysqli_fetch_assoc($q)) {
                  $logo_text = $r["owl_item"];
                  $logo_text_arr = explode(";", $logo_text, substr_count($logo_text, ';')+1);
                  for($i=0;$i<=substr_count($logo_text, ';');$i=$i+2) {
                     echo "<div class='item'><p>".$logo_text_arr[$i]."</p><span>".$logo_text_arr[$i+1]."</span></div>";
                  }
               }
            ?>
         </div>
      </div>
   </section>
   <section id="contact">
      <div class="container--section">
         <h1 class="contact__title"><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['contact_text']; ?></h1>
         <form name="sentMessage" id="contact--form">
            <div class="form__group">
               <input id="question" type="text" placeholder="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['q1_contact']; ?>" required>
            </div>
            <div class="form__group">
               <input id="email" type="email" placeholder="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['q2_contact']; ?>" required>
            </div>
            <div class="form__group">
               <textarea id="message" rows="5" placeholder="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['q3_contact']; ?>" required></textarea>
            </div>
            <button type="submit" class="btn btn-lg" id="sendMessageButton"><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `index.php`"))['submit_contact']; ?></button>
         </form>
      </div>
   </section>
   <?php include 'footer.php';?>
