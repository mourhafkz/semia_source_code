<?php
include("../bin/const.php");
 $dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$syntax_highlighter="#8bb7ed";
 $output = '';


if(isset($_POST["choice"]))
 {
      if($_POST["choice"] != '')
      {
        $choice=$_POST["choice"];
          function categoryParentChildTree($parent = 0 ,$spacing='', $category_tree_array = '') {
                    global $dbConnection;
                    $parent = $dbConnection->real_escape_string($parent);
                    if (!is_array($category_tree_array))
                        $category_tree_array = array();

                    $sqlCategory = "SELECT id, raw_element , parent_id, groupTag, specTag,  merge FROM temp WHERE parent_id = $parent ORDER BY id ASC";
                    if ($resCategory=$dbConnection->query($sqlCategory)) {
                      if ($resCategory->num_rows > 0) {
                        while($rowCategories = $resCategory->fetch_assoc()) {
                            $category_tree_array[] = array("gtag" => $rowCategories['groupTag'], "raw_element" => $spacing . $rowCategories['raw_element'], "parent_id" => $rowCategories['parent_id'],"specTag" => $rowCategories['specTag'],"merge" => $rowCategories['merge']);
                            $category_tree_array = categoryParentChildTree($rowCategories['id'], '', $category_tree_array);
                        }
                    }                                      //"id" => $rowCategories['id'],
                    return $category_tree_array;
                }
                }



                    $categoryList = categoryParentChildTree();

                function makeNested($source) {
                	$nested = array();

                	foreach ( $source as &$s ) {

                		if ((int)$s['parent_id'] === 0 ) {
                			// no parent_id so we put it in the root of the array
                			$nested[] = &$s;
                		}
                		else {
                			$pid = (int)$s['parent_id'] -1; // because counting arrays begins at 0
                			if ( in_array($source[$pid],$source ) ) {
                				// If the parent ID exists in the source array
                				// we add it to the 'children' array of the parent after initializing it.
                				if ( !isset($source[$pid]['children']) ) {
                					$source[$pid]['children'] = array();
                				}

                				$source[$pid]['children'][] = &$s;
                			}
                		}

                    }
                	return $nested;
                }


                $ss= makeNested($categoryList) ;



                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

                function bracketize($array,$choice) {
                    $output = '';
                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

                    foreach($array as $item) {
                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                        if ($item['merge']==0){
                        $output .= '<span id="'.$item['raw_element'].'" class="data" style="color:'.$color.';">(';
                        $output .=  $item['gtag'];
                        $output .= '(';
                        $output .=  $item['raw_element'];
                                        if ($choice==1) {
                                        $output .= "-".$item['specTag'];
                                        };
                        $output .= ')';
                        if(isset($item['children']))
                            $output .= bracketize($item['children'],$choice);
                        $output .= ')</span>';
                        } else {
                        $output .= '<span class="data" style="color:'.$color.';">(';
                        $output .=  $item['raw_element'];
                        if ($choice==1) {
                        $output .= "-".$item['specTag'];
                        };
                        if(isset($item['children']))
                            $output .= bracketize($item['children'],$choice);
                        $output .= ')</span>';

                        }

                    }

                    return $output;
                }



                  function render_list($array) {
                    echo "<pre>".print_r($array)."</pre>" ;
                          $output= '<ul>';
                          foreach ($array as $key => $value) {
                              $output .= '<li>';
                              $output .= $key.':';
                              if (is_array($value)) {
                                render_list($value);

                              }
                              $output .=  $value;
                              $output .= '</li>';
                          }
                          $output .= '</ul>';
                          return $output;
                      }


                      function makeTree($array,$choice,$child) {
                    $output = '';
//                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

                    foreach($array as $item) {
//                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                        if ($item['merge']==0){

                          if ($child==1) {
                           $output .= "<ul>";
                          };
                        $output .= "<li><a href='#'>";
                        $output .=  $item['gtag'];
                        $output .= ' (';
                        if(!empty($item['specTag'])){
                           $output .= $item['specTag'] ." : ";
                          };
                        $output .=  $item['raw_element'];
                        $output .= ')</a>';
                        if(isset($item['children']))
                            $output .= makeTree($item['children'],$choice,1);
                        $output .= '</li>';
                        } else {
                          if ($child==1) {
                           $output .= "<ul>";
                          };
                        $output .= "<li><a href='#'>";
                        $output .=  $item['gtag'];
                              $output .= ' (';
                        if(!empty($item['specTag'])){
                           $output .= $item['specTag'] ." : ";
                          };
                        $output .=  $item['raw_element'];
                        $output .= ')</a>';
                        if(isset($item['children']))
                            $output .= makeTree($item['children'],$choice,1);
                        $output .= '</li></ul>';

                        }

                    }

                    return $output;
                }




                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

                $output = '<div class="tree"><ul><li><a href="#" class="root">ROOT</a><ul>
                                ' . render_list($ss) . '</ul></li></ul></div>|';

                $output .= '<span>(ROOT ' . bracketize($ss,$choice) . ')</span>';


                $output .='<script>

                $(".data").on("dblclick", function(e) {

                    var initial=$(this).children().text();
                    var bef= "<span> (FRAG ";
                    var aft= ")</span>"
                    var new_formation=$(this).before(bef).after(aft);
                });


                $(".data").hover(
                    function() {
                      $(this)
                      .css("background-color", "'.$syntax_highlighter.'")
                      .css("border-radius", "5px")
                      .css("padding-bottom", "5px")
                      .css("cursor", "pointer")
                      ;
                    },
                    function() {
                      $(this)
                      .css("background-color", "#fff")
                      ;
                    }
                );

                </script>';



          } else {

      }
 print $output;
 }



 ?>
