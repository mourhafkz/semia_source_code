<?php
include("../bin/const.php");
 $connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  $output = '';
 if(isset($_POST["pattern_id"]))
 {
      if($_POST["pattern_id"] != '')
      {
           $sql = "SELECT * FROM element WHERE pattern_id = '".$_POST["pattern_id"]."'";
      }
      else
      {
           $sql = "SELECT * FROM element";
      }
      $result = mysqli_query($connect, $sql);
      while($row = mysqli_fetch_array($result))
      {
           $output .= '<div class="col-md-2"><div  id="corners_tags" >'.$row["element_name"].'</div></div>';
      }
      echo $output;
 }
 ?>