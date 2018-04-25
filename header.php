<!DOCTYPE html>
<?php
   $connect = @mysqli_connect('localhost', 'root', '', 'eloboost');
   $connect->set_charset("utf8");
?>
<html lang="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `header.php` WHERE ID='1'"))['lang']; ?>">
<head>
   <meta charset="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `header.php` WHERE ID='1'"))['charset']; ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `header.php` WHERE ID='1'"))['title']; ?></title>
   <link rel="Stylesheet" type="text/css" href="/eloboost/css/style.css" />
   <meta name="description" content="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `header.php` WHERE ID='1'"))['description']; ?>">
   <meta name="keywords" content="<?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `header.php` WHERE ID='1'"))['keywords']; ?>">

   <!-- Fonts -->
   <link href="/eloboost/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic,900" rel="stylesheet" type="text/css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
   <![endif]-->

   <?php
      $filepath1 = 'login/eb_admin_panel/custom_css.txt';
      $filepath2 = '../login/eb_admin_panel/custom_css.txt';
      $filepath3 = 'eb_admin_panel/custom_css.txt';
      if (file_exists($filepath1)) {$myfile = fopen($filepath1, "r") or die("Unable to open file");}
      else if(file_exists($filepath2)) {$myfile = fopen($filepath2, "r") or die("Unable to open file");}
      else {$myfile = fopen($filepath3, "r") or die("Unable to open file");}

      $css_arr=[];
      while(!feof($myfile)) {
         array_push($css_arr,fgets($myfile)); // push text from file to array
      }
      fclose($myfile); // close file
      /***** Index *****/
      if(count($css_arr)>1) {
         $nav_bg = explode(":", $css_arr[0]); // background-color (default: #202028)
         $nav_h = explode(":", $css_arr[1]); // height (default: 60px)
         $nav_pos = explode(":", $css_arr[2]); // position (default: fixed)
         $header_bg = explode(":", $css_arr[3]); // background-image (default: url(img/1920x1080.jpg))
         $header_pos = explode(":", $css_arr[4]); // position (default: center)
         $header_rep = explode(":", $css_arr[5]); // position-repeat (default: no-repeat)
         $box_bg = explode(":", $css_arr[6]); // background-color (default: #e1382d)
         $box_col = explode(":", $css_arr[7]); // color (default: #e1382d)
         $box_h = explode(":", $css_arr[8]); // header font-size (default: 1rem)
         $box_p = explode(":", $css_arr[9]); // paragraph font-size (default: 0.85rem)
         $highlight_bg = explode(":", $css_arr[10]); // background-color (default: #e1382d)
         $highlight_h = explode(":", $css_arr[11]); // header font-size (default: 4rem)
         $highlight_p = explode(":", $css_arr[12]); // description font-size (default: 1.2rem)
         $highlight_h_c = explode(":", $css_arr[13]); // header color (default: white)
         $highlight_p_c = explode(":", $css_arr[14]); // paragraph color (default: white)
         $owl_bg = explode(":", $css_arr[15]); // background-image (default: url(img/1920x1080.jpg))
         $owl_pos = explode(":", $css_arr[16]); // position (default: center)
         $owl_rep = explode(":", $css_arr[17]); // position-repeat (default: no-repeat)
         $contact_t = explode(":", $css_arr[18]); // contact-title-font-size (default: 2rem)
         $contact_t_c = explode(":", $css_arr[19]); // contact-title-color (default: white)
         $contact_bg = explode(":", $css_arr[20]); // contact-background (default :#272d35)
         $contact_btn_bg = explode(":", $css_arr[21]); // contact-button-background (default :#e1382d)
         $contact_btn = explode(":", $css_arr[22]); // contact-button-font-size (default :1.5rem;
         $contact_btn_c = explode(":", $css_arr[23]); // contact-button-color (default :white)
         $bg_image_bg = explode(":", $css_arr[24]); // background-image (default: url(img/1920x350.jpg))
         $bg_image_pos = explode(":", $css_arr[25]); // position (default: center)
         $bg_image_rep = explode(":", $css_arr[26]); // position-repeat (default: no-repeat)
      }
      /***** /Index *****/


      /***** Global functions *****/
      function divide_text($parent_tag, $tag, $text) { // ol (parent/null) {li (tag) {text (content)}}
         $text_arr= explode(";", $text);
         $tag_end = $tag[0]."/".substr($tag,1);
         if($parent_tag!=null) {
            $parent_tag_end = $parent_tag[0]."/".substr($parent_tag,1);
            echo $parent_tag;
         }
         for($i=0;$i<count($text_arr)-1;$i++) {echo $tag.$text_arr[$i].$tag_end;}
         if($parent_tag!=null) {echo $parent_tag_end;}
      }
      /***** Global functions *****/
   ?>
