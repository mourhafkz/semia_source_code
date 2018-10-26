    <script src="jquery-3.1.0.js"></script>
<h2 style="margin: 0 0 0 0; color:#990033">Experiments with Regular expressions:</h2>
<br/>
<span style="color:blue;">Pattern:</span> <input class="in" name="pattern" style="width:500px" value="/Reg(exp?|ular expression)$/i" />
<span style="color:blue;">Search in:</span> <input class="s" name="searches" style="width:500px" value="I like Regular expression" />
<div class="loading">loading...</div>
<div class="result"></div>

<h4>Examples of usage:</h4>
<ul>
<li>pattern :  /(am|is|are)\s([\w]{0,})(ing)/i </li>
<li>example :  Sb <span style="font-weight: bold;">is eating</span> bananas </li>
<br/>
<li>pattern :  /\b(am|is|are)\b\s+(([\w]{0,}\s+){0,})?(([\w]{0,})(ful))/i </li>
<li>example :  He i s a re <span style="font-weight: bold;">is very much careful</span></li>


</ul>

<script>
$(document).ready(function(){
  $('.loading').hide();
$('.s').keyup(function(){
        $('.loading').show();
        $('.result').hide();
        var pattern = $(".in").val();
        var search = $(".s").val();
           $.ajax({
                url:"reg.php",
                method:"POST",
                data:{pattern:pattern,search:search},
                success:function(data){

                  $('.loading').hide();
                         $('.result').hide();

              $('.result').html(data);
        $('.result').show();

                }
           });
      });

$('.in').keyup(function(){
        $('.loading').show();
        $('.result').hide();
        var pattern = $(".in").val();
        var search = $(".s").val();
           $.ajax({
                url:"reg.php",
                method:"POST",
                data:{pattern:pattern,search:search},
                success:function(data){

                  $('.loading').hide();
                         $('.result').hide();

              $('.result').html(data);
        $('.result').show();

                }
           });
      });

 });

</script>