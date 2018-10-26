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
                        $sql = "SELECT * FROM grouptags WHERE gTag LIKE '%".$searchTerm."%' ORDER BY gTag ASC";
                        //echo $sql;
                        if ($query=$conn->query($sql)){
                        while ($row = $query->fetch_assoc()) {
                                $data[] = $row['gTag'];
                            }
                            if (empty($data)){
                                  $output.= "<script>
                                  $('[id$=".$id."-gttick]').show();
                                  </script>";
                                  echo   $output;

                              }
                              else
                              {
                             $output.= "<br/>";
                                    foreach ($data as $value) {

                       $output.= "<style>.sugclick { cursor:pointer;}</style>";
                       $output.=  "<a class='sugclick' name=".$id." id='".$id."-click' href='#'>".$value."</a>"." " ;

                          }
                           $output.= "<script>
                                  $('[id$=-click]').click(function(){
                                  var t_input_no = $(this).attr('name');
                                  var t_input_name = t_input_no+ '-gtag';
                                  var value = $(this).text();
                                    //  alert (value);
                                 $('[id$='+t_input_name+']').val(value);
                                 var span =   t_input_no+ '-gtsug';
                                 $('[id$='+span+']').hide();

                               });</script>";

                        echo   $output;

                              }
//echo json_encode($data);
                        };


                          }   //return json data
}


 ?>