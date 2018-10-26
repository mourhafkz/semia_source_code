<?php
 //load_data.php
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
                        $id=$_POST["el_id"];
                        $ex_id=explode( '-', $value );
                        if ($ex_id[0]=="S"){
                        $parent_id='1010';
                        } elseif ($ex_id[0]=="F"){
                        $parent_id='1011';
                        } else {
                        $parent_id=$ex_id[0];
                        }
                        $sql = "UPDATE temp SET consTohead='".$value."' , parent_id='".$parent_id."' WHERE id ='".$id."'";    // add parent id
                               $output .= $sql;
                        if ($conn->query($sql) === TRUE) {
                                //db confirmation
                                $output .= 'Updated the value';
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