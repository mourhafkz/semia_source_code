<?php
include("../bin/const.php");
 $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 $output = '';




if(isset($_POST["sentence"]))
 {
      if($_POST["sentence"] != '')
      {

            $keywords = preg_split("/[\s,<>]+/", $_POST["sentence"]);
            $id=0;
            // truncate
            $sql_truncate = " TRUNCATE TABLE temp ; ";
           if ($conn->query($sql_truncate) === TRUE) {
                //echo "New record created successfully";
            } else {
               // echo "Error: " . $sql_truncate . "<br>" . $conn->error;
            }
            $conn->close();
            $conn->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $sql_truncate = " TRUNCATE TABLE temp_relations ;";
           if ($conn->query($sql_truncate) === TRUE) {
                //echo "New record created successfully";
            } else {
               // echo "Error: " . $sql_truncate . "<br>" . $conn->error;
            }

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            foreach ($keywords as &$value) {
             // if value null
            if ($value !== ""){
            $v = $conn->real_escape_string($value);
            // Check connection
            $id=$id+1;
            //machine learning note - values can be guessed
            $sql_insert =" INSERT INTO temp (id, raw_element , groupHead) VALUES ('$id', '$value' , 'No') ; ";
            if ($conn->query($sql_insert) === TRUE) {
                //db confirmation
               // echo "New record created successfully" . "<br>" . $sql_insert. "<br>";
            } else {
              //  echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }


            }

            }

            // Level 1 Table 1
            //build stylistics for table
            //title row
            $output.='<table class="dtable"><thead>
                      <tr>
                      <th>ID</th>
                      <th>Element</th>
                      <th>Group Tag</th>
                      <th>Group Starter</th>
                      <th>Specific Tag</th>
                      <th>Follows Group Starter</th>
                      <th>Tag Needed</th>
                      <th><span style="font-weight:bold;">SemiA</span>utomatic Suggestion</th>
                      </tr>
                      </thead>
                      <tbody>';


            //retrieve items
            $sql_retrieve = "SELECT * FROM temp";
            $result = $conn->query($sql_retrieve);
              if ($result->num_rows > 0) {
              // output data of each row
                  while($row = $result->fetch_assoc()) {
                       "id: " . $row["id"]. " - Element: " . $row["raw_element"]."<br>";
            $output.='<tr>
                      <td>'. $row["id"].'
                      </td>

                      <td>'.$row["raw_element"].'
                      </td>


                      <td><input  style="text-transform: uppercase;"  name="'. $row["id"].'" id="'. $row["id"].'-gtag" value="'.$row["groupTag"].'"><br/><a href="#"  name="'. $row["id"].'" id="'. $row["id"].'-gttick">Save Changes</a>
                        <span class="suggest" style="width:10px;" name="'.$row["id"].'-stsug"'.'"  id="'. $row["id"].'-gtsug" >
                        <a class="sugclick" name="'.$row["id"].'" id="'.$row["id"].'-click" href="#"></a>
                        </span>
                      </td>


                      <td><select name="'. $row["id"].'-ghead" id="'. $row["id"].'-ghead">
                      ';

                       if ($row["groupHead"] === "Yes") {
                       $output.= '<option>Yes</option><option>No</option>';
                       } else {
                       $output.='<option>No</option><option>Yes</option>'; };
                       $output.='</select>
                      </td>


                      <td><input style="text-transform: uppercase;"  name="'. $row["id"].'" id="'. $row["id"].'-specTag" value="'.$row["specTag"].'"><br/><a href="#"  name="'. $row["id"].'" id="'. $row["id"].'-sttick">Save Changes</a>
                        <span class="suggest" style="width:10px;" name="'.$row["id"].'-stsug"'.'"  id="'. $row["id"].'-stsug" >
                        <a name="'.$row["id"].'" id="'.$row["id"].'-click" href="#"></a>
                        </span>
                      </td>


                      <td><input name="'. $row["id"].'" id="'. $row["id"].'-rel" value="'.$row["consTohead"].'"><br/><a href="#"  name="'. $row["id"].'" id="'. $row["id"].'-constick">Save Changes</a>
                        <span class="suggest" style="width:10px;" name="'.$row["id"].'-csug"'.'"  id="'. $row["id"].'-csug" >
                        <a name="'.$row["id"].'" id="'.$row["id"].'-click" href="#"></a>
                        </span>
                      </td>



                      <td><select name="'. $row["id"].'-merge" id="'. $row["id"].'-merge">
                      ';

                       if ($row["merge"] === 1) {
                       $output.= '<option>No</option><option>Yes</option>';
                       } else {
                       $output.='<option>Yes</option><option>No</option>'; };
                       $output.='</select>
                      </td>


                      <td><a class="btn sug" disabled="true" href="#"  name="'. $row["id"].'" id="'. $row["id"].'-auto">suggest</a><h3 name="'. $row["id"].'" id="'. $row["id"].'-automsg"></h3>
                      </td>

                      </tr>



                      ';
                      }
            $output.='</tbody></table>';

            echo $output;
            unset($value); // break the reference with the last element


                  }
              } else {
                  echo "<h3 style='color:red'>Input fatal error - Process failed.</h3>";
              }


            //printout
            $conn->close();

      }

 ?>

<script >

$(document).ready(function() {
  //hide the tick
  $('[id$=tick]').hide();

//gtauto
      $('[id$=-auto]').click(function(){

                var item_id = $(this).attr("name"); //element id
                var ref_sen= $(".text-input").val();
                $('[id$='+item_id+'-auto]').hide();
           $.ajax({
                url:"ai/auto_gtag.php",
                method:"POST",
                data:{ref_sen:ref_sen, item_id:item_id},
                success:function(value){

                  var data = value.split("|");

                  if (data[0]) {
                  $('[id$='+data[0]+'-gtag]').val(data[1]);
                  };

                  if (data[2]) {
                  $('[id$='+data[2]+'-specTag]').val(data[3]);
                  };
                  if (data[4]) {
                  $('[id$='+data[4]+'-gtag]').val(data[5]);
                  };

                  if (data[6]) {
                  $('[id$='+data[6]+'-specTag]').val(data[7]);
                  };

                  //add loading
                  $('[id$='+item_id+'-auto]').show();


                }
           });
      });

//group tag ticks
      $('[id$=-gttick]').click(function(){

                var el_id = $(this).attr("name");
                var new_val= $("[id$="+el_id+"-gtag"+"]").val();
           $.ajax({
                url:"core/update_gtag.php",
                method:"POST",
                data:{new_val:new_val, el_id:el_id},
                success:function(data){

                     $('[id$='+el_id+'-gttick]').hide();
                     $('[class$=sugclick]').hide();
                }
           });
      });
//constohead tick
      $('[id$=-constick]').click(function(){

                var el_id = $(this).attr("name");
                var new_val= $("[id$="+el_id+"-rel"+"]").val();
           $.ajax({
                url:"core/update_cons.php",
                method:"POST",
                data:{new_val:new_val, el_id:el_id},
                success:function(data){

                     $('[id$='+el_id+'-constick]').hide();
                     $('[class$=sugclick]').hide();

                }
           });
      });

           // suggestion for rel tags
      $('[id$=-rel]').keydown(function(){
                var search_val= $(this).val();
                var el_id = $(this).attr("name");
                $('[id$='+el_id+'-constick]').show();
                var list_no=  $(this).attr("name");
                var targetlist= list_no+'-csug';
           $.ajax({
                url:"core/rel_search.php",
                method:"POST",
                data:{search_val:search_val, el_id:el_id},
                success:function(data){
               //      alert(data);
                      $('[id$='+targetlist+']').html(data).show();
                }
           });
      });

//spec tag ticks
      $('[id$=-sttick]').click(function(){
                var el_id = $(this).attr("name");
                var new_val= $("[id$="+el_id+"-specTag"+"]").val();
           $.ajax({
                url:"core/update_stag.php",
                method:"POST",
                data:{new_val:new_val, el_id:el_id},
                success:function(data){
                     $('[id$='+el_id+'-sttick]').hide();
                     $('[class$=sugclick]').hide();
             }
           });
      });



    // grouphead update on selection
      $('[id$=-ghead]').change(function(){
                var new_val= $(this).val();
                var el_id = $(this).attr("name");
           $.ajax({
                url:"core/update_ghead.php",
                method:"POST",
                data:{new_val:new_val, el_id:el_id},
                success:function(data){
                     //no need to change values$('[id$=-ghead]').html(data);
                }
           });
      });

          // merge update on selection
      $('[id$=-merge]').change(function(){
                var new_val= $(this).val();
                var el_id = $(this).attr("name");
           $.ajax({
                url:"core/update_merge.php",
                method:"POST",
                data:{new_val:new_val, el_id:el_id},
                success:function(data){
                     //no need to change values$('[id$=-ghead]').html(data);
                }
           });
      });


     // suggestion for group tags
      $('[id$=-gtag]').keydown(function(){

                var search_val= $(this).val();
                var el_id = $(this).attr("name");
                $('[id$='+el_id+'-gttick]').show();
                var list_no=  $(this).attr("name");
                var targetlist= list_no+'-gtsug';
           $.ajax({
                url:"core/grouptag_search.php",
                method:"POST",
                data:{search_val:search_val, el_id:el_id},
                success:function(data){
                      $('[id$='+targetlist+']').html(data).show();
                }
           });
      });




//suggestion for spec tags
      $('[id$=-specTag]').keydown(function(){
                var search_val= $(this).val();
                var el_id = $(this).attr("name");
                $('[id$='+el_id+'-sttick]').show();
                var list_no=  $(this).attr("name");
                var targetlist= list_no+'-stsug';
           $.ajax({
                url:"core/spectag_search.php",
                method:"POST",
                data:{search_val:search_val, el_id:el_id},
                success:function(data){
                      $('[id$='+targetlist+']').html(data).show();

                }
           });
      });


$(".tag").change(function(){
        // clear target datalist
        $('#constituencies').find('option').remove().end();
        $("#constituencies").append("<option value='Root'>")
        // collect values from same field type
        $.each($('.tag'), function (index, value) {
            // append each value into the same target datalist
            $("#constituencies").append("<option value="+$(value).val()+">")

});
});






});
 </script>