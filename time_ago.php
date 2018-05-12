<?php
function ago($time)
{
   $periods = array("секунда", "минута", "час", "ден", "седмица", "месец", "година", "десетилетие");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       
       $periods[0]= "секунди";
       $periods[1]= "минути";
       $periods[2]= "часа";
       $periods[3]= "дена";
       $periods[4]= "седмици";
       $periods[5]= "месеца";
       $periods[6]= "години";

   }

   return "преди $difference $periods[$j]  ";
}

?>