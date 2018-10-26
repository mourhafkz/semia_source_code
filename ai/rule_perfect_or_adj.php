<?php

function check_perfect_or_adj($item,$item_id,$context) {
  global $conn;

          /*-------------------STEP 1-1: is it a verb------------------------*/
        $raw_pattern="/\b(has|have|had)\b\s+(([\w]{0,}\s+){0,})?(".$item.")/i";
        $regex= preg_match($raw_pattern,$context, $is_perfect);
        if (!empty($is_perfect)) {
                //finding the related filed id number########################
                $sql_related = "SELECT id
                                 FROM temp
                                 WHERE raw_element ='".$is_perfect[1]."'";    // add parent id
                $conn->close();
                $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if ($q_r_res=$conn->query($sql_related)){
                   while($row = mysqli_fetch_array($q_r_res))
                    {
                         $rel_item=$row["id"];
                    };
                };
                //############################################################

          $direct_gtag_field=$item_id;
          $direct_gtag_value="VP";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="V3";
          $related_gtag_field=$rel_item;
          $related_gtag_value="VP";
          $related_spectag_field=$rel_item;
          $related_spectag_value="AUX-PERFECT TENSE";
          $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|".$related_gtag_field."|".$related_gtag_value."|".$related_spectag_field."|".$related_spectag_value;

          //______DB SAVE
          update_via_ai("groupTag",$direct_gtag_value,$item_id);
          update_via_ai("specTag",$direct_spectag_value,$item_id);
          update_via_ai("groupTag",$related_gtag_value,$rel_item);
          update_via_ai("specTag",$related_spectag_value,$rel_item);
          //_____________


                //info msg echo "'".$item."' is a verb.". " Also found '".$is_verb[1]."' which is an auxiliary verb";
        } else {
        $raw_pattern="/\b(be|was|were|am|is|are)\b\s+(([\w]{0,}\s+){0,})?(".$item.")/i";
        $regex= preg_match($raw_pattern,$context, $is_adj);
                if (!empty($is_adj)) {
                //finding the related filed id number########################
                $sql_related = "SELECT id
                                 FROM temp
                                 WHERE raw_element ='".$is_perfect[1]."'";    // add parent id
                $conn->close();
                $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                if ($q_r_res=$conn->query($sql_related)){
                   while($row = mysqli_fetch_array($q_r_res))
                    {
                         $rel_item=$row["id"];
                    };
                };
                //############################################################

          $direct_gtag_field=$item_id;
          $direct_gtag_value="NP";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="V2";
          $related_gtag_field=$rel_item;
          $related_gtag_value="VP";
          $related_spectag_field=$rel_item;
          $related_spectag_value="AUX";
          $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|".$related_gtag_field."|".$related_gtag_value."|".$related_spectag_field."|".$related_spectag_value;

          //______DB SAVE
          update_via_ai("groupTag",$direct_gtag_value,$item_id);
          update_via_ai("specTag",$direct_spectag_value,$item_id);
          update_via_ai("groupTag",$related_gtag_value,$rel_item);
          update_via_ai("specTag",$related_spectag_value,$rel_item);
          //_____________






        } else {
          /*-------------------STEP 1-1: it is not a verb------------------------*/
          $direct_gtag_field=$item_id;
          $direct_gtag_value="VP";
          $direct_spectag_field=$item_id;
          $direct_spectag_value="V2";
          $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|"."|"."|"."|";
          //______DB SAVE

          update_via_ai("groupTag",$direct_gtag_value,$item_id);
          update_via_ai("specTag",$direct_spectag_value,$item_id);
          //_____________
        }

}
     return $result;
};




 ?>