<?php


function is_conj_lookup($item,$item_id,$context) {
 global $conn;
          /*-------------------STEP 3-1: adverb lookup------------------------*/

$contents = file('../lists/conj.txt'); // read file as array
$regex="/^\b(".$item.")\b/i";
foreach($contents as $line) { // iterate over file
    preg_match($regex, $line, $match); // pull out key and value into $matches
     if (!empty($match)){
          //$data[] = $match[0];  // in case we need it
          $direct_gtag_field=$item_id;
          $direct_gtag_value="NP";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="CONJ";
          $result=$direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|"."|"."|"."|";

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
