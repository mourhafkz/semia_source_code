<?php


$output="";
 if(isset($_POST["pattern"]))
 {
       if (isset($_POST["pattern"]))
       {
            if($_POST["pattern"] != '')
            {
            $regex=$_POST["pattern"];
            $searchin=$_POST["search"];


            $new_string = preg_replace($regex, "<span style='background-color:#cccccc'>$0</span>", $searchin);

            $output.= "<span style='color:red;'>Result:</span> <br/>".$new_string;

            ///$v_ing_pattern="/(am|is|are)\s($item)/i";  ///(am|is|are)\s([\w]{0,})(ing)/i         ".$item."
                            $regex1= preg_match($regex,$searchin, $match);
                          





            }


       }

 }


 echo $output;



 ?>