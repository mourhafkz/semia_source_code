<?php
include("../bin/const.php");
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 $output = '';
  $output .= " <style>
            #tick {
                text-indent: -1000em;
                width: 16px;
                height: 16px;
                display: inline-block;
                background-image: url(tick.png);
                background-repeat: no-repeat;
                position: relative;
                left: -20px;
                top: 3px;
            }</style>";

 if(isset($_POST['search_val']))
 {
 $searchTerm = $_POST['search_val'];

                          if(isset($_POST['el_id']))   {
                           $id= $_POST['el_id'];

                       // $ex_id=explode( '-', $raw_id );
                       // $id=$ex_id[0];
                        $sql = "SELECT * FROM temp_relations WHERE relation_source LIKE '%".$searchTerm."%' ORDER BY id ASC";
                       // echo $sql;
                        if ($query=$conn->query($sql)){

                        while ($row = $query->fetch_assoc()) {
                                           $rel_source=$row['relation_source'];
                                           $rel_id=$row['id'];
                                           $rel_gtag=$row['rel_src_gtag']; //field

 //                          if (empty($data)){
//                                  $output.= "<script>
//                                  $('[id$=".$id."-constick]').show();
//                                  </script>";
//                           $output;
//
                        if (isset($rel_source) and isset($rel_gtag)){
                          $output.= "<br/>";  
                          if (($rel_source === "S") or ($rel_source === "FRAG")){
                            $output.= "<style>.sugclick { cursor:pointer;}</style>";
                            $output.=  "<a class='sugclick' name=".$id." id='".$id."-click' href='#'>".$rel_source."</a><br />"."  " ;
                          }  else {
                            $output.= "<style>.sugclick { cursor:pointer;}</style>";
                            $output.=  "<a class='sugclick' name=".$id." id='".$id."-click' href='#'>".$rel_id."-".$rel_source."-".$rel_gtag."</a><br />"."  " ;
                                                                     }   }
                       }   }
                           $output.= "<script>
                                  $('[id$=-click]').click(function(){
                                  var t_input_no = $(this).attr('name');
                                  var t_input_name = t_input_no+ '-rel';
                                  var value = $(this).text();
                                    //  alert (value);
                                 $('[id$='+t_input_name+']').val(value);
                                 var span =   t_input_no+ '-csug';
                                 $('[id$='+span+']').hide();           

                               });</script>";

                        echo   $output;

                              }
//echo json_encode($data);
                        };



 ?>