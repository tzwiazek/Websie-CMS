
const PriceListModule = (function () {
   /***** settings/reset *****/
      /***** Tabs *****/
      const tabs_arr = ["division","perwin","placement","mastery"];
      const clear_tabs = function() {
         for(let i=0;i<=3;i++) {
            // remove class active
            document.querySelector(".tab--panel__title > ul > li:nth-child("+(i+1)+") > label").classList.remove("active__label");
            // close all tabs
            document.querySelector("#tab__content__"+tabs_arr[i]).style = "transition:opacity 1s ease-out;opacity:0;display:none;";
         }
      }
      const active_tab = function(num) {
         document.querySelector(".tab--panel__title > ul > li:nth-child("+(num+1)+") > label").classList.add("active__label");
         document.querySelector("#tab__content__"+tabs_arr[num]).style.transition = "opacity 1s ease-out";
         document.querySelector("#tab__content__"+tabs_arr[num]).style.display = "block";
         setTimeout(function() {document.querySelector("#tab__content__"+tabs_arr[num]).style.opacity = 1;}, 10);
      }
      /***** /Tabs *****/
   /***** /settings/reset *****/

   return {
      clear_tabs : clear_tabs, // reset tabs (hide everything)
      active_tab : active_tab // add class active__label, change display to "block" and opacity to "1"
   }
})();

/***** Tabs on click *****/
document.querySelector("#division").onclick = function() {
   PriceListModule.clear_tabs();
   PriceListModule.active_tab(0);
};
document.querySelector("#perwin").onclick = function() {
   PriceListModule.clear_tabs();
   PriceListModule.active_tab(1);
};
document.querySelector("#placement").onclick = function() {
   PriceListModule.clear_tabs();
   PriceListModule.active_tab(2);
};
document.querySelector("#mastery").onclick = function() {
   PriceListModule.clear_tabs();
   PriceListModule.active_tab(3);
};
/***** /Tabs on click *****/

/***** JS for boosting subpage *****/
// number of visible items in the list
document.querySelector('#champion_mastery').onfocus = function() {this.size = "8";}
document.querySelector('#champion_mastery').onblur = function() {this.size = "none";}

const capitalize_first_letter = (string) => {
   return string.charAt(0).toUpperCase() + string.slice(1);
}

