$(function(){
$(document).on('click','#master_add',function(){//show modal
	$.ajax({
		type: 'post',
		url: 'server/add_modal.php'
	}).done(function(data){
		$('.modal-body').html(data)
		$('.modal-title').html('Add new staff')
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-footer').html(
			'<input type="button" class="btn btn-primary" id="add_save" value="Save" />' +
			'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		message('Error','Something went wrong!!!')
	})
})
$(document).on('change','#team_select',function(){//get team process
	$.ajax({
		type: 'post',
		url: 'server/get_job_desc.php',
		data:	{
			team_id: $('#team_select').val()
		}
	}).done(function(data){
		$('#job_desc_select').html(data)
	}).fail(function(data){
		message('Error','Something went wrong!!!')
	})
})
$(document).on('keypress','#id_num_txt',function(){//number only
	return isNumber(event)
})
$('.modal').on('shown.bs.modal', function () {//modal set focus
	$('.default').focus()
})
$(document).on('keydown','html',function(){//disable F12
	if (event.keyCode == 123){
		event.preventDefault()
	}
})
$(document).on('dragstart','html',function(){//disable drag
	event.preventDefault()
	console.log('drag')
	return false
})
$(document).on('click','#add_save',function(){
	var id_num = $('#id_num_txt').val()
	var first_name = $('#first_name_txt').val().trim().toUpperCase()
	var middle_name = $('#middle_name_txt').val().trim().toUpperCase()
	var last_name = $('#last_name_txt').val().trim().toUpperCase()
	var nick_name = $('#nick_name_txt').val().trim().toUpperCase()
	var employment_stat = $('#employment_stat_select').val()
	var job_cate = $('#job_cate_select').val()
	var team = $('#team_select').val()
	var job_desc = $('#job_desc_select').val()
	if (id_num.length != 7 || !first_name || !middle_name || !last_name || !nick_name || employment_stat == 0 || job_cate == 0){
		validate_error('Please Review your record!',' ','#err_prompt','Data Successfully Updated!','',1)
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/add_save.php',
		data: {
			id_num: id_num,
			first_name: first_name,
			middle_name: middle_name,
			last_name: last_name,
			nick_name: nick_name,
			employment_stat: employment_stat,
			job_cate: job_cate,
			team: team,
			job_desc: job_desc
		}
	}).done(function(data){
		validate_error(data,'.input-group','#err_prompt','Data Successfully Updated!','',1)
	}).fail(function(data){
		message('Error','Something went wrong!!!')
	})
})
$(document).on('change','#employment_stat_filter',function(){
	load()
})
$(document).on('change','#job_cate_filter',function(){
	load()
})
$(document).on('change','#team_filter',function(){//get team process
	$.ajax({
		type: 'post',
		url: 'server/get_job_desc.php',
		data:	{
			team_id: $('#team_filter').val()
		}
	}).done(function(data){
		$('#job_desc_filter').html(data)
		load()
	}).fail(function(data){
		message('Error','Something went wrong!!!')
	})
})
$(document).on('change','#job_desc_filter',function(){
	load()
})
load()
})
function load(){//load table
	$.ajax({
			type: 'post',
			url: 'server/staff_read.php',
			data: {
				employment_stat_filter: $('#employment_stat_filter').val(),
				job_cate_filter: $('#job_cate_filter').val(),
				team_filter: $('#team_filter').val(),
				job_desc_filter: $('#job_desc_filter').val()
			}
		}).done(function(data){
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}
function message(title,message){
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html(title);
	$('.modal-body').html('<h4>' + message + '</h4>');
	$('.modal-footer').html('<button type="button" id="default" class="btn btn-default" data-dismiss="modal">Close</button>');
	$('.modal').modal('show')
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode < 46 || charCode > 57) {
        return false;
    }
    return true;
}
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
			load()
		}
	}
}