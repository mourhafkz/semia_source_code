<?php
 $contents = file('nouns.txt'); // read file as array
$data = array();
foreach($contents as $line) { // iterate over file
    preg_match($regex, $line, $match); // pull out key and value into $matches
     if (!empty($match)){
       $data[] = $match[0];
            break;
        };

}
print_r($data);
?>
