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
                        if ($value  === "No") {
                            $sql = "UPDATE temp SET merge='1' WHERE id='".$id."'";
                        } else (
                            $sql = "UPDATE temp SET merge='0' WHERE id='".$id."'"
                        );

                        if ($conn->query($sql) === TRUE) {
                                //db confirmation
                                  $conn->close();
                               // $output .= 'Updated the value';
//                                $output .= $value;
                        } else {
                                $output= "Error: " . $sql . "<br>" . $conn->error;
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