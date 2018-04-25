<?php include '../header.php';?>

   <header id="header" class="subpage_header"></header>
   <section>
      <div class="container--section boosting">
         <h1>Boosting</h1>
         <div class="tab--panel">
            <div class="tab--panel__title">
               <?php
                  $tabs_arr = ["division", "perwin", "placement", "mastery"];
                  echo "<ul>";
                  for($i=0;$i<4;$i++) {
                  echo "<li>
                           <label id='$tabs_arr[$i]'"; if($i==0) {echo 'class=active__label';} echo">"; echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['eloboost_tab'.($i+1)]; echo"</label>
                        </li>";
                  }
                  echo "</ul>";
                ?>
            </div>
            <div class="tab__content">
            <!-- elo boosting -->
               <div id="tab__content__division">
                  <form action="../checkout/index.php" name="boosting" method="POST">
                     <div class="division__item">
                        <img id="c_div_img" src="../img/divisions/bronze_ii.png" alt="boosting_image">
                        <label>Current Rank:</label>
                        <select id="c_tier" name="current_tier" onchange="count()">
                           <option value="bronze">Bronze</option>
                           <option value="silver">Silver</option>
                           <option value="gold">Gold</option>
                           <option value="platinum">Platinum</option>
                           <option value="diamond">Diamond</option>
                        </select>
                        <select id="c_lvl" name="current_tier_num" onchange="count()">
                           <option value="5">I</option>
                           <option value="4" selected>II</option>
                           <option value="3">III</option>
                           <option value="2">IV</option>
                           <option value="1">V</option>
                        </select>
                     </div>
                     <div class="division__item">
                        <img id="d_div_img" src="../img/divisions/bronze_i.png">
                        <label>Desired Rank:</label>
                        <select id="d_tier" name="desired_tier" onchange="count()">
                           <option value="bronze">Bronze</option>
                           <option value="silver">Silver</option>
                           <option value="gold">Gold</option>
                           <option value="platinum">Platinum</option>
                           <option value="diamond">Diamond</option>
                           <option value="master">Master</option>
                        </select>
                        <select id="d_lvl" name="desired_tier_num" onchange="count()">
                           <option value="5">I</option>
                           <option value="4">II</option>
                           <option value="3">III</option>
                           <option value="2">IV</option>
                           <option value="1">V</option>
                        </select>
                     </div>
                     <div class="division__order">
                        <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_title']; ?></h1>
                        <div class="division__order__item">
                           <ul>
                              <li id="your_div">Division Boost: Bronze II -> Bronze I</li>
                              <li id="total_cost">Total Cost: 4€</li>
                           </ul>
                        </div>
                        <div class="division__order__item">
                           <p><input type="checkbox" id="duo" name="duo" onchange="count()"> <?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_duo']; ?></p>
                           <input type="submit" name="boosting" class="purchase_btn" value="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_button']; ?>">
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /elo boosting -->
               <!-- perwin -->
               <div id="tab__content__perwin">
                  <form action="../checkout/index.php" name="boosting" method="POST">
                     <div class="division__item">
                        <img id="perwin_div_img" src="../img/divisions/bronze_ii.png" alt="perwin_image">
                        <label>Current Rank:</label>
                        <select id="current_div" name="current_div" onchange="count(1)">
                           <option value="bronze">Bronze</option>
                           <option value="silver">Silver</option>
                           <option value="gold">Gold</option>
                           <option value="platinum">Platinum</option>
                           <option value="diamond">Diamond</option>
                        </select>
                        <select id="per_win_lvl" name="per_win_lvl" onchange="count(1)">
                           <option value="5">I</option>
                           <option value="4">II</option>
                           <option value="3">III</option>
                           <option value="2">IV</option>
                           <option value="1">V</option>
                        </select>
                     </div>
                     <div class="division__item">
                        <div id="matches_perwin">1</div>
                        <label>Number of Games</label>
                        <input id="range_slider_perwin" name="range_slider_perwin" type="range" min="1" max="10" value="1" onchange="count(1)">
                     </div>
                     <div class="division__order">
                        <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_title']; ?></h1>
                        <div class="division__order__item">
                           <ul>
                              <li id="total_cost_perwin">Total Cost: 2€</li>
                           </ul>
                        </div>
                        <div class="division__order__item">
                           <p><input type="checkbox" id="duo_perwin" name="duo_perwin" onchange="count(1)"> <?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_duo']; ?></p>
                           <input type="submit" name="matches" class="purchase_btn" value="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_button']; ?>">
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /perwin -->
               <!-- placement games -->
               <div id="tab__content__placement">
                  <form action="../checkout/index.php" name="boosting" method="POST">
                     <div class="division__item">
                        <img id="p_div_img" src="../img/divisions/bronze_ii.png" alt="placement_games_image">
                        <label>Last Season Rank:</label>
                        <select id="last_season_div" name="last_season_div" onchange="count(2)">
                           <option value="bronze">Bronze</option>
                           <option value="silver">Silver</option>
                           <option value="gold">Gold</option>
                           <option value="platinum">Platinum</option>
                           <option value="diamond">Diamond</option>
                        </select>
                     </div>
                     <div class="division__item">
                        <div id="matches">1</div>
                        <label>Number of Games</label>
                        <input id="placement_range_slider" name="placement_range_slider" type="range" min="1" max="10" value="1" onchange="count(2)">
                     </div>
                     <div class="division__order">
                        <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_title']; ?></h1>
                        <div class="division__order__item">
                           <ul>
                              <li id="total_cost_placement">Total Cost: 2€</li>
                           </ul>
                        </div>
                        <div class="division__order__item">
                           <p><input type="checkbox" id="duo_placement" name="duo_placement" onchange="count(2)"> <?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_duo']; ?></p>
                           <input type="submit" name="placement_matches" class="purchase_btn" value="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_button']; ?>">
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /placement games -->
               <!-- maestry -->
               <div id="tab__content__mastery">
                  <form action="../checkout/index.php" name="boosting" method="POST">
                     <div class="division__item">
                        <div id="champion_mastery_img"></div>
                        <label>Select Your Champion</label>
                        <select id="champion_mastery" name="champion_mastery" onchange="count(3)">
                           <option value="Aatrox">Aatrox</option>
                           <option value="Ahri">Ahri</option>
                           <option value="Akali">Akali</option>
                           <option value="Alistar">Alistar</option>
                           <option value="Amumu">Amumu</option>
                           <option value="Anivia">Anivia</option>
                           <option value="Annie">Annie</option>
                           <option value="Ashe">Ashe</option>
                           <option value="AurelionSol">Aurelion Sol</option>
                           <option value="Azir">Azir</option>
                           <option value="Blitzcrank">Blitzcrank</option>
                           <option value="Brand">Brand</option>
                           <option value="Braum">Braum</option>
                           <option value="Caitlyn">Caitlyn</option>
                           <option value="Camille">Camille</option>
                           <option value="Cassiopeia">Cassiopeia</option>
                           <option value="Chogath">Chogath</option>
                           <option value="Corki">Corki</option>
                           <option value="Darius">Darius</option>
                           <option value="Diana">Diana</option>
                           <option value="Draven">Draven</option>
                           <option value="DrMundo">Dr. Mundo</option>
                           <option value="Ekko">Ekko</option>
                           <option value="Elise">Elise</option>
                           <option value="Evelynn">Evelynn</option>
                           <option value="Ezreal">Ezreal</option>
                           <option value="Fiddlestick">Fiddlestick</option>
                           <option value="Fiora">Fiora</option>
                           <option value="Fizz">Fizz</option>
                           <option value="Galio">Galio</option>
                           <option value="Gangplank">Gangplank</option>
                           <option value="Garen">Garen</option>
                           <option value="Gnar">Gnar</option>
                           <option value="Gragas">Gragas</option>
                           <option value="Graves">Graves</option>
                           <option value="Hecarim">Hecarim</option>
                           <option value="Heimerdinger">Heimerdinger</option>
                           <option value="Illaoi">Illaoi</option>
                           <option value="Irelia">Irelia</option>
                           <option value="Ivern">Ivern</option>
                           <option value="Janna">Janna</option>
                           <option value="JarvanIV">Jarvan IV</option>
                           <option value="Jax">Jax</option>
                           <option value="Jayce">Jayce</option>
                           <option value="Jhin">Jhin</option>
                           <option value="Kalista">Kalista</option>
                           <option value="Karma">Karma</option>
                           <option value="Karthus">Karthus</option>
                           <option value="Kassadin">Kassadin</option>
                           <option value="Katarina">Katarina</option>
                           <option value="Kayle">Kayle</option>
                           <option value="Kennen">Kennen</option>
                           <option value="Khazix">Kha'Zix</option>
                           <option value="Kindred">Kindred</option>
                           <option value="Kled">Kled</option>
                           <option value="KogMaw">Kog'Maw</option>
                           <option value="LeBlanc">LeBlanc</option>
                           <option value="LeeSin">Lee Sin</option>
                           <option value="Leona">Leona</option>
                           <option value="Lissandra">Lissandra</option>
                           <option value="Lucian">Lucian</option>
                           <option value="Lulu">Lulu</option>
                           <option value="Lux">Lux</option>
                           <option value="Malphite">Malphite</option>
                           <option value="Malzahar">Malzahar</option>
                           <option value="Maokai">Maokai</option>
                           <option value="MasterYi">Master Yi</option>
                           <option value="MissFortune">Miss Fortune</option>
                           <option value="Wukong">Wukong</option>
                           <option value="Mordekaiser">Mordekaiser</option>
                           <option value="Morgana">Morgana</option>
                           <option value="Nami">Nami</option>
                           <option value="Nasus">Nasus</option>
                           <option value="Nautilus">Nautilus</option>
                           <option value="Nidalee">Nidalee</option>
                           <option value="Nocturne">Nocturne</option>
                           <option value="Nunu">Nunu</option>
                           <option value="Olaf">Olaf</option>
                           <option value="Orianna">Orianna</option>
                           <option value="Ornn">Ornn</option>
                           <option value="Pantheon">Pantheon</option>
                           <option value="Poppy">Poppy</option>
                           <option value="Quinn">Quinn</option>
                           <option value="Rakan">Rakan</option>
                           <option value="Rammus">Rammus</option>
                           <option value="RekSai">Rek'Sai</option>
                           <option value="Renekton">Renekton</option>
                           <option value="Rengar">Rengar</option>
                           <option value="Riven">Riven</option>
                           <option value="Rumble">Rumble</option>
                           <option value="Ryze">Ryze</option>
                           <option value="Sejuani">Sejuani</option>
                           <option value="Shaco">Shaco</option>
                           <option value="Shen">Shen</option>
                           <option value="Shyvana">Shyvana</option>
                           <option value="Singed">Singed</option>
                           <option value="Sion">Sion</option>
                           <option value="Sivir">Sivir</option>
                           <option value="Skarner">Skarner</option>
                           <option value="Sona">Soraka</option>
                           <option value="Swain">Swain</option>
                           <option value="Syndra">Syndra</option>
                           <option value="TahmKench">Tahm Kench</option>
                           <option value="Taliyah">Taliyah</option>
                           <option value="Talon">Talon</option>
                           <option value="Taric">Taric</option>
                           <option value="Teemo">Teemo</option>
                           <option value="Thresh">Thresh</option>
                           <option value="Tristana">Tristana</option>
                           <option value="Trundle">Trundle</option>
                           <option value="Tryndamere">Tryndamere</option>
                           <option value="TwistedFate">Twisted Fate</option>
                           <option value="Twitch">Twitch</option>
                           <option value="Udyr">Udyr</option>
                           <option value="Urgot">Urgot</option>
                           <option value="Varus">Varus</option>
                           <option value="Vayne">Vayne</option>
                           <option value="Veigar">Veigar</option>
                           <option value="VelKoz">Vel'Koz</option>
                           <option value="Viktor">Viktor</option>
                           <option value="Vladimir">Vladimir</option>
                           <option value="Volibear">Volibear</option>
                           <option value="Warwick">Warwick</option>
                           <option value="Xayah">Xayah</option>
                           <option value="Xerath">Xerath</option>
                           <option value="XinZhao">Xin Zhao</option>
                           <option value="Yasuo">Yasuo</option>
                           <option value="Yorick">Yorick</option>
                           <option value="Zac">Zac</option>
                           <option value="Zed">Zed</option>
                           <option value="Ziggs">Ziggs</option>
                           <option value="Zilean">Zilean</option>
                           <option value="Zoe">Zoe</option>
                           <option value="Zyra">Zyra</option>
                        </select>
                     </div>
                     <div class="division__item">
                        <div id="current_mastery_lvl"></div>
                        <select id="current_champion_mastery" name="current_champion_mastery" onchange="count(3)">
                           <option value="0">Tier 0</option>
                           <option value="1">Tier 1</option>
                           <option value="2" selected>Tier 2</option>
                           <option value="3">Tier 3</option>
                           <option value="4">Tier 4</option>
                           <option value="5">Tier 5</option>
                           <option value="6">Tier 6</option>
                        </select>
                        <div id="desired_mastery_lvl"></div>
                        <select id="desired_champion_mastery" name="desired_champion_mastery" onchange="count(3)">
                           <option value="1">Tier 1</option>
                           <option value="2">Tier 2</option>
                           <option value="3" selected>Tier 3</option>
                           <option value="4">Tier 4</option>
                           <option value="5">Tier 5</option>
                           <option value="6">Tier 6</option>
                           <option value="7">Tier 7</option>
                        </select>
                     </div>
                     <div class="division__order">
                        <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_title']; ?></h1>
                        <div class="division__order__item">
                           <ul>
                              <li id="total_cost_mastery">Total Cost: 2€</li>
                           </ul>
                        </div>
                        <div class="division__order__item">
                           <p><input type="checkbox" id="duo_mastery" name="duo_mastery" onchange="count(3)"> <?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_duo']; ?></p>
                           <input type="submit" name="mastery" class="purchase_btn" value="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['order_button']; ?>">
                        </div>
                     </div>
                  </form>
               </div>
               <!-- /maestry -->
               <div class="boosting--rules">
                  <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['rules_title']; ?></h1>
                  <?php
                     $rules_desc = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['rules_desc'];
                     echo divide_text("<ol>","<li>", $rules_desc);
                   ?>
                  <h1><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['rules2_title']; ?></h1>
                  <?php
                     $rules2_desc = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['rules2_desc'];
                     echo divide_text("<ol>","<li>", $rules2_desc);
                   ?>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php include '../footer_subpage.php';?>
<script src="../js/eloboost_boosting.js"></script>
<script src="../js/scroll-top.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>
</html>
