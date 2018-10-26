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
              $value=strtoupper($_POST["new_val"]);
                  if($_POST["el_id"] != '')
                  {
                        $raw_id=$_POST["el_id"];
                        $ex_id=explode( '-', $raw_id );
                        $id=$ex_id[0];
                        $sql = "UPDATE temp SET groupTag='".$value."' WHERE id=".$id;
                        if ($conn->query($sql) === TRUE) {

                                //db confirmation
                                $output .= 'Updated the value';
                        } else {
                                $output= "Error: " . $sql . "<br>" . $conn->error;
                        }
                  //echo $output;
                  // look for value in grouptags
                  //if there do nothing
                  //if not add it
                  $conn->close();
                  $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                  $sql_find = "SELECT * FROM grouptags WHERE gTag='".$value."'";
                  if ($query= $conn->query($sql_find)){
                    //echo "success";
                  } else {
                      //echo "Error: " . $sql_find . "<br>" . $conn->error;
                  };
                   if ($conn->affected_rows == 0) {
                  $conn->close();
                  $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                  $sql_insert = "INSERT INTO grouptags (gTag) VALUES ('$value') ; ";
                     if ($query= $conn->query($sql_insert)) {
                                      $conn->close();
                     }

                   } else {
                    //echo "found";
                   }



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



                        }

 ?>