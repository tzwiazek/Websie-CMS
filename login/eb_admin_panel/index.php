<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="../../css/admin_panel.css">
   <meta name="description" content="">
   <meta name="keywords" content="">

   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic,900" rel="stylesheet" type="text/css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
   <![endif]-->

   <title>Eloboost - admin panel</title>
</head>
<body>
<?php
   $c = mysqli_connect("localhost", "root", "","eloboost");
   $c->set_charset("utf8");
   $q = mysqli_query($c, "SELECT nickname FROM admin");
   $Nickname = array();

   while ($r = mysqli_fetch_array ($q)) {
      array_push($Nickname, $r['nickname']);
   }

   session_start();
   for($i=0;$i<count($Nickname);$i++) {
      if(isset($_SESSION['nickname']) && $_SESSION['nickname'] == $Nickname[$i]) {
         admin_panel();
         break;
      } else {
         echo "Błąd logowania";
         break;
      }
   }

   /***** Global functions *****/
   /*
   $parent_tag -> can be null, default ul/ol
   $tag -> will be used before and after loop
   $text -> text, which will divide (for example -> $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav` WHERE ID='1'"))['logo_text'];)
   */
   function divide_text($parent_tag, $tag, $text) {
      $text_arr= explode(";", $text);
      $tag_end = $tag[0]."/".substr($tag,1);
      if($parent_tag!=null) {
         $parent_tag_end = $parent_tag[0]."/".substr($parent_tag,1);
         echo $parent_tag;
      }
      for($i=0;$i<count($text_arr)-1;$i++) {echo $tag.$text_arr[$i].$tag_end;}
      if($parent_tag!=null) {echo $parent_tag_end;}
   }

