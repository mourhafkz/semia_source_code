<?php
$data = array(array(1,3,5,7,9,11,13,15),array(1,3,5,7,9,11,13,15),array(1,3,5,7,9,11,13,15));
$output="";
 if(isset($_POST["valu"]))
 {
       if (isset($_POST["valu"]))
       {
            if($_POST["valu"] != '')
            {
                  $maxsum=$_POST["valu"];
                 $solutions=bestsum($data,$maxsum);
                 $comb="";
                 foreach ($solutions as $value) {
                         $comb=$comb." ".$value;
                    }
                    $output.= "The nearest solution to ".$maxsum." is the sum of the following :<br/>".$comb;

              }
      

       }

 }


 echo $output;


function bestsum($data,$maxsum)
{
$res = array_fill(0, $maxsum + 1, '0');
$res[0] = array();              //base case
foreach($data as $group)
{
 $new_res = $res;               //copy res

  foreach($group as $ele)
  {
    for($i=0;$i<($maxsum-$ele+1);$i++)
    {
        if($res[$i] != 0)
        {
            $ele_index = $i+$ele;
            $new_res[$ele_index] = $res[$i];
            $new_res[$ele_index][] = $ele;
        }
    }
  }

  $res = $new_res;
}

 for($i=$maxsum;$i>0;$i--)
  {
    if($res[$i]!=0)
    {
        return $res[$i];
        break;
    }
  }
return array();
}

?>