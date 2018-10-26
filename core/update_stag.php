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
                        $sql = "UPDATE temp SET specTag='".$value."' WHERE id=".$id;
                        if ($conn->query($sql) === TRUE) {

                                //db confirmation
                                //$output .= 'Updated the value';
                                                        // look for value in spectags

                        } else {
                                $output= "Error: " . $sql . "<br>" . $conn->error;
                        }
                   //if there do nothing
                  //if not add it
                  $conn->close();
                  $conn->connect("localhost", "1000815", "kissmefreearea", "1000815");
                  $sql_find = "SELECT * FROM spectags WHERE specTag='".$value."'";
                  if ($query= $conn->query($sql_find)){
                    //echo "success";
                  } else {
                      //echo "Error: " . $sql_find . "<br>" . $conn->error;
                  };
                   if ($conn->affected_rows == 0) {
                  $conn->close();
                  $conn->connect("localhost", "1000815", "kissmefreearea", "1000815");
                  $sql_insert = "INSERT INTO spectags (specTag) VALUES ('$value') ; ";
                     if ($query= $conn->query($sql_insert)) {
                                      $conn->close();
                     }

                   } else {
                   //echo "found";
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