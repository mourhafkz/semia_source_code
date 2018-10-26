<?php
 //load_data.php
 include("../bin/const.php");
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$output = '';
 if(isset($_POST['search_val']))
 {
 $searchTerm = $_POST['search_val'];

                          if(isset($_POST['el_id']))   {
                           $id= $_POST['el_id'];

                        $sql = "SELECT * FROM spectags WHERE specTag LIKE '%".$searchTerm."%' ORDER BY specTag ASC";
                         if ($query=$conn->query($sql)){
                         while ($row = $query->fetch_assoc()) {
                                $data[] = $row['specTag'];
                            }
                            if (empty($data)){
                                  $output.= "<script>
                                  $('[id$=".$id."-sttick]').show();
                                  </script>";
                        echo   $output;

                              }
                              else
                              {
                                $output.= "<br/>";  
                                    foreach ($data as $value) {

                       $output.= "<style>.sugclick { cursor:pointer;}</style>";
                       $output.=  "<span><a class='sugclick' name=".$id." id='".$id."-click' href='#'>".$value."</a>"."</span>  " ;  //this span can be added to add a delete button

                          }
                           $output.= "<script>
                                  $('[id$=-click]').click(function(){
                                  var t_input_no = $(this).attr('name');
                                  var t_input_name = t_input_no+ '-specTag';
                                  var value = $(this).text();
                                    //  alert (value);
                                 $('[id$='+t_input_name+']').val(value);
                                 var span =   t_input_no+ '-stsug';
                                 $('[id$='+span+']').hide();

                               });</script>";

                        echo   $output;

                              }
//echo json_encode($data);
                        };


                          }   //return json data
}

 ?>