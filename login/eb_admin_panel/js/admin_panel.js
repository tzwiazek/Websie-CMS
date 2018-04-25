$(document).ready(function() {
   document.querySelector("iframe").style = "display:block";

   const slideModule = (function () {
   /***** settings/reset *****/
      const close_overlap = function() {
         for(let i=1;i<document.querySelectorAll("section").length;i++) {
            document.querySelector("#overlap"+i).style.display = 'none';
         }
         $(".overlap_subpage").css("display","none");
      }

      const nav_reset = function(num) {
         $("nav > ul > li").css("background", "#383B42");
         $("nav > ul > li").removeClass("active__li");
         $("nav > ul > li > ul").slideUp(250);
         let active_li = document.querySelector("nav > ul > li:nth-child("+num+")");
         active_li.classList.add("active__li");
         $(active_li).children('ul').slideDown(250);
      }

      const bg_color = function(bg_flag) {
         let edit__page = document.querySelectorAll(".edit__page__item");
            if(bg_flag) {
               document.body.style.background="#c5c0c0";
               $(".edit__page__item").css({
                  border:"1px solid #c8cbd2",
                  "border-top":"0px"
               });
               $(".statement__content__edit__page > .edit__page__item:eq(0)").css("border-top","1px solid #c8cbd2");
               $(".edit__page__item > ul > li").css("border-bottom","1px solid #c8cbd2");
               $("input").css({"border":"1px solid #c8cbd2"});
            }
            else {
               document.body.style.background="#f1f1f1";
               $(".edit__page__item").css({
                  border:"1px solid #eee",
                  "border-top":"0"
               });
               $(".statement__content__edit__page > .edit__page__item:eq(0)").css("border-top","1px solid #eee");
               $(".edit__page__item > ul > li").css("border-bottom","1px solid #eee");
               $("input").css({"border":"1px solid #eee"});
            }
      }
   /***** /settings/reset *****/
      const nav_li_onclick = function(title, item) {
         $('.title').children('h2').html(title);
         slideModule.close_overlap();

         /***** overlap 1 - Home page *****/
         if(title == "Dashboard" || title == "Homepage") {
            document.querySelector('#overlap1').style.display='block';
         }
         /***** /overlap 1 - Home page *****/

         /***** overlap 2 - Page editor *****/
         else if(title == "Pages" || title == "index") {
            document.querySelector('#overlap2').style.display='flex'; // section
            $("#overlap2 > .overlap_subpage:eq(0)").css("display","flex"); // div in section
            if(item) {slideModule.nav_reset(2);} // remove active class from nav
         } else if(title == "boosting") { // first subpage
            document.querySelector('#overlap2').style.display='flex'; // section
            $("#overlap2 > .overlap_subpage:eq(1)").css("display","flex"); // div in section
         } else if(title == "coaching") { // first subpage
            document.querySelector('#overlap2').style.display='flex'; // section
            $("#overlap2 > .overlap_subpage:eq(2)").css("display","flex"); // div in section
         } else if(title == "gallery") { // first subpage
            document.querySelector('#overlap2').style.display='flex'; // section
            $("#overlap2 > .overlap_subpage:eq(3)").css("display","flex"); // div in section
         }
         /***** /overlap 2 - page editor *****/
         else if(title == "Users") {document.querySelector('#overlap3').style.display='flex';}
         else if(title == "Customers") {document.querySelector('#overlap4').style.display='flex';}
         else if(title == "Upload") {document.querySelector('#overlap5').style.display='flex';}
         else if(title == "Soon") {document.querySelector('#overlap6').style.display='flex';}
      }

      const nav_li_active = function(nav_li_jq, nav_li_js,nav_ul_li_a) {
         if(nav_li_jq != undefined && nav_li_js != undefined) {
            nav_li_jq.parent().toggleClass('active__li');

            var active__li = document.querySelectorAll("li > ul > li.active__li");
            if(active__li.length >= 2) {
               let previous__active__li = nav_li_js.parentElement;

               var active__li__remove = document.querySelectorAll('li > ul > li.active__li'), i;
               for (i = 0; i < active__li__remove.length; ++i) {
                  active__li__remove[i].classList.remove("active__li");
               }
               previous__active__li.classList.add("active__li");
            }
         } else if(nav_ul_li_a != undefined) {
            if(nav_ul_li_a.parent().children('ul').css('display') != "block") {
               $("nav > ul > li > ul").slideUp(250);
               $("nav > ul > li > ul > li").removeClass("active__li");
            }
            $("nav > ul > li").css("background", "#383B42");
            $("nav > ul > li").removeClass("active__li");
            nav_ul_li_a.parent().addClass("active__li");
            nav_ul_li_a.parent().css("background", "#2c2f34");
            nav_ul_li_a.parent().children('ul').slideDown(250);
         }
      }

      const sub_nav_li = function(sub_nav_li) {
         sub_nav_li.css("background","#454952");
         $("nav > ul > li > ul").slideUp(250);
         $("nav > ul > li").css("background", "#383B42");
         $("nav > ul > li").removeClass("active__li");
      }

      return  {
         close_overlap : close_overlap, // reset
         nav_reset : nav_reset, // reset
         bg_color : bg_color, // change body color
         nav_li_onclick : nav_li_onclick, // change display overlap on block, overwrite title
         active_li : nav_li_active, // add/remove class active_li for main nav
         sub_nav_li : sub_nav_li // add/remove class active_li for sub nav
      }
   })();

   // change display overlap on block, overwrite title
   $('body').on("click", "nav ul li a", function() {
      let title = $(this).data('title');
      slideModule.nav_li_onclick(title, undefined);
   });
   $('body').on("click", ".statement__content__item a", function() {
      let title = $(this).data('title');
      let item = true;
      slideModule.nav_li_onclick(title, item);
   });

   // add class active__li
   var nav_li = document.querySelectorAll('nav > ul a'), i;
   for (i = 0; i < nav_li.length; ++i) {
      nav_li[i].addEventListener("click", function() {
         let nav_li_jq = $(this); // jquery object
         let nav_li_js = this; // DOM
         slideModule.active_li(nav_li_jq,nav_li_js,undefined);
      });
   }

   // nav css
   $('body').on("click", "nav > ul > li > a", function() {
      let nav_ul_li_a = $(this);
      slideModule.active_li(undefined,undefined,nav_ul_li_a);
   });
   $('body').on("click", ".sub--nav > ul > li", function() {
      let sub_nav_li = $(this);
      slideModule.sub_nav_li(sub_nav_li);
   });

   //change body color
   var bg_flag=true;
   $("body").on("click", "#toggle-bg", function() {
      if(bg_flag) {
         slideModule.bg_color(bg_flag);
         bg_flag=false;
      } else {
         slideModule.bg_color(bg_flag);
         bg_flag=true;
      }
   });



   var edit__page__flag=true; // first child li
   var edit__page_li_flag=true; // nth-child li
   $("body").on("click", ".edit__page__item", function() {
      if(edit__page__flag) {
         $(this).children('ul').slideToggle(250);
         $(this).toggleClass('page__item__active');
      }
      edit__page__flag=true;
   });
   $("body").on("click", ".edit__page__item > ul > li", function() {
      if(edit__page_li_flag) {
        $(this).children('ul').slideToggle(250);
      }
      edit__page_li_flag=true;
      edit__page__flag=false;
   });

   $("body").on("click", ".edit__page__item > ul > li > ul > li", function() {
      $(this).parent().slideDown(250);
      edit__page_li_flag=false;
   });








   /***** RWD *****/
   if(window.innerWidth <= 600) {
      document.querySelector(".title > h2").innerHTML = "";
      document.querySelector("header h1 a").innerHTML = "EB";
      document.querySelector("header h1 a").style="width:48px;height:60px;display:block";

      document.querySelector("nav").style="overflow-x:visible";
      let nav_li = document.querySelectorAll("nav > ul > li > a");
      for(let i=0;i<nav_li.length;i++) {
         nav_li[i].innerHTML = "";
         nav_li[i].style="height:36px";
      }

      let sub__nav = document.querySelectorAll("li > .sub--nav");
      for(let i=0;i<sub__nav.length;i++) {
         sub__nav[i].style="margin-right:-100px;padding-right:10px;width:100px;";
      }

      let rwd_close = document.querySelectorAll("nav > ul > li > ul");
      for(let i=0;i<rwd_close.length;i++) {
         rwd_close[i].classList.add("rwd_close");
      }
   }
   window.onresize = function(event) {
      if(window.innerWidth <= 600) {
         document.querySelector(".title > h2").innerHTML = "";
         document.querySelector("header h1 a").innerHTML = "EB";
         document.querySelector("header h1 a").style="width:48px;height:60px;display:block";


         document.querySelector("nav").style="overflow-x:visible";
         let nav_li = document.querySelectorAll("nav > ul > li > a");
         for(let i=0;i<nav_li.length;i++) {
            nav_li[i].innerHTML = "";
            nav_li[i].style="height:36px";
         }

         let sub__nav = document.querySelectorAll("li > .sub--nav");
         for(let i=0;i<sub__nav.length;i++) {
            sub__nav[i].style="margin-right:-100px;padding-right:10px;width:100px;";
         }

         let rwd_close = document.querySelectorAll("nav > ul > li > ul");
         for(let i=0;i<rwd_close.length;i++) {
            rwd_close[i].classList.add("rwd_close");
         }
      } else {
         document.querySelector("header h1 a").innerHTML = "Eloboost";
         document.querySelector("header h1 a").style="width:100%;height:auto;display:inline-block";
         let nav_li = document.querySelectorAll("nav > ul > li > a");

         nav_li[0].innerHTML = "Dashboard";
         nav_li[1].innerHTML = "Pages";
         nav_li[2].innerHTML = "Users";
         nav_li[3].innerHTML = "Customers";
         nav_li[4].innerHTML = "Upload images";
         nav_li[5].innerHTML = "Soon";

         let sub__nav = document.querySelectorAll("li > .sub--nav");
         for(let i=0;i<sub__nav.length;i++) {
            sub__nav[i].style="margin-right:-160px;width:100%;";
         }

         let rwd_close = document.querySelectorAll("nav > ul > li > ul");
         for(let i=0;i<rwd_close.length;i++) {
            rwd_close[i].classList.remove("rwd_close");
         }
      }
   }
   /***** /RWD *****/

   $('body').on("click", ".larg div h3", function() {
      if ($(this).children('span').hasClass('close')) {
         $(this).children('span').removeClass('close');
      }
      else {
         $(this).children('span').addClass('close');
      }
      $(this).parent().children('p').slideToggle(250);
   });
});


