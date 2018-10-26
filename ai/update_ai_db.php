<?php




 function update_via_ai($field,$value,$id) {
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 $upadate_sql="UPDATE temp
               SET ".$field."='".$value."'
               WHERE id='".$id."'; ";

 if ($conn->query($upadate_sql) === TRUE) {
              //db confirmation
                $conn->close();
      } else {
              //$output= "Error: " . $sql . "<br>" . $conn->error;
      }

 };








 ?>