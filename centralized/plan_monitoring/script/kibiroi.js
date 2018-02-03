$(function(){
$(document).on('keyup','#search',function(){
	load(1)
})
$(document).on('click','.order-icon',function(){//show modal order
	var c_num = $(this).parent().prevAll('.c_num').text()
	var data_id = $(this).parent().parent().attr('id').split('_')[1];
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html('Message')
	$('.modal-body').html(
	'<h4 id="delete_prompt">Is <b>' + c_num + '</b> already ordered in Kibiroi?</h4>' +
	'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-success" id="confirm_order" value="Confirm" />' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	$('.modal').modal('show')
})
$(document).on('click','#confirm_order',function(){//confirm order
	var data_id = $('#data_id').val()
	$.ajax({
			type: 'post',
			url: 'server/confirm_order.php',
			data: {			
				data_id: data_id
			}
		}).done(function(data){
			//return validate_error(data,'','','Data has been successfully deleted!','Message',1)
			validate_error('','','','Successfully recorded as Ordered.','',1)
			console.log(data)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
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
function validate_error(err_msg,err_obj,err_out,success_msg,success_title,modal_close){
	if(err_msg != ''){
		if(err_obj != '' && err_out != ''){
			$(err_obj).addClass('has-error')
			$(err_out).html(err_msg)
		}else{
			return message('Error',err_msg)
		}
	}else{
		if(success_title != ''){
			return message(success_title,success_msg)
		}else{
			$('#alert_prompt').html('<h3><marquee behavior="alternate"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ' + success_msg + '</marquee></h3>')
		}			
		if(modal_close == 1){
			$('.modal').modal('hide')
			load(1)
		}
	}
}
function load(page){//load table
	$.ajax({
			type: 'post',
			url: 'server/kibiroi_ordered.php',
			data: {
				page_number: page,
				search: $('#search').val()
			}
		}).done(function(data){
			$("#ordered").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	$.ajax({
			type: 'post',
			url: 'server/kibiroi_error.php',
			data: {
				search: $('#search').val()
			}
		}).done(function(data){
			$("#error").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}