<?php
 //load_data.php
 include("../bin/const.php");
 include("update_ai_db.php");

          include("rule_perfect_or_adj.php");
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$output = '';



 if(isset($_POST["ref_sen"]))
 {
       if (isset($_POST["item_id"]))
       {
            if($_POST["ref_sen"] != '')
            {
              $value=$_POST["ref_sen"];
                  if($_POST["item_id"] != '')
                  {
                  //variables
                  $context=$_POST["ref_sen"];    //original sentence for cues
                  $item_id=$_POST["item_id"];    //id of the word
                  // retrieve item
                  $sql = "SELECT raw_element
                          FROM temp
                          WHERE id ='".$item_id."'";    // add parent id

                  if ($q_res=$conn->query($sql)){
                     while($row = mysqli_fetch_array($q_res))
                      {
                           $item=$row["raw_element"];
                      };
                            /*-------------------STEP 1: ING ------------------------*/
                            $v_ing_pattern="/ing$/i";
                            $regex= preg_match($v_ing_pattern,$item, $is_ing);
                            if (!empty($is_ing)){

                              include("rule_ing.php");
                              $output= ing_rule($item,$item_id,$context);

                            } else {
                                  /*-------------------STEP 2: LY adverb------------------------*/
                                  $v_ing_pattern="/ly$/i";
                                  $regex= preg_match($v_ing_pattern,$item, $is_ly);

                                  if (!empty($is_ly)) {
                                    include("rule_ly_adverb.php");
                                    $output= ly_adverb_rule($item,$item_id,$context);
                                  } else {
                                        /*-------------------STEP 3:  adverb lookup------------------------*/
                                         include("lookup_adv.php");
                                         $check= is_adv_lookup($item,$item_id,$context);
                                         if (!$check=="0") {
                                           $output= $check;
                                         }else{
                                                 /*-------------------STEP 4:  preposition lookup------------------------*/
                                                 include("lookup_prep.php");
                                                 $check= is_prep_lookup($item,$item_id,$context);
                                                 if (!$check=="0") {
                                                   $output= $check;
                                                 }else{
                                                           /*-------------------STEP 4:  preposition lookup------------------------*/
                                                           include("lookup_det.php");
                                                           $check= is_det_lookup($item,$item_id,$context);
                                                           if (!$check=="0") {
                                                             $output= $check;
                                                           }else{

                                                                                       /*-------------------STEP 5:  pronoun lookup------------------------*/
                                                                                       include("lookup_pron.php");
                                                                                       $check= is_pron_lookup($item,$item_id,$context);
                                                                                       if (!$check=="0") {
                                                                                         $output= $check;
                                                                                       }else{
                                                                                                 /*-------------------STEP 6:  conj lookup------------------------*/
                                                                                                 include("lookup_conj.php");
                                                                                                 $check= is_conj_lookup($item,$item_id,$context);
                                                                                                 if (!$check=="0") {
                                                                                                   $output= $check;
                                                                                                 }else{
                                                                                                                 /*-------------------STEP 7:  irregular verb lookup------------------------*/
                                                                                                                 include("lookup_iv.php");
                                                                                                                 $check= is_irverb_lookup($item,$item_id,$context);
                                                                                                                 if (!$check=="0") {
                                                                                                                   $output= $check;
                                                                                                                 }else{

                                                                                                                               /*-------------------STEP 8:  irregular verb 3 lookup------------------------*/
                                                                                                                               include("lookup_iv3.php");
                                                                                                                               $check= is_irverb3_lookup($item,$item_id,$context);
                                                                                                                               if (!$check=="0") {
                                                                                                                                 $output= $check;
                                                                                                                               }else{

                                                                                                                                            /*-------------------STEP 8:  regular verb 2 or 3 lookup------------------------*/
                                                                                                                                           include("lookup_v_2_3.php");
                                                                                                                                           $check= is_verb23_lookup($item,$item_id,$context);
                                                                                                                                           if (!$check=="0") {
                                                                                                                                             $output= $check;
                                                                                                                                           }else{
                                                                                                                                                     /*-------------------STEP 9:  regular verb (s) lookup------------------------*/
                                                                                                                                                     include("lookup_vs.php");
                                                                                                                                                     $check= is_verb_s_lookup($item,$item_id,$context);
                                                                                                                                                     if (!$check=="0") {
                                                                                                                                                       $output= $check;
                                                                                                                                                     }else{
                                                                                                                                                                 /*-------------------STEP 9:  regular verb lookup------------------------*/
                                                                                                                                                                 include("lookup_v.php");
                                                                                                                                                                 $check= is_verb_lookup($item,$item_id,$context);
                                                                                                                                                                 if (!$check=="0") {
                                                                                                                                                                   $output= $check;
                                                                                                                                                                 }else{
                                                                                                                                                                       include("rule_porter_stem.php");
                                                                                                                                                                       $check= martin_porter_setmming($item,$item_id,$context);
                                                                                                                                                                       if (!$check=="0") {
                                                                                                                                                                         $output= $check;
                                                                                                                                                                       }else{
                                                                                                                                                                          $direct_gtag_field=$item_id;
                                                                                                                                                                          $direct_gtag_value="NP";
                                                                                                                                                                          $direct_spectag_field=$item_id;
                                                                                                                                                                          $direct_spectag_value="generic";
                                                                                                                                                                          $output= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|"."|"."|"."|";
                                                                                                                                                                          //______DB SAVE

                                                                                                                                                                          update_via_ai("groupTag",$direct_gtag_value,$item_id);
                                                                                                                                                                          update_via_ai("specTag",$direct_spectag_value,$item_id);
                                                                                                                                                                          //_____________
                                                                                                                                                                       }


                                                                                                                                                                 }
                                                                                                                                                     }
                                                                                                                                           }


                                                                                                                               }


                                                                                                                 }
                                                                                                 }
                                                                    }                   }
                                                 }
                                         }

                                  }

                            }





                            /*-------------------STEP 1: ING VERB------------------------*/
                            echo $output;
                        } else {
                           // $output= "Error: " . $sql . "<br>" . $conn->error;
                        }
                  }
                  else
                  {
                   //item_id empty
                  }
            }
            else
            {
              //ref_sen empty
            }
            //feed back

       }

}






 ?>