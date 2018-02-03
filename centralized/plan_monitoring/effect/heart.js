$(function(){
	
function fall(){
for(count = 0; count < 30; count++){

  var r_num = Math.floor(Math.random() * 40) + 1;
	var r_size = Math.floor(Math.random() * 50) + 10;
	var r_left = Math.floor(Math.random() * 120) -10;
	var r_bg = Math.floor(Math.random() * 100) + 100;
  var r_time = Math.floor(Math.random() * 10) + 1;
  var r_sec = Math.floor(Math.random() * 9);
  
  $('.modal_effect').append("<div class='heart' style='width:"+r_size+"px;height:"+r_size+"px;left:"+r_left+"%;background:rgba(255,"+(r_bg-25)+","+r_bg+",1);-webkit-animation:love "+r_time + "." + r_sec +"s ease;-moz-animation:love "+r_time+"s ease;-ms-animation:love "+r_time+"s ease;animation:love "+r_time+ "." + r_sec +"s ease'></div>");
}
  $('.modal_effect').append("<div class='love_you'>I LOVE YOU</div>");
  $('.heart').each(function(){
    var top = $(this).css("top").replace(/[^-\d\.]/g, '');
    //var width = $(this).css("width").replace(/[^-\d\.]/g, '');
    if(top <= 0 ){
      $(this).detach();
    }
  });
}
$('.modal').on('shown.bs.modal', function () {//modal set focus
	$(".modal_effect").html("")
	fall()
})
})