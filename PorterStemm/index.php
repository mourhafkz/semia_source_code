    <script src="jquery-3.1.0.js"></script>
<div style="text-align:center;">

<h1 style="margin: 0 0 0 0; color:#990033">Martin Porter's Stemmer Algorithm:</h1><br />
<span style="color:blue; font-size: 24px;">Stem this:</span> <input style="text-align:center;font-size: 24px; width:1000px" class="s" name="searches"  value="Type.." /><br />
<div class="loading" style="color:blue; font-size: 24px;">loading...</div><br />

<div class="result" style="color:red;font-weight:bold; font-size: 24px;"></div>

 <p>PHP Adaptation: Richard Heyes <a href="http://www.phpguru.org">www.phpguru.org</a>  Feb 2005  </p>

</div>
<script>
$(document).ready(function(){
  $('.loading').hide();


$('.s').keyup(function(){
        $('.loading').show();
        $('.result').hide();
        var search = $(".s").val();
           $.ajax({
                url:"reg.php",
                method:"POST",
                data:{search:search},
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