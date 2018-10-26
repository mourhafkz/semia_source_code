<?php

function martin_porter_setmming($item,$item_id,$context) {
  global $conn;
  $result="";

  $patterns="/ate$|ize$|ise$|ates$|izes$|ises$|ical$|ble$|tional$|ent$|ous$|al$|ive$|ful$|ish$|ance$|ances$|ic$|ics$|izer$|izers$|tion$|tions$|ence$|ences$|logy$|logies$|ism$|isms$|actor$|actors$|ness$|nesses$/i";


/*  //mapped
  $patterns="
        /
        //verbs
        ate$|ize$|ise$|
        ates$|izes$|ises$|
        //adj
        ical$|ble$|tional$|
        ent$|ous$|al$|ive$|ful$|ish$
        //nouns
        ance$|ances$|
        ic$|ics$|
        izer$|izers$|
        tion$|tions$|
        ence$|ences$|
        logy$|logies$|
        ism$|isms$|
        actor$|actors$|
        ness$|nesses$
        /i";
*/

  $regex= preg_match($patterns,$item, $is_pattern);

  if (!empty($is_pattern[0])) {

  switch ($is_pattern[0]) {

                // verbs=========================================
                case 'ate':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ate -Porter";
                  break;
                case 'ize':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ize -Porter";
                  break;
                case 'ise':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ise -Porter";
                  break;
                case 'ates':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ate(s) -Porter";
                  break;
                case 'izes':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ize(s) -Porter";
                  break;
                case 'ises':
                    $direct_gtag_value="VP";
                    $direct_spectag_value="-ise(s) -Porter";
                  break;



                //adjectives=====================================
                case 'ical':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ical -Porter";
                  break;
                case 'ble':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ble -Porter";
                  break;
                case 'tional':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-tional -Porter";
                  break;
                case 'ent':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ent -Porter";
                  break;
                case 'ous':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ous -Porter";
                  break;
                case 'al':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-al -Porter";
                  break;
                case 'ive':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ive -Porter";
                  break;
                case 'ful':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ful -Porter";
                  break;
                case 'ish':
                    $direct_gtag_value="AD";
                    $direct_spectag_value="-ish -Porter";
                  break;

                //nouns==========================================
                case 'ic':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ic -Porter";
                  break;
                case 'ics':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ic pl -Porter";
                  break;
                case 'izer':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-izer -Porter";
                  break;
                case 'izers':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-izer pl -Porter";
                  break;
                case 'tion':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-tion -Porter";
                  break;
                case 'tions':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-tion pl -Porter";
                  break;
                case 'ance':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ance -Porter";
                  break;
                case 'ances':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ance pl -Porter";
                  break;
                case 'ence':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ence -Porter";
                  break;
                case 'ences':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ence pl -Porter";
                  break;
                case 'ism':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ism -Porter";
                  break;
                case 'isms':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ism pl -Porter";
                  break;
                case 'logy':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-logy -Porter";
                  break;
                case 'logies':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-logy pl -Porter";
                  break;
                case 'actor':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-actor -Porter";
                  break;
                case 'actors':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-actor pl -Porter";
                  break;
                case 'ness':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ness -Porter";
                  break;
                case 'nesses':
                    $direct_gtag_value="NP";
                    $direct_spectag_value="-ness pl -Porter";
                  break;


        }
  // format the result
  $direct_spectag_field=$item_id;
  $direct_gtag_field=$item_id;
  $result= $direct_gtag_field."|".$direct_gtag_value."|".$direct_spectag_field."|".$direct_spectag_value."|"."|"."|"."|";

  //______DB SAVE
  update_via_ai("groupTag",$direct_gtag_value,$item_id);
  update_via_ai("specTag",$direct_spectag_value,$item_id);
  //_____________

  } else {
  // not in the patterns
  $result="0";
  }
  //echo either result
  return $result;

}













 ?>