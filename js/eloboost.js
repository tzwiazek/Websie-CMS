/****** Scroll *****/
$(".container--nav > ul > li:eq(0)").click(function() {
    $('html, body').animate({
        scrollTop: $("#home-top").offset().top
    }, 800);
});
/****** /Scroll *****/

/***** Owl.js *****/
$(document).ready(function() {
   $("#owl-demo").owlCarousel({
      navigation:true,
      slideSpeed:300,
      paginationSpeed:400,
      singleItem:true,
      autoPlay:7000
   });
});
/***** /Owl.js *****/

/***** ScrollReveal *****/
// animation
window.sr = new ScrollReveal();
sr.reveal('.box__desc', {
     duration:600,
     scale:0.3,
     distance:'0px'
 }, 250);
sr.reveal('.card', {
     duration:600,
     scale:0.3,
     distance:'0px'
 }, 250);
/***** /ScrollReveal *****/


/***** Count - Highlight section *****/
var fired = false;
var count_up = function() {
   if(fired === false) {
      $('.count').each(function() {
         $(this).prop('Counter',0).animate({
            Counter: $(this).text()
         }, {
            duration:2200,
            easing:'swing',
            step: function(now) {
               $(this).text(Math.ceil(now));
            }
         });
      });
      fired = true; // can be called only once
   }
};

//refresh
$(document).ready(function() {
   const scrollTop = $(window).scrollTop();
   if(scrollTop > 45 && scrollTop < 1160) {
      count_up();
      stop = true; // can be called again
   }
});

//on scroll
$(function() {
   var stop = false;

   if($('#highlight').offset().top != null) {
      const oTop = $('#highlight').offset().top - window.innerHeight;
      $(window).scroll(function() {
         if (stop === false) {
            let pTop = $(window).scrollTop();
            // console.log( pTop + ' - ' + oTop );
            if(pTop > oTop){
               count_up();
               stop = true; // can be called again
            }
         }
      });
   }
});
/***** /Count - Highlight section *****/