<style>
   <?php if(count($css_arr)>1) { ?>nav {
      background:<?php print $nav_bg[1]; ?>;
      height:<?php print $nav_h[1]; ?>;
      position:<?php print $nav_pos[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>header#header {
      background-image:<?php print $header_bg[1];?>;
      background-position:<?php print $header_pos[1]; ?>;
      background-repeat:<?php print $header_rep[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section .container--section .box .box__title.box__title {
      background:<?php print $box_bg[1]; ?>;
      font-size:<?php print $box_h[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section .container--section .box .box__content h4 {
      color:<?php print $box_col[1]; ?>;
      font-size:<?php print $box_p[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section#highlight {background:<?php print $highlight_bg[1]; ?>;}<?php } ?>
   <?php if(count($css_arr)>1) { ?>section.highlight--section .box__highlight h1 {
      font-size:<?php print $highlight_h[1]; ?>;
      color:<?php print $highlight_h_c[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section.highlight--section .box__highlight p {
      font-size:<?php print $highlight_p[1]; ?>;
      color:<?php print $highlight_p_c[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section#parallax {
      background:<?php print $owl_bg[1]; ?>;
      background-position:<?php print $owl_pos[1]; ?>;
      background-repeat:<?php print $owl_rep[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>header#header.subpage_header {
      background-image:<?php print $bg_image_bg[1]; ?>;
      background-position:<?php print $bg_image_pos[1]; ?>;
      background-repeat:<?php print $bg_image_rep[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section#contact .contact__title {
      color:<?php print $contact_t_c[1]; ?>;
      font-size:<?php print $contact_t[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>section#contact {
      background:<?php print $contact_bg[1]; ?>;
   }<?php } ?>
   <?php if(count($css_arr)>1) { ?>button#sendMessageButton {
      color:<?php print $contact_btn_c[1]; ?>;
      background:<?php print $contact_btn_bg[1]; ?>;
      font-size:<?php print $contact_btn[1]; ?>;
   }<?php } ?>
</style>
</head>
<body>
<div id="wrapper">
   <nav>
      <div class="container--nav">
         <div class="logo__nav">
            <a href="/eloboost">
               <?php
                  $logo_text = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `nav` WHERE ID='1'"))['logo_text'];
                  $logo_text_arr = explode(";", $logo_text, substr_count($logo_text, ';')+1);
                  for($i=0;$i<=substr_count($logo_text, ';');$i++) {
                     echo "<span>".$logo_text_arr[$i]."</span>";
                     echo "<span>".$logo_text_arr[$i+1]."</span>";
                     break;
                  }
               ?>
            </a>
         </div>
         <input type="checkbox" id="menu-toggle" />
         <label for="menu-toggle" class="label-toggle"></label>
         <ul>
           <?php
               if(!isset($page))
                  echo "<li><a href='/eloboost'>HOME</a></li>";
               else {
                  echo "<li><a href='#our-work'>";
                     $first_nav_item = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `nav` WHERE ID='1'"))['items'];
                     $first_nav_item_arr = explode(";", $first_nav_item, substr_count($first_nav_item, ';')+1);
                     echo $first_nav_item_arr[0];
                  echo"</a></li>";
               }
               $nav_items = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `nav` WHERE ID='1'"))['items'];
               $nav_items_arr = explode("; ", $nav_items, substr_count($nav_items, ';')+1);
               $defaultLinks = ["our-work", "boosting", "coaching", "gallery", "faq", "contact"];
               for($i=1;$i<=substr_count($nav_items, ';');$i++) {
                  if($nav_items_arr[$i] != "OUR WORK")
                     echo "<li><a href='/eloboost/$defaultLinks[$i]'>$nav_items_arr[$i]</a></li>";
                  else
                     echo "<li><a href='/eloboost/#our-work'>$nav_items_arr[$i]</a></li>";
               }
            ?>
            <li><a href="/eloboost/login"><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `nav` WHERE ID='1'"))['login'] ?></a></li>
         </ul>
      </div>
   </nav>
