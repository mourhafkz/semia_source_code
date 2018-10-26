<?php


function is_verb23_lookup($item,$item_id,$context) {
          /*-------------------STEP 3-1: adverb lookup------------------------*/
$regex="/^\b(".$item.")\b/i";
//regular v23
$contents = file('../lists/r_v_2_3.txt'); // read file as array
foreach($contents as $line) { // iterate over file
preg_match($regex, $line, $match); // pull out key and value into $matches
if (!empty($match)){
//$data[] = $match[0];  // in case we need it

          $direct_gtag_field=$item_id;
          $direct_gtag_value="VP";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="RV2 or 3";
          $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|"."|"."|"."|";
          //______DB SAVE                                     
          update_via_ai("groupTag",$direct_gtag_value,$item_id);
          update_via_ai("specTag",$direct_spectag_value,$item_id);
          //_____________

break;
} else {
     $result="0";
}
  }
return $result;
};

?>


