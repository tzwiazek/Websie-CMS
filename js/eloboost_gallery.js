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
         if(document.querySelector(".gallery").firstChild.nextSibling == active_box) {
            active_box = document.querySelector(".gallery").lastChild.previousSibling;
            active_box.firstChild.classList.add("active--img");
         } else {
            active_box.previousSibling.firstChild.classList.add("active--img"); // select previous box(container) and add class active--img
         }
      } else {// left arrow
         if(document.querySelector(".gallery").lastChild.previousSibling == active_box) {
            active_box = document.querySelector(".gallery").firstChild.nextSibling;
            active_box.firstChild.classList.add("active--img");
         } else {
            active_box.nextSibling.firstChild.classList.add("active--img"); // select next box(container) and add class active--img
         }
      }

      // auto height for arrows
      let img__height = document.querySelector(".active--img").clientHeight;
      document.querySelector(".arrow-left").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;transition:0s";
      document.querySelector(".arrow-right").style="line-height:"+(img__height-8)+"px;height:"+(img__height-8)+"px;transition:0s";
   }

   return {
      arrows : arrows
   }
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
