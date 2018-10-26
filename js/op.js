 $(document).ready(function(){
 $('.work-space').hide();
 $('.result-space').hide();
  var clicked="false";

  plugintextillate();

function plugintextillate(){
$('span.bouncingSpan').textillate({
								  loop: true,
								  minDisplayTime: 10000,
								  _in: {
									  effect: "bounceInDown",
									  delayScale: 6.5,
									  delay: 50,
									  sync: false,
									  shuffle: false,
									  },
								  out: {
									  effect: "fadeOut",
									  delayScale: 0.5,
									  delay: 100,
									  sync: false,
									  shuffle: false,
									  },
								  });

}





  $('#submit-btn').click(function(){
        // add loading image to div
        //$('.welcome-section').hide();



       if (clicked=="false"){
                  $('.welcome-section').toggle('1000',"swing", function () {
                 $('.work-space').toggle('1000',"swing", function () {
                                    $('.result-space').toggle('1000',"swing", function () {
         clicked="true";
        });
        });
        });
       } else {
          $('.work-space').toggle('1000',"swing", function () {
            $('.result-space').toggle('1000',"swing", function () {
                $('.work-space').toggle('1000',"swing", function () {
                    $('.result-space').toggle('1000',"swing", function () {
                         clicked="true";
                    });
                 });
            });
          });

       };




        //$('.work-space').show();
       //$('.result-space').show();
        $('.retrieve').hide();
        $('#loading').show();
        $('#loading').html('<img src="img/loading.gif" />');
           var sentence = $(".text-input").val();
           $.ajax({
                url:"core/sentence_op.php",
                method:"POST",
                data:{sentence:sentence},
                success:function(data){
                  $('.retrieve').html(data);
                  $('#loading').hide();
                  $('.retrieve').show();
                }
           });
      });

      $('#processBtn').click(function(){
        // add loading image to div
        $('.result-place').hide();
        $('.tree').hide();
        $('#loadingR').show();
        $('#loadingR').html('<div style="text-align: center;" ><img  src="img/loading.gif" /></div>');
        var choice = $(".adv-process").val();
           $.ajax({
                url:"core/refresh_results.php",
                method:"POST",
                data:{choice:choice},
                success:function(data){
               //  alert(data);
                  var v = data.split("|");

                  if (v[0]) {
                  $('.tree').html(v[0]);
                  };


                  if (v[1]) {
                  $('.result-place').html(v[1]);
                  };


                  //$('.result-place').html(data);
                  $('#loadingR').hide();
                  $('.result-place').show();
                  $('.tree').show();
                }
           });
      });
                             

 });