var service = 0; // reset, default tab
var total_cost = 0; // global cost
function count(service) {
   /*******************************************************/
   /******************* Division boost *******************/
   /******************************************************/
   // current/desired tier/lvl selected by a user
   let c_tier = document.querySelector("#c_tier").options[document.querySelector("#c_tier").selectedIndex].value;
   let c_lvl = document.querySelector("#c_lvl").options[document.querySelector("#c_lvl").selectedIndex].value;
   let d_tier = document.querySelector("#d_tier").options[document.querySelector("#d_tier").selectedIndex].value;
   let d_lvl = document.querySelector("#d_lvl").options[document.querySelector("#d_lvl").selectedIndex].value;

   let current_tier = 0;
   let desired_tier = 0;
   let div_array = []; // array for div(idions) -> 5x5+1
   for(let i=1;i<=25;i++) {div_array.push(i);} // fill array
   const division_image = ['i', 'ii', 'iii', 'iv', 'v']; // array for images
   division_image.reverse();

   let c_div_num = 0; // current division as number (bronze V -> diament I <=> 1 -> 25)
   const division = ['bronze', 'silver', 'gold', 'platinum', 'diamond']; // division names
   let tier, level, div_img; // temporary variables for loop

   for(let j=0;j<2;j++) {
      // first call is for current rank, second for desired rank
      j==0?(tier=c_tier,level=c_lvl,div_img="c_div_img"):(tier=d_tier,level=d_lvl,div_img="d_div_img");

      for(let i=0;i<=4;i++) {
         if(tier == division[i]) {
            c_div_num = i;
            for(let i=1;i<6;i++) {
               if(level == i) {
                  j==0?current_tier=div_array[c_div_num*5+i-1]:desired_tier=div_array[c_div_num*5+i-1];
               }
            }
         }
         for(let i=1;i<6;i++) {
            if(level == i) {
               document.querySelector("#"+div_img).src="../img/divisions/"+division[c_div_num]+"_"+division_image[i-1]+".png";
            }
         }
      }
   }

   // twenty-sixth division
   if(d_tier == "master") {
      desired_tier = 26;
      document.querySelector("#"+div_img).src="../img/divisions/master.png";
   }

   //price
   var price = 4; // default € per div
   var silver = 8; // € per div in silver
   var gold = 12; // € per div in gold
   var platinum = 18; // € per div in plat
   if(current_tier<desired_tier) {
      document.querySelector('#d_lvl').style.display = 'block';

      // bronze to bronze
      if(current_tier <= 5 && desired_tier <= 5) {
         total_cost=(desired_tier-current_tier)*price;
      }
      // bronze to silver
      else if(current_tier <= 5 && (desired_tier > 5 && desired_tier <= 10)) {
         total_cost=((5-current_tier)*price)+(desired_tier-5)*silver;
      }
      // bronze to gold
      else if(current_tier <= 5 && (desired_tier > 10 && desired_tier <= 15)) {
         total_cost=((5-current_tier)*price+5*silver+(desired_tier-10)*gold);
      }
      // bronze to platinum
      else if(current_tier <= 5 && (desired_tier > 15 && desired_tier <= 20)) {
         total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(desired_tier-15)*platinum);
      }
      // bronze to diamond V
      else if(current_tier <= 5 && (desired_tier > 20 && desired_tier < 22)) {
         total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+30);
      }
         // bronze to diamond IV
         else if(current_tier <= 5 && desired_tier == 22) {
            total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+60);
         }
         // bronze to diamond III
         else if(current_tier <= 5 && desired_tier == 23) {
            total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+100);
         }
         // bronze to diamond II
         else if(current_tier <= 5 && desired_tier == 24) {
            total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+150);
         }
         // bronze to diamond I
         else if(current_tier <= 5 && desired_tier == 25) {
            total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+210);
         }
         // bronze to Master
         else if(current_tier <= 5 && desired_tier == 26) {
            total_cost=((5-current_tier)*price+(5*silver)+(5*gold)+(5*platinum)+310);
            document.querySelector('#d_lvl').style.display = 'none';
         }
      // silver to silver
      else if((current_tier > 5 && current_tier <= 10) && (desired_tier > 5 && desired_tier <= 10)) {
         total_cost=(desired_tier-current_tier)*silver;
      }
      // silver to gold
      else if((current_tier > 5 && current_tier <= 10) && (desired_tier > 10 && desired_tier <= 15)) {
         total_cost=(10-current_tier)*silver+(desired_tier-10)*gold;
      }
      // silver to platinum
      else if((current_tier > 5 && current_tier <= 10) && (desired_tier > 15 && desired_tier <= 20)) {
         total_cost=(10-current_tier)*silver+(5*gold)+(desired_tier-15)*platinum;
      }
      // silver to diamond IV
      else if((current_tier > 5 && current_tier <= 10) && (desired_tier > 20 && desired_tier < 22)) {
         total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+30;
      }
         // silver to diamond IV
         else if((current_tier > 5 && current_tier <= 10) && desired_tier == 22) {
            total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+60;
         }
         // silver to diamond III
         else if((current_tier > 5 && current_tier <= 10) && desired_tier == 23) {
            total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+100;
         }
         // silver to diamond II
         else if((current_tier > 5 && current_tier <= 10) && desired_tier == 24) {
            total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+150;
         }
         // silver to diamond I
         else if((current_tier > 5 && current_tier <= 10) && desired_tier == 25) {
            total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+210;
         }
         // silver to Master
         else if((current_tier > 5 && current_tier <= 10) && desired_tier == 26) {
            total_cost=(10-current_tier)*silver+(5*gold)+(5*platinum)+310;
            document.querySelector('#d_lvl').style.display = 'none';
         }
      // gold to gold
      else if((current_tier > 10 && current_tier <= 15) && (desired_tier > 10 && desired_tier <= 15)) {
         total_cost=(desired_tier-current_tier)*gold;
      }
         // gold to platinum
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier >= 16 && desired_tier < 21)) {
            total_cost=(15-current_tier)*gold+(desired_tier-15)*platinum;
         }
         // gold to diamond V
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 21)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+30;
         }
         // gold to diamond IV
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 22)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+60;
         }
         // gold to diamond III
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 23)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+100;
         }
         // gold to diamond II
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 24)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+150;
         }
         // gold to diamond I
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 25)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+210;
         }
         // gold to Master
         else if((current_tier > 10 && current_tier <= 15) && (desired_tier == 26)) {
            total_cost=(15-current_tier)*gold+(5*platinum)+310;
            document.querySelector('#d_lvl').style.display = 'none';
         }
      // platinum to platinum
      else if((current_tier > 15 && current_tier <= 20) && (desired_tier > 15 && desired_tier <= 20)) {
         total_cost=(desired_tier-current_tier)*platinum;
      }
         // platinum to diamond V
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 21)) {
            total_cost=((20-current_tier)*platinum+30);
         }
         // platinum to diamond IV
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 22)) {
            total_cost=(20-current_tier)*platinum+60;
         }
         // platinum to diamond III
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 23)) {
            total_cost=(20-current_tier)*platinum+100;
         }
         // platinum to diamond II
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 24)) {
            total_cost=(20-current_tier)*platinum+150;
         }
         // platinum to diamond I
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 25)) {
            total_cost=(20-current_tier)*platinum+210;
         }
         // platinum to Master
         else if((current_tier > 15 && current_tier <= 20) && (desired_tier == 26)) {
            total_cost=(20-current_tier)*platinum+310;
            document.querySelector('#d_lvl').style.display = 'none';
         }
         // diamond to diamond IV
         else if((current_tier > 20 && current_tier <= 25) && (desired_tier > 20 && desired_tier < 23)) {
             total_cost=(desired_tier-current_tier)*30;
         }
         // diamond to diamond III
         else if((current_tier > 20 && current_tier <= 25) && (desired_tier == 23)) {
            total_cost=((desired_tier-current_tier)*30)+10;
         }
         // diamond to diamond II
         else if((current_tier > 20 && current_tier <= 25) && (desired_tier == 24)) {
            total_cost=((desired_tier-current_tier)*30)+30;
         }
         // diamond to diamond I
         else if((current_tier > 20 && current_tier <= 25) && (desired_tier == 25)) {
            total_cost=((desired_tier-current_tier)*30)+60;
         }
            // III to II
            if((current_tier == 23) && (desired_tier == 24)) {
               total_cost=((desired_tier-current_tier)*30)+20;
            }
            // III to I
            if((current_tier == 23) && (desired_tier == 25)) {
               total_cost=((desired_tier-current_tier)*30)+50;
            }
            // II to I
            if((current_tier == 24) && (desired_tier == 25)) {
               total_cost=((desired_tier-current_tier)*30)+30;
            }
         // diamond to Master
         else if((current_tier > 20 && current_tier <= 25) && (desired_tier == 26)) {
            total_cost=(desired_tier-current_tier)*30+70;
            document.querySelector('#d_lvl').style.display = 'none';
         }
         /* II to master */ if((current_tier == 24) && (desired_tier == 26)) {total_cost=160;}
         /* III to master */ if((current_tier == 23) && (desired_tier == 26)) {total_cost=210;}
         /* IV to master */ if((current_tier == 22) && (desired_tier == 26)) {total_cost=250;}
         /* V to master */ if((current_tier == 21) && (desired_tier == 26)) {total_cost=280;}

      // Roman numbers (current division)
      if(c_lvl == 1) {c_lvl = "V";}
      else if(c_lvl == 2) {c_lvl = "IV";}
      else if(c_lvl == 3) {c_lvl = "III";}
      else if(c_lvl == 4) {c_lvl = "II";}
      else if(c_lvl == 5) {c_lvl = "I";}

      // Roman numbers (desired division)
      if(d_lvl == 1) {d_lvl = "V";}
      else if(d_lvl == 2) {d_lvl = "IV";}
      else if(d_lvl == 3) {d_lvl = "III";}
      else if(d_lvl == 4) {d_lvl = "II";}
      else if(d_lvl == 5) {d_lvl = "I";}

      // If option "duo" is checked total cost = 150% normal price
      if(document.querySelector('#duo').checked) {
          total_cost = Math.round((total_cost*0.5)+total_cost);
      }

      // Statement in order tab
      document.querySelector('#your_div').innerHTML = "Division Boost: " + capitalize_first_letter(c_tier) + " " + c_lvl + " -> " + capitalize_first_letter(d_tier) + " " + d_lvl;

      // Price in order tab
      document.querySelector('#total_cost').innerHTML = "Total Cost: " + total_cost + "€";
   }
   else {
      // if the desired division is lower than the current dividion
      document.querySelector('#your_div').innerHTML = "Division Boost: ";
      document.querySelector('#total_cost').innerHTML = "Total Cost: It seems your current and desired league are messed up check it one more time";
   }

   /**********************************************************************/
   /******************* per win and placement matches *******************/
   /********************************************************************/
   if(service == 1) {
      // per win boost
      var service_array = ["range_slider_perwin", "matches_perwin", "current_div", "perwin_div_img", "duo_perwin", "total_cost_perwin"];
   }

   if(service == 2) {
      // placement matches
      var service_array = ["placement_range_slider", "matches", "last_season_div", "p_div_img", "duo_placement", "total_cost_placement"];
   }

   if(service == 1 || service == 2) {
      // input type range
      let local_range_slider = document.querySelector("#"+service_array[0]).value;
      document.getElementById(service_array[1]).innerHTML = local_range_slider;

      // current/last season rank
      let _current_div = document.querySelector("#"+service_array[2]);
      let current_div = _current_div.options[_current_div.selectedIndex].value;

      //img
      document.querySelector("#"+service_array[3]).src="../img/divisions/"+current_div+"_i.png";

      if(service == 1) {
         document.querySelector("#per_win_lvl").style.display = 'none';
         price = 1;
         if(current_div == "silver"){price=2;}
         else if(current_div == "gold"){price=3;}
         else if(current_div == "platinum"){price=4;}
         else if(current_div == "diamond"){
            // option only for diamond tier
            document.querySelector("#per_win_lvl").style.display = 'block';
            let _per_win_lvl = document.querySelector("#per_win_lvl");
            let per_win_lvl = _per_win_lvl.options[_per_win_lvl.selectedIndex].value;
               if(per_win_lvl == 1){price=6;}
               else if(per_win_lvl == 2){price=8;}
               else if(per_win_lvl == 3){price=10;}
               else if(per_win_lvl == 4){price=12;}
               else if(per_win_lvl == 5){price=20;}
         }
         else if(current_div == "master") {price=20;}
      }
      if(service == 2) {
         price = 2;
         if(current_div == "gold") {price = 3;}
         else if(current_div == "platinum") {price = 4;}
         else if(current_div == "diamond") { price = 5;}
      }

      // If option "duo" is checked total cost = 150% normal price
      total_cost = local_range_slider*price;
      if(document.querySelector("#"+service_array[4]).checked) {
         total_cost = Math.round((total_cost*0.5)+total_cost);
      }
      // total cost
      document.querySelector("#"+service_array[5]).innerHTML = "Total Cost: "+total_cost+"€";
   }

   /*********************************************************/
   /******************* mastery champion *******************/
   /*******************************************************/
   if(service == 3) {
      let a = document.querySelector("#champion_mastery");
      let champion_mastery = a.options[a.selectedIndex].value;

      let b = document.querySelector("#current_champion_mastery");
      let current_champion_mastery = b.options[b.selectedIndex].value;

      let c = document.querySelector("#desired_champion_mastery");
      let desired_champion_mastery = c.options[c.selectedIndex].value;


      document.querySelector('#champion_mastery_img').style.backgroundImage="url(../img/mastery/"+champion_mastery+".png)";// change the champion picture
      document.querySelector('#current_mastery_lvl').style.backgroundImage="url(../img/mastery/"+current_champion_mastery+".png)"; // change the current mastery picture
      if(desired_champion_mastery<=current_champion_mastery) {
         current_champion_mastery++;
         document.querySelector('#desired_mastery_lvl').style.backgroundImage="url(../img/mastery/"+current_champion_mastery+".png)";
         document.querySelector('#desired_champion_mastery').selectedIndex=current_champion_mastery-1;
         current_champion_mastery=current_champion_mastery-1;
         desired_champion_mastery=current_champion_mastery+1; // set the next picture
      } else if (desired_champion_mastery>current_champion_mastery) {
         document.querySelector('#desired_mastery_lvl').style.backgroundImage="url(../img/mastery/"+desired_champion_mastery+".png)";
         document.querySelector('#desired_champion_mastery').selectedIndex=desired_champion_mastery-1;
      }

      const mastery_array = [0,1,1,2,3,4,6,8]; // price (tier1 -> tier2 <==> 1€, tier6 -> tier7 <==> 8€)
      let total_cost = 0; // reset
      for(let i=current_champion_mastery;i<desired_champion_mastery;i++) {
         i++;
         total_cost += mastery_array[i];
         i--;
      }
      // If option "duo" is checked total cost = 150% normal price
      if(document.querySelector("#duo_mastery").checked) {
         total_cost = Math.round((total_cost*0.5)+total_cost);
      }
      // total cost
      document.querySelector('total_cost_mastery').innerHTML = "Total Cost: "+total_cost+"€";
   }
}
/***** /JS for boosting subpage *****/
