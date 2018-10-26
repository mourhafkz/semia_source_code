<?php
include("../bin/const.php");
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 $output = '';
 if(isset($_POST["new_val"]))
 {
       if (isset($_POST["el_id"]))
       {
            if($_POST["new_val"] != '')
            {
              $value=$_POST["new_val"];
                  if($_POST["el_id"] != '')
                  {
                        $raw_id=$_POST["el_id"];
                        $ex_id=explode( '-', $raw_id );
                        $id=$ex_id[0];
                        $sql = "UPDATE temp SET groupHead='".$value."' WHERE id='".$id."'";
                        if ($conn->query($sql) === TRUE) {
                                //db confirmation
                                  $conn->close();
                               // $output .= 'Updated the value';
//                                $output .= $value;
                        } else {
                                $output= "Error: " . $sql . "<br>" . $conn->error;
                        }
                        // if it's a group head it goes to relations
                        if ($value === "Yes") {
//extract consts
                                $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                $sql_select = "SELECT * FROM temp WHERE id='".$id."'";

                                if ($query= $conn->query($sql_select)) {
                                      $conn->close();

                                    while ($row = $query->fetch_assoc()) {
                                           $element=$row['raw_element'];
                                           $id=$row['id'];
                                           $gtag=$row['groupTag'];
                                           }
                                               $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                              $sql_insert =" INSERT INTO temp_relations (id, relation_source , rel_src_gtag) VALUES ('".$id."','".$element."', '".$gtag."') ; ";

                                              if ($conn->query($sql_insert) === TRUE) {
                                                      //db confirmation
                                                      $output .= 'Updated the value';
                                                      $output .= $sql_insert;
                                              } else {
                                                      $output= "Error: " . $sql_insert . "<br>" . $conn->error;
                                              }
                                        //db confirmation
                                        //$output .= 'Updated the value';
                                } else {
                                             // $row = $query->fetch_assoc();
                                             // $output.= $sql_insert;
                                             // print_r( $row);//['id'];
                                        $output.= "Error: " . $sql_insert . "<br>" . $conn->error;
                                }



                        } else {


                               $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                $sql_select = "SELECT * FROM temp WHERE id='".$id."'";

                                if ($query= $conn->query($sql_select)) {
                                      $conn->close();

                                    while ($row = $query->fetch_assoc()) {
                                           $id=$row['id'];
                                          }
                                               $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                              $sql_insert =" SELECT * FROM temp_relations WHERE id ='".$id."'";

                                              $conn->query($sql_insert);
                                              if ($conn->affected_rows === 1){
                                                $conn->close();
                                              $sql_delete ="DELETE FROM temp_relations WHERE id = '".$id."'";
                                               $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

                                                         if ($query= $conn->query($sql_delete)) {
                                                               $conn->close();
                                                               $output.="Deleted reference." ;
                                                              } else {
                                                                 $output.= "Error: " . $sql_insert . "<br>" . $conn->error;
                                                                }


                                              } else {

                                                }

                                                      //db confirmation
                                            //          $output .= 'Updated the value';
                                              //        $output .= $sql_insert;

                                        //db confirmation
                                        //$output .= 'Updated the value';
                                } else {
                                             // $row = $query->fetch_assoc();
                                             // $output.= $sql_insert;
                                             // print_r( $row);//['id'];
                                        $output.= "Error: " . $sql_insert . "<br>" . $conn->error;
                                }
                        }


                  echo $output;
                  }
                  else
                  {
                   //el_id empty
                  }
            }
            else
            {
              //newval empty
            }
            //feed back

       }

}


 ?>