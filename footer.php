<footer>
   <p><?php echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `footer.php`"))['copyright']; ?></p>
   <div id="scroll--top">
      <i class="fa fa-chevron-up"></i>
   </div>
</footer>
</div>
<!-- JS -->
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '9ea0b33a9e0ffba7aeb3fdb9c9612059e608e659';
window.smartsupp||(function(d) {
    var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
    s=d.getElementsByTagName('script')[0];c=d.createElement('script');
    c.type='text/javascript';c.charset='utf-8';c.async=true;
    c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<script async src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script async src="js/scrollreveal.js"></script>
<script src="js/jquery.min.js"></script>
<script async src="js/eloboost.js"></script>
<script async src="js/owl.carousel.js"></script>
<script async src="js/scroll-top.js"></script>
<?php mysqli_close($connect); ?>
</body>
</html>
