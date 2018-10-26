<?php

function ly_adverb_rule($item,$item_id,$context) {
  global $conn;
          /*-------------------STEP 2-1: an LY adverb------------------------*/
          $direct_gtag_field=$item_id;
          $direct_gtag_value="AD";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="ADV";
          $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."||";
          //______DB SAVE                 
          update_via_ai("groupTag",$direct_gtag_value,$item_id);
          update_via_ai("specTag",$direct_spectag_value,$item_id);
          //_____________
        return $result;
};


 ?>