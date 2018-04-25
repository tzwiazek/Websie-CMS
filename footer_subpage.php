<div id="terms">
   <div class="container--section">
      <?php
         for($i=1;$i<=3;$i++) {
            echo "
            <div class='box'>
               <h5>"; echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box$i"."_title"]; echo "</h5>";
               if($i<3) {echo "<p>"; echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box$i"."_desc"]; echo "</p>";}
               else {
                  echo "<p>"; echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box3"."_desc1"];
                  echo "<p>"; echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer_subpage.php` WHERE ID='1'"))["box3"."_desc2"];
               }
            echo"
            </div>";
         }
       ?>
   </div>
</div>
<footer>
   <p><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer.php`"))['copyright']; ?></p>
   <div id="scroll--top">
      <i class="fa fa-chevron-up"></i>
   </div>
</footer>
</div>
