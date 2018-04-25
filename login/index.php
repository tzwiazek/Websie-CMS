<?php
/***** log in *****/
   if(isset($_POST['login']) && isset($_POST['password'])) {
      $login = $_POST['login'];
      $password = $_POST['password'];

      $c = mysqli_connect("localhost", "root", "","eloboost");
      $c->set_charset("utf8");
      $q = mysqli_query($c, "SELECT nickname FROM admin WHERE login='$login' AND password='$password'");
      while ($r = mysqli_fetch_array ($q)) {
         session_start();
         $_SESSION['nickname'] = $r['nickname'];
         header("Location:eb_admin_panel");
      }
      if (mysqli_num_rows($q)==0) {
         header("Location:index.php?error=authentication");
      }
   mysqli_close($c);
   }
/***** /log in *****/
?>
<?php include '../header.php';?>
   <section>
      <div class="container--section">
         <form id="login--form" action="#" method="POST">
            <div class="login__title">
               <h1>Log in to your account</h1>
            </div>
            <div class="login__form">
               <?php
                  if(isset($_GET["error"])) {
                     $error = "These credentials do not match our records.";
                     echo "<p class='error__login'>".$error."</p>";
                  }
               ?>
               <input type="text" name="login" placeholder="Username" required autofocus/>
               <input type="password" name="password" placeholder="Password" required />
               <div class="form__remember">
                  <label>
                     <input type="checkbox" name="remember">
                     <span>Remember me</span>
                  </label>
                  <label>
                     <span id="remember">Forgot password?</span>
                  </label>
               </div>
               <button type="submit">Submit</button>
            </div>
            <div class="password__form">
               <input type="text" placeholder="Email Address" autofocus/>
               <div class="form__remember">
                  <label>
                     <span id="login">Log in</span>
                  </label>
                  <label>
                     <span id="email">Forgot email?</span>
                  </label>
               </div>
               <button type="submit">Submit</button>
            </div>
         </form>
      </div>
   </section>
   <?php include '../footer_subpage.php';?>
<script>
document.querySelector("#remember").addEventListener("click", function() {
   document.querySelector(".login__form").style="opacity:0;z-index:-1";
   document.querySelector(".password__form").style="opacity:1;z-index:1";
});
document.querySelector("#login").addEventListener("click", function() {
   document.querySelector(".login__form").style="opacity:1;z-index:1";
   document.querySelector(".password__form").style="opacity:0;z-index:-1";
});
document.querySelector("#email").addEventListener("click", function() {location.href = "/eloboost/contact";});
</script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="../js/scroll-top.js"></script>
</body>
</html>
