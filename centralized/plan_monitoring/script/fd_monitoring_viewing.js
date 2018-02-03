$(function(){
$(document).on('keyup','#search',function(){
	load()
})	
load()
})
function load(){//load table
	$.ajax({
			type: 'post',
			url: 'server/read_foundation_monitoring.php',
			data: {
				search: $('#search').val()
			}
		}).done(function(data){
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}