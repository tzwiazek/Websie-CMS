/***** Scroll *****/
// scroll to top
const to_top = document.querySelector("#scroll--top");
to_top.addEventListener("click", function() {scroll_to_top(800);});

function scroll_to_top(duration) {
   let scroll_step = -window.scrollY / (duration/15),
   scroll_interval = setInterval(function() {
      if (window.scrollY != 0) {
         window.scrollBy(0, scroll_step);
      } else clearInterval(scroll_interval);
   }, 15);
}

// show/hide chat
document.querySelector("#menu-toggle").addEventListener("click", function() {
   let remember = document.getElementById('menu-toggle');
   if (remember.checked) {
      document.querySelector('#scroll--top').style.display = "none";
      document.querySelector('#chat-application').style.display = "none";
   } else {
      document.querySelector('#scroll--top').style.display = "block";
      document.querySelector('#chat-application').style.display = "block";
   }
});
/***** /Scroll *****/