/***** File upload, gallery *****/
var images = document.querySelectorAll('.box__gallery');
for (let i=0;i<images.length;i++) {
   images[i].addEventListener("click", function() {

      let l_arrow = document.querySelector(".arrow-left"); // left arrow
      let r_arrow = document.querySelector(".arrow-right"); // right arrow

      if (l_arrow == undefined && r_arrow == undefined) {
         this.firstChild.classList.add("active--img"); // can be called only once
      }

      let box__gallery = document.querySelector('.active--img');  // active img

      // if classes don't exist create arrows
      if(l_arrow == undefined && r_arrow == undefined) {
         this.appendChild(document.createElement("p")).classList.add("arrow-left");
         this.appendChild(document.createElement("p")).classList.add("arrow-right");
         document.querySelector(".arrow-left").innerHTML = "&#10094;";
         document.querySelector(".arrow-right").innerHTML = "&#10095;";

         // auto height for arrows
         let img__height = document.querySelector(".active--img").clientHeight;
         document.querySelector(".arrow-left").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;animation:arrow-animation 1s";
         document.querySelector(".arrow-right").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;animation:arrow-animation 1s";
         change_img();
      }

      // background
      document.querySelector('.pop').style="opacity:1;z-index:2;transition:1s";
   });
}

const galleryModule = (function () {
   const arrows = function(direction) {
      let active_box = document.querySelector(".active--img").parentElement; // box(container) with active image
      document.querySelector(".active--img").classList.remove("active--img"); // remove class active--img

      if(direction == "left") { // left arrow
         if(document.querySelector(".gallery").firstChild == active_box)
            document.querySelector(".gallery").lastChild.firstChild.classList.add("active--img");
         else
            active_box.previousSibling.firstChild.classList.add("active--img"); // select previous box(container) and add class active--img
      } else {// left arrow
         if(document.querySelector(".gallery").lastChild == active_box)
            active_box = document.querySelector(".gallery").firstChild.firstChild.classList.add("active--img");
         else
            active_box.nextSibling.firstChild.classList.add("active--img"); // select next box(container) and add class active--img
      }

      // auto height for arrows
      let img__height = document.querySelector(".active--img").clientHeight;
      document.querySelector(".arrow-left").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;transition:0s";
      document.querySelector(".arrow-right").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;transition:0s";
   }

   return {arrows : arrows}
})();

function change_img() {
   document.querySelector(".arrow-left").addEventListener("click", function() {
      galleryModule.arrows("left");
   });
   document.querySelector(".arrow-right").addEventListener("click", function() {
      galleryModule.arrows("right");
   });
}

document.querySelector('.pop').addEventListener("click", function() {
   for (i=0; i<images.length;i++) {
      images[i].firstChild.classList.remove("active--img");
      let arrows = document.querySelector("p");
      if(arrows != undefined) {arrows.remove();}
   }
   this.style="opacity:0;z-index:-1;transition:1s";
});

/***** /File upload, gallery *****/