/*
$text -> text, which will divide (for example -> $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav` WHERE ID='1'"))['logo_text'];)
$name -> input name ($_POST['$name'])
$tag -> will be used before and after loop (<li> // do something </li>)
$tag_title -> can be null, title before input
$table_database -> table in database
$col -> column in database
*/
   function divide_text_input($text, $name, $tag, $tag_title, $table_database, $col) {
      $c = mysqli_connect("localhost", "root", "","eloboost");
      $c->set_charset("utf8");

         $text_arr= explode("; ", $text, substr_count($text, ';')+1);
         if($tag != null) {
            $tag_end = $tag[0]."/".substr($tag,1);
            if($tag_title == null) echo $tag;
            else echo $tag.$tag_title;
         }

      if(count($text_arr) > 1) {
         for($i=0;$i<count($text_arr);$i++) {
            echo "<input type='text' name='$name$i' value='";
            if(isset($_POST["$name$i"]) && $_POST["$name$i"]!="") {
               if($i == 0) $temp = $_POST["$name$i"]."; ";
               else if($i != count($text_arr)-1) $temp .= $_POST["$name$i"]."; ";
               else if($i == count($text_arr)-1) {
                  $temp .= $_POST["$name$i"];
                  $update = mysqli_query($c, "UPDATE `$table_database` SET $col='$temp'");
               }
               echo $_POST["$name$i"];
            } else echo $text_arr[$i];
            echo "' placeholder='";
            if(isset($_POST["$name$i"]) && $_POST["$name$i"]!="") echo $_POST["$name$i"];
            else echo $text_arr[$i];
            echo "'>";
         }
      } else {
         $input_class = "";
         if($col == "box1_title" || $col == "box2_title" || $col == "box3_title" || $col == "eloboost_tab1" || $col == "eloboost_tab2" || $col == "eloboost_tab3" || $col == "eloboost_tab4") {echo "<span>Title:</span>";}
         else if($col == "box1_content" || $col == "box2_content" || $col == "box3_content" || $col == "highlight1_text" || $col == "highlight2_text" || $col == "highlight3_text" || $col == "highlight4_text" || $col == "box1_desc" || $col == "box2_desc") {echo "<span>Content:</span>";}
         else if($col == "box1_b" || $col == "box2_b" || $col == "box3_b") {echo "<span>Content-bolder:</span>";}
         else if($col == "highlight1_num" || $col == "highlight2_num" || $col == "highlight3_num" || $col == "highlight4_num") {echo "<span>Number:</span>";}
         else if($col == "contact_text") {echo "<span>Question:</span>";}
         else if($col == "q1_contact") {echo "<span>First row:</span>";}
         else if($col == "q2_contact") {echo "<span>Second row:</span>";}
         else if($col == "q3_contact") {echo "<span>Third row:</span>";}
         else if($col == "submit_contact") {echo "<span>Button:</span>";}
         else if($col == "copyright") {$input_class = "class='input_1'";}
         else if($col == "box3_desc1" || $col == "box3_desc2") {echo "<span>Social media:</span>";}
         else if($col == "order_title" || $col == "order_duo" || $col == "order_button") {echo "<span>Title:</span>";}
         $name = $col;
         echo "<input type='text'"; if($input_class) echo $input_class; echo"name='$name' value='";
         if(isset($_POST["$name"]) && $_POST["$name"]!="") {
            $temp = $_POST["$name"];
            $update = mysqli_query($c, "UPDATE `$table_database` SET $col='$temp'");
            echo $_POST["$name"];
         } else echo $text_arr[0];
         echo "' placeholder='";
         if(isset($_POST["$name"]) && $_POST["$name"]!="") echo $_POST["$name"];
         else echo $text_arr[0];
         echo "'>";
      }
      if($tag != null) {echo $tag_end;}
   }

   /*
   $c = mysqli_connect("localhost", "root", "","eloboost");
   $tag -> will be used before and after loop (<li> // do something </li>)
   $name -> input name ($_POST['$name'])
   $i -> local variable from loop (box1, box2, ..., box$i)
   $table_database -> table in database
   */
   function input_image($c, $tag, $name, $i, $table_database) {
      echo $tag."Image:";
      echo "<select name='$name$i"."_icon'>
            <option value='' selected></option>
            <option value='fas fa-gamepad'>fa-gamepad</option>
            <option value='fas fa-users'>fa-users</option>
            <option value='fas fa-trophy'>fa-trophy</option>
         </select>";
         if(isset($_POST["$name$i"."_icon"]) && $_POST["$name$i"."_icon"]!="") {
            $update = mysqli_query($c, "UPDATE `$table_database` SET $name".$i."_icon='".$_POST["$name$i"."_icon"]."'");
         }
   }
   /***** Global functions *****/

   function admin_panel() {
      echo "
      <div id='wrapper'>
         <div class='pop'></div>
         <header>
            <h1>
               <a href='/eloboost'>Eloboost</a>
            </h1>
            <nav>
             <ul>
               <li>
                  <div class='sub--nav'>
                     <ul>
                        <li>
                           <a href='#' data-title='Homepage'>Homepage</a>
                        </li>
                     </ul>
                  </div>
                  <a href='#' data-title='Dashboard'>Dashboard</a>
                  <ul>
                     <li>
                        <a href='#' data-title='Home page'>Homepage</a>
                     </li>
                  </ul>
               </li>
               <li>
                  <div class='sub--nav'>
                     <ul>
                        <li>
                           <a href='#' data-title='index'>Index</a>
                        </li>
                        <li>
                           <a href='#' data-title='boosting'>Boosting</a>
                        </li>
                        <li>
                           <a href='#' data-title='coaching'>Coaching</a>
                        </li>
                        <li>
                           <a href='#' data-title='gallery'>Gallery</a>
                        </li>
                     </ul>
                  </div>
                  <a href='#' data-title='Pages'>Pages</a>
                  <ul>
                     <li>
                        <a href='#' data-title='index'>Index</a>
                     </li>
                     <li>
                        <a href='#' data-title='boosting'>Boosting</a>
                     </li>
                     <li>
                        <a href='#' data-title='coaching'>Coaching</a>
                     </li>
                     <li>
                        <a href='#' data-title='gallery'>Gallery</a>
                     </li>
                  </ul>
               </li>
               <li>
                 <a href='#' data-title='Users'>Users</a>
               </li>
               <li>
                 <a href='#' data-title='Customers''>Customers</a>
               </li>
               <li>
                 <a href='#' data-title='Upload'>Upload images</a>
               </li>
               <li>
                 <a href='#' data-title='Soon'>Soon</a>
               </li>
             </ul>
           </nav>
         </header>
         <main>
            <div class='title'>
               <h2>Title</h2>
               <div class='admin--login'>
                  <a href='#'>Hello, "; echo $_SESSION['nickname']; echo"</a>
                  <ul>
                     <div class='switch'>
                         <input type='checkbox' id='toggle-bg'>
                         <label for='toggle'><i></i></label>
                     </div>
                  </ul>
               </div>
            </div>

            <section id='overlap1'>
               <div class='statement--box'>
                  <div class='statement__content'>
                     <p>Eloboost - version 1.0.0</p>
                  </div>
               </div>
               <div class='statement--box'>
                  <div class='statement__content statement--box__4'>
                     <h4>In brief</h4>
                     <div class='statement__content__row'>
                        <div class='statement__content__item'>
                           <a href='#' data-title='Pages'>
                              <span>0 Pages</span>
                           </a>
                        </div>
                        <div class='statement__content__item'>
                           <a href='#' data-title='Users'>
                              <span>0 Users</span>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class='statement__content statement--box__4'>
                     <h4>Quick draft</h4>
                  </div>
                  <div class='statement--box__empty statement--box__4'></div>
                  <div class='statement--box__empty statement--box__4'></div>
               </div>
            </section>

            <!-- page editor - index -->
            <section id='overlap2'>
               <!-- index.php -->
               <div class='statement--box overlap_subpage'>
                  <div class='statement__content statement--box__1_3 overflow_auto'>
                     <form action='/eloboost/login/eb_admin_panel/index.php' method='post'>
                     <h4>Edit Page</h4>
                     <div class='statement__content__edit__page'>
                        <div class='edit__page__item'>
                           <span>Nav</span>
                           <ul>
                              <li>Logo
                                 <ul>
                                    <li>";
                                       $c = mysqli_connect("localhost", "root", "","eloboost");
                                       $c->set_charset("utf8");
                                       $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav` WHERE ID='1'"))['logo_text'];
                                       echo divide_text_input($text, "logo_text", "<li>", null, "nav", "logo_text");
                                    echo "</li>
                                 </ul>
                              </li>
                              <li class='required'>Menu
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav` WHERE ID='1'"))['items'];
                                    echo divide_text_input($text, "nav_item", "<li>", null, "nav", "items");
                                 echo "</ul>
                              </li>
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $nav_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav` WHERE ID='1'"))['nav_css'];
                                    $temp_arr = explode(";", $nav_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $nav_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $nav_css_arr[0]; echo": </span><input id='nav_css$i' name='nav_css$i' type='text' placeholder='";
                                       echo $nav_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $nav_css_arr[1]; echo"></li>";
                                       if(isset($_POST["nav_css$i"]) && $_POST["nav_css$i"]!="") {
                                          $temp = "nav-background:".$_POST["nav_css0"].";"."nav-height:".$_POST["nav_css1"].";"."nav-position:".$_POST["nav_css2"].";";
                                          $update = mysqli_query($c, "UPDATE nav SET nav_css='$temp'");
                                       }
                                    }
                                    echo "
                                    <li>
                                       <div class='btn_li' id='nav_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Header</span>
                           <ul>
                              <li class='required'>Jumbotron
                                 <ul>";
                                       $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['header_text'];
                                       echo divide_text_input($text, "jumbotron", "<li>", null, "index.php", "header_text");
                                 echo"</ul>
                              </li>
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $header_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['header_css'];
                                    $temp_arr = explode(";", $header_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $header_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $header_css_arr[0]; echo": </span><input id='header_css$i' name='header_css$i' type='text' placeholder='";
                                       echo $header_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $header_css_arr[1]; echo"></li>";
                                       if(isset($_POST["header_css$i"]) && $_POST["header_css$i"]!="") {
                                          $temp = "header-background:".$_POST["header_css0"].";"."header-position:".$_POST["header_css1"].";"."header-repeat:".$_POST["header_css2"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET header_css='$temp'");
                                       }
                                    }
                                    echo "<li>
                                       <div class='btn_li' id='header_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Front page section - content</span>
                           <ul>";
                              function divide_boxes($c, $tag, $tag_title, $name, $table_database) {
                                 $tag_end = $tag[0]."/".substr($tag,1);
                                 for($i=1;$i<=3;$i++) {
                                    echo "<li>".$tag_title.$i."<ul>";
                                    //image
                                    input_image($c, $tag, $name, $i, $table_database);

                                    // title
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["box$i"."_title"];
                                    echo divide_text_input($text, "box_title", "<li>", null, "index.php", "box$i"."_title");

                                    // content
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["box$i"."_content"];
                                    echo divide_text_input($text, "box_content", "<li>", null, "index.php", "box$i"."_content");

                                    // bolder text
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["box$i"."_b"];
                                    echo divide_text_input($text, "box_b", "<li>", null, "index.php", "box$i"."_b");

                                    echo $tag_end;
                                    echo "</ul></li>";
                                 }
                              }
                              divide_boxes($c, "<li>", "Box", "box", "index.php");
                              echo "
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $box_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['box_css'];
                                    $temp_arr = explode(";", $box_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $box_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $box_css_arr[0]; echo": </span><input id='box_css$i' name='box_css$i' type='text' placeholder='";
                                       echo $box_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $box_css_arr[1]; echo"></li>";
                                       if(isset($_POST["box_css$i"]) && $_POST["box_css$i"]!="") {
                                          $temp = "box-background:".$_POST["box_css0"].";"."box-color:".$_POST["box_css1"].";"."box-header-font-size:".$_POST["box_css2"].";"."box-paragraph-font-size:".$_POST["box_css3"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET box_css='$temp'");
                                       }
                                    }
                                    echo "
                                    <li>
                                       <div class='btn_li' id='box_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Highlight</span>
                           <ul>";
                              function divide_highlight($c, $tag, $tag_title, $name, $table_database) {
                                 $tag_end = $tag[0]."/".substr($tag,1);
                                 for($i=1;$i<=4;$i++) {
                                    echo "<li>".$tag_title.$i."<ul>";

                                    // title
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["highlight$i"."_num"];
                                    echo divide_text_input($text, "highlight_num", "<li>", null, "index.php", "highlight$i"."_num");

                                    // content
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["highlight$i"."_text"];
                                    echo divide_text_input($text, "highlight_text", "<li>", null, "index.php", "highlight$i"."_text");

                                    echo $tag_end;
                                    echo "</ul></li>";
                                 }
                              }
                              divide_highlight($c, "<li>", "Box", "box", "index.php");
                              echo "<li>Style
                                 <ul>";
                                    $temp="";
                                    $highlight_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['highlight_css'];
                                    $temp_arr = explode(";", $highlight_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $highlight_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $highlight_css_arr[0]; echo": </span><input id='highlight_css$i' class='input_1' name='highlight_css$i' type='text' placeholder='";
                                       echo $highlight_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $highlight_css_arr[1]; echo"></li>";
                                       if(isset($_POST["highlight_css$i"]) && $_POST["highlight_css$i"]!="") {
                                          $temp = "highlight-background:".$_POST["highlight_css0"].";"."highlight-header-font-size:".$_POST["highlight_css1"].";"."highlight-desc-font-size:".$_POST["highlight_css2"].";"."highlight-header-color:".$_POST["highlight_css3"].";"."highlight-desc-color:".$_POST["highlight_css4"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET highlight_css='$temp'");
                                       }
                                    }
                                    echo "
                                    <li>
                                       <div class='btn_li' id='highlight_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Boosters</span>
                           <ul>
                              <li>To może będzie przekierowanie do innej zakładki, zależy ile tego wyjdzie w praktyce</li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Recommendation</span>
                           <ul>
                              <li>Opinion
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["owl_item"];
                                    echo divide_text_input($text, "highlight_num", "<li>", null, "index.php", "owl_item");
                                    echo "
                                 </ul>
                              </li>
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $owl_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['owl_css'];
                                    $temp_arr = explode(";", $owl_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $owl_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $owl_css_arr[0]; echo": </span><input id='owl_css$i' name='owl_css$i' type='text' placeholder='";
                                       echo $owl_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $owl_css_arr[1]; echo"></li>";
                                       if(isset($_POST["owl_css$i"]) && $_POST["owl_css$i"]!="") {
                                          $temp = "owl-background:".$_POST["owl_css0"].";"."owl-position:".$_POST["owl_css1"].";"."owl-repeat:".$_POST["owl_css2"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET owl_css='$temp'");
                                       }
                                    }
                                    echo "<li>
                                       <div class='btn_li' id='owl_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Contact</span>
                           <ul>
                              <li>Title
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["contact_text"];
                                    echo divide_text_input($text, "highlight_num", "<li>", null, "index.php", "contact_text");
                                 echo"
                                 </ul>
                              </li>
                              <li>Form
                                 <ul>";
                                    for($i=1;$i<4;$i++) {
                                       $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["q$i"."_contact"];
                                       echo divide_text_input($text, "highlight_num", "<li>", null, "index.php", "q$i"."_contact");
                                    }
                                 echo"
                                 </ul>
                              </li>
                              <li>Send
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))["submit_contact"];
                                    echo divide_text_input($text, "highlight_num", "<li>", null, "index.php", "submit_contact");
                                 echo"
                                 </ul>
                              </li>
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $contact_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['contact_css'];
                                    $temp_arr = explode(";", $contact_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $contact_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $contact_css_arr[0]; echo": </span><input id='contact_css$i' class='input_1' name='contact_css$i' type='text' placeholder='";
                                       echo $contact_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $contact_css_arr[1]; echo"></li>";
                                       if(isset($_POST["contact_css$i"]) && $_POST["contact_css$i"]!="") {
                                          $temp = "contact-title-font-size:".$_POST["contact_css0"].";"."contact-title-color:".$_POST["contact_css1"].";"."contact-background:".$_POST["contact_css2"].";"."contact-button-background:".$_POST["contact_css3"].";"."contact-button-font-size:".$_POST["contact_css4"].";"."contact-button-color:".$_POST["contact_css5"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET contact_css='$temp'");
                                       }
                                    }
                                    echo "
                                    <li>
                                       <div class='btn_li' id='contact_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Footer</span>
                           <ul>
                              <li>Copyright
                                 <ul>";
                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer.php` WHERE ID='1'"))["copyright"];
                                 echo divide_text_input($text, "footer_copyright", "<li>", null, "footer.php", "copyright");
                              echo "
                              </li>
                           </ul>
                        </div>
                     </div>
                     <button class='btn submit' type='submit'>Confirm</button>
                     <p>* fill out field to save changes</p>
                     </form>
                  </div>
                  <div class='statement__content statement--box__3_1 edit__page__iframe'>
                     <iframe src='/eloboost'>
                        <p>Your browser does not support iframes.</p>
                     </iframe>
                  </div>
               </div>
               <!-- eloboost.php -->
               <div class='statement--box overlap_subpage'>
                  <div class='statement__content statement--box__1_3 overflow_auto'>
                     <form action='/eloboost/login/eb_admin_panel/index.php' method='post'>
                     <h4>Edit Page</h4>
                     <div class='statement__content__edit__page'>
                        <div class='edit__page__item'>
                           <span>Bacground image</span>
                           <ul>
                              <li>Style
                                 <ul>";
                                    $temp="";
                                    $bg_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))['bg_image_css'];
                                    $temp_arr = explode(";", $bg_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $bg_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $bg_css_arr[0]; echo": </span><input id='bg_css$i' name='bg_css$i' type='text' placeholder='";
                                       echo $bg_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $bg_css_arr[1]; echo"></li>";
                                       if(isset($_POST["bg_css$i"]) && $_POST["bg_css$i"]!="") {
                                          $temp = "bg_image-background:".$_POST["bg_css0"].";"."bg_image-position:".$_POST["bg_css1"].";"."bg_image-repeat:".$_POST["bg_css2"].";";
                                          $update = mysqli_query($c, "UPDATE `eloboost.php` SET bg_image_css='$temp'");
                                       }
                                    }
                                    echo "<li>
                                       <div class='btn_li' id='page2_bg_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Boosting Tabs</span>
                           <ul>";
                              function divide_tabs($c, $tag, $tag_title, $name, $table_database) {
                                 $tag_end = $tag[0]."/".substr($tag,1);
                                 for($i=1;$i<=4;$i++) {
                                    echo "<li>".$tag_title.$i."<ul>";

                                    // title
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["eloboost_tab$i"];
                                    echo divide_text_input($text, "box_page2_tab", "<li>", null, "eloboost.php", "eloboost_tab$i");

                                    echo $tag_end;
                                    echo "</ul></li>";
                                 }
                              }
                              divide_tabs($c, "<li>", "Tab", "box", "index.php");
                              echo "
                              <li>Style
                                 <ul>";
                                 /*
                                    $temp="";
                                    $box_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php` WHERE ID='1'"))['box_css'];
                                    $temp_arr = explode(";", $box_css);
                                    for($i=0;$i<count($temp_arr)-1;$i++) {
                                       $box_css_arr = explode(":", $temp_arr[$i]);
                                       echo "<li><span>"; echo $box_css_arr[0]; echo": </span><input id='box_css$i' name='box_css$i' type='text' placeholder='";
                                       echo $box_css_arr[1]; // first is property, next value
                                       echo "' value="; echo $box_css_arr[1]; echo"></li>";
                                       if(isset($_POST["box_css$i"]) && $_POST["box_css$i"]!="") {
                                          $temp = "box-background:".$_POST["box_css0"].";"."box-color:".$_POST["box_css1"].";"."box-header-font-size:".$_POST["box_css2"].";"."box-paragraph-font-size:".$_POST["box_css3"].";";
                                          $update = mysqli_query($c, "UPDATE `index.php` SET box_css='$temp'");
                                       }
                                    }
                                    */
                                       echo "
                                    <li>
                                       <div class='btn_li' id='box_css'>Default settings</div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Purchase</span>
                           <ul>
                              <li><span>Order</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["order_title"];
                                    echo divide_text_input($text, "order_title", "<li>", null, "eloboost.php", "order_title");
                                    echo "
                                 </ul>
                              </li>
                              <li><span>Duo Queue</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["order_duo"];
                                    echo divide_text_input($text, "order_duo", "<li>", null, "eloboost.php", "order_duo");
                                    echo "
                                 </ul>
                              </li>
                              <li><span>Button</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["order_button"];
                                    echo divide_text_input($text, "order_duo", "<li>", null, "eloboost.php", "order_button");
                                    echo "
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Terms and Conditions</span>
                           <ul>
                              <li><span>Rules Title</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["rules_title"];
                                    echo divide_text_input($text, "rules_title", "<li>", null, "eloboost.php", "rules_title");
                                    echo "
                                 </ul>
                              </li>
                              <li><span>Points</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["rules_desc"];
                                    echo divide_text_input($text, "rules_desc", "<li>", null, "eloboost.php", "rules_desc");
                                    echo "
                                 </ul>
                              </li>
                              <li><span>Terms and Conditions</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["rules2_title"];
                                    echo divide_text_input($text, "rules2_title", "<li>", null, "eloboost.php", "rules2_title");
                                    echo "
                                 </ul>
                              </li>
                              <li><span>Points</span>
                                 <ul>";
                                    $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php` WHERE ID='1'"))["rules2_desc"];
                                    echo divide_text_input($text, "rules2_desc", "<li>", null, "eloboost.php", "rules2_desc");
                                    echo "
                                 </ul>
                              </li>
                           </ul>
                        </div>
                        <div class='edit__page__item'>
                           <span>Footer</span>
                           <ul>
                              <li>box1
                                 <ul>";
                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box1_title"];
                                 echo divide_text_input($text, "box1_title", "<li>", null, "footer_subpage.php", "box1_title");

                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box1_desc"];
                                 echo divide_text_input($text, "box1_desc", "<li>", null, "footer_subpage.php", "box1_desc");
                                 echo "
                                 </ul>
                              </li>
                              <li>box2
                                 <ul>";
                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box2_title"];
                                 echo divide_text_input($text, "box2_title", "<li>", null, "footer_subpage.php", "box2_title");

                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box2_desc"];
                                 echo divide_text_input($text, "box2_desc", "<li>", null, "footer_subpage.php", "box2_desc");
                                 echo "
                                 </ul>
                              </li>
                              <li>box3
                                 <ul>";
                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box3_title"];
                                 echo divide_text_input($text, "box3_title", "<li>", null, "footer_subpage.php", "box3_title");

                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box3_desc1"];
                                 echo divide_text_input($text, "box3_desc1", "<li>", null, "footer_subpage.php", "box3_desc1");

                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box3_desc2"];
                                 echo divide_text_input($text, "box3_desc2", "<li>", null, "footer_subpage.php", "box3_desc2");
                                 echo "
                                 </ul>
                              </li>
                              <li>Copyright
                                 <ul>";
                                 $text = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `footer.php` WHERE ID='1'"))["copyright"];
                                 echo divide_text_input($text, "footer_copyright", "<li>", null, "footer.php", "copyright");
                                 echo "
                                 </ul>
                              </li>
                        </div>
                     </div>

                     <button class='btn submit' type='submit'>Confirm</button>
                     <p>* fill out field to save changes</p>
                     </form>
                  </div>
                  <div class='statement__content statement--box__3_1 edit__page__iframe'>
                     <iframe src='/eloboost/boosting'>
                        <p>Your browser does not support iframes.</p>
                     </iframe>
                  </div>
               </div>
               <!-- coaching.php -->
               <div class='statement--box overlap_subpage'>
                  <div class='statement__content statement--box__1_3 overflow_auto'>
                     <form action='/eloboost/login/eb_admin_panel/index.php' method='post'>
                     <h4>Edit Page</h4>
                     <div class='statement__content__edit__page'>
                        <div class='edit__page__item'>
                           <span>Footer</span>
                           <ul>
                              <li>box1
                                 <ul>";
                                    echo "XD";
                                    echo "
                                 </ul>
                              </li>
                        </div>
                     </div>

                     <button class='btn submit' type='submit'>Confirm</button>
                     <p>* fill out field to save changes</p>
                     </form>
                  </div>
                  <div class='statement__content statement--box__3_1 edit__page__iframe'>
                     <iframe src='/eloboost/coaching'>
                        <p>Your browser does not support iframes.</p>
                     </iframe>
                  </div>
               </div>
               <!-- gallery.php -->
               <div class='statement--box overlap_subpage'>
                  <div class='statement__content statement--box__1_3 overflow_auto'>
                     <form action='/eloboost/login/eb_admin_panel/index.php' method='post'>
                     <h4>Edit Page</h4>
                     <div class='statement__content__edit__page'>
                        <div class='edit__page__item'>
                           <span>Gallery</span>
                           <ul>
                              <li>box1
                                 <ul>";
                                    echo "XD";
                                    echo "
                                 </ul>
                              </li>
                        </div>
                     </div>

                     <button class='btn submit' type='submit'>Confirm</button>
                     <p>* fill out field to save changes</p>
                     </form>
                  </div>
                  <div class='statement__content statement--box__3_1 edit__page__iframe'>
                     <iframe src='/eloboost/gallery'>
                        <p>Your browser does not support iframes.</p>
                     </iframe>
                  </div>
               </div>
            </section>
            <!-- /page editor - index -->

            <!-- page editor - second page -->
            <!-- /page editor - second page -->

            <!--
            <section id='overlap3' class='larg'>
             <div>
               <h3>Project 221 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 2 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 3 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
            </section>

            <section id='overlap4' class='larg'>
             <div>
               <h3>Project 221 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 2 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 3 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
            </section>
            -->
            <section id='overlap5' class='gallery_section'>
               <div class='container--section gallery'>";
                  $images = glob("uploads/*");
                  foreach($images as $image) {
                     $str = ltrim($image, "uploads/"); // cut path
                     if(strlen($str)>25) { // shortens long names
                        $temp_arr = [];
                        for($i=0;$i<25;$i++) {
                           array_push($temp_arr, $str[$i]);
                        }
                        echo "<div class='box__gallery'><img src='$image' alt='gallery_img' />";
                        for($i=0;$i<25;$i++) {echo $temp_arr[$i];}
                        echo"</div>";
                     } else
                     echo "<div class='box__gallery'><img src='$image' alt='gallery_img' /><h6>$str</h6></div>";
                  }
               echo "</div>
             <div class='img_upload'>
               <form action='upload.php' method='post' enctype='multipart/form-data'>
                   Select image to upload:
                   <input type='file' name='fileToUpload' id='fileToUpload'>
                   <input type='submit' value='Upload Image' name='submit'>
               </form>
             </div>
            </section>

            <!--
            <section id='overlap6' class='larg'>
             <div>
               <h3>Project 221 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 2 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
             <div>
               <h3>Project 3 <span></span></h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus iste quia incidunt ad provident ullam quo assumenda expedita quae sapiente ipsa qui esse similique! Modi obcaecati natus sapiente quaerat omnis.</p>
             </div>
            </section>
            -->
         </main>
   </div>";
   }
?>
<?php
   function save_to_file($el) {
      $c = mysqli_connect("localhost", "root", "","eloboost");
      $c->set_charset("utf8");

      if($el == "nav") {$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav`"))['nav_css'];}
      else if ($el == "header"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['header_css'];}
      else if ($el == "box"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['box_css'];}
      else if ($el == "highlight"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['highlight_css'];}
      else if ($el == "owl"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['owl_css'];}
      else if ($el == "contact"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['contact_css'];}
      else if ($el == "bg_image"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php`"))['bg_image_css'];}

      $el_css_arr = explode(";", $el_css); // divides string from database for elements and push it to array

      $myfile = fopen("custom_css.txt", "r") or die("Unable to open file"); // reads text from file
      $el_arr=[];
      while(!feof($myfile)) {
         array_push($el_arr,fgets($myfile)); // push text from file to array
      }
      fclose($myfile); // close file


      if(strpos(file_get_contents("custom_css.txt"),$el) === false) { // if string do not exist in file create it
         for($i=0;$i<count($el_css_arr);$i++) {
            $myfile = fopen("custom_css.txt", "a") or die("Unable to open file"); // open file
            if($i != count($el_css_arr)-1)
               $txt = $el_css_arr[$i].";".PHP_EOL;
            else
               $txt = $el_css_arr[$i];
            fwrite($myfile, $txt);
            fclose($myfile);
         }
      } else {
         if($el == "nav") {$num=2;}
         else if($el == "header") {$num=2;}
         else if($el == "box") {$num=3;}
         else if($el == "highlight") {$num=4;}
         else if($el == "owl") {$num=2;}
         else if($el == "contact") {$num=5;}
         else if($el == "bg_image") {$num=2;}
         for($i=0;$i<=$num;$i++) {
            $path_to_file = 'custom_css.txt';
            $file_contents = file_get_contents($path_to_file);

            if($el == "nav") {$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `nav`"))['nav_css'];}
            else if($el == "header"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['header_css'];}
            else if($el == "box"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['box_css'];}
            else if($el == "highlight"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['highlight_css'];}
            else if($el == "owl"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['owl_css'];}
            else if($el == "contact"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `index.php`"))['contact_css'];}
            else if($el == "bg_image"){$el_css = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM `eloboost.php`"))['bg_image_css'];}
            $temp_arr = explode(";", $el_css);
            if($el == "nav") {$file_contents = str_replace($el_arr[$i],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "header") {$file_contents = str_replace($el_arr[$i+3],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "box") {$file_contents = str_replace($el_arr[$i+6],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "highlight") {$file_contents = str_replace($el_arr[$i+10],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "owl") {$file_contents = str_replace($el_arr[$i+15],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "contact") {$file_contents = str_replace($el_arr[$i+18],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            else if($el == "bg_image") {$file_contents = str_replace($el_arr[$i+24],$temp_arr[$i].";".PHP_EOL,$file_contents);}
            file_put_contents($path_to_file,$file_contents);
         }
      }
   }
   save_to_file("nav");
   save_to_file("header");
   save_to_file("box");
   save_to_file("highlight");
   save_to_file("owl");
   save_to_file("contact");
   save_to_file("bg_image");
?>

<script src="../../js/jquery.min.js"></script>
<!-- profilaktycznie
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
-->
<script async src="js/admin_panel.js"></script>
<script async>
$(document).ready(function() {
   /***** default settings (css) *****/
   document.querySelector("#nav_css").addEventListener("click", function() {
      let default_css = ["#202028", "60px", "fixed"]; // background, height, position
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#nav_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#header_css").addEventListener("click", function() {
      let default_css = ["url(img/1920x1080.jpg)", "center", "no-repeat"]; // bg-url, bg-position, bg-repeat
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#header_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#box_css").addEventListener("click", function() {
      let default_css = ["#e1382d", "#e1382d", "1rem", "0.85rem"]; // bg-color, text-color, font-size (header), font-size (paragraph)
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#box_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#highlight_css").addEventListener("click", function() {
      let default_css = ["#e1382d", "4rem", "1.2rem", "white", "white"]; // bg-color, font-size (header), font-size (paragraph), header-color, paragraph-color
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#highlight_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#owl_css").addEventListener("click", function() {
      let default_css = ["url(img/1920x1080.jpg)", "center", "no-repeat"]; // bg-url, bg-position, bg-repeat
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#owl_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#contact_css").addEventListener("click", function() {
      let default_css = ["2rem", "white", "#272d35", "#e1382d", "1.5rem", "white"]; // title font-size, title color, button background, button font-size, button color
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#contact_css"+i).value = default_css[i];
      }
   });
   document.querySelector("#page2_bg_css").addEventListener("click", function() {
      let default_css = ["url(../img/1920x350.jpg)", "center", "no-repeat"]; // bg-url, bg-position, bg-repeat
      for(let i=0;i<default_css.length;i++) {
         document.querySelector("#bg_css"+i).value = default_css[i];
      }
   });
});
</script>
<?php mysqli_close($c); ?>
</body>
</html>
