<?php

include("porter.php");
$output="";



            $searchin=$_POST["search"];

            $stem = PorterStemmer::Stem($searchin);

            $output.= $stem;


 echo $output;


     
?>