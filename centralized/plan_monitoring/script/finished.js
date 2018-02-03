$(function(){
$(document).on('keyup','#search',function(){
	load(1)
})
$(document).on('click','.next_page',function(){
	var page_index = parseInt($('#index_page').html()) + 1
	var page_max = parseInt($('#last_page').html())
	if (page_index <= page_max){
		load(page_index)
	}
})
$(document).on('click','.prev_page',function(){
	var page_index = parseInt($('#index_page').html()) - 1
	if (page_index > 0){
		load(page_index)
	}
})
load(1)
})
function load(page){//load table
	$.ajax({
			type: 'post',
			url: 'server/read_finished.php',
			data: {
				page_number: page,
				search: $('#search').val()
			}
		}).done(function(data){
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}