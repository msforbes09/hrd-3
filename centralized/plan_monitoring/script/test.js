$(function(){
function get_val(data_id,col,txt_box){
	$.ajax({
			type: 'post',
			url: 'server/get_val.php',
			data: {			
				data_id: data_id,
				col: col
			}
		}).done(function(data){
			$(txt_box).val(data)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
function set_val(data_id,col,val,err_obj,err_out,success_msg,success_title,modal_close){
	$.ajax({
			type: 'post',
			url: 'server/set_val.php',
			data: {			
				data_id: data_id,
				col: col,
				val: val
			}
		}).done(function(data){
			return validate_error(data,err_obj,err_out,success_msg,success_title,modal_close)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
function get_note(group_id){
	$.ajax({
			type: 'post',
			url: 'server/get_note.php',
			data: {			
				group_id: group_id
			}
		}).done(function(data){
			$("#text_note").val(data)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
function set_note(group_id){
	$.ajax({
			type: 'post',
			url: 'server/set_note.php',
			data: {			
				group_id: group_id,
				note: $("#text_note").val()
			}
		}).done(function(data){
			return validate_error(data,'','','','',1)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
function remove_data(data_id){
	$.ajax({
			type: 'post',
			url: 'server/remove_data.php',
			data: {			
				data_id: data_id
			}
		}).done(function(data){
			return validate_error(data,'','','Data has been successfully deleted!','Message',1)
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
$('.modal').on('shown.bs.modal', function () {//modal set focus
	$('.default').focus()
})
$('#txt_rec').datepicker({//date picker
		format: 'yyyy-mm-dd',
		startDate: '-3m',
		autoclose: true,
		orientation: 'top'
	})
$('.modal').on('hide.bs.modal',function(){//reload after modal close
	load()
})
$(document).on('change','#team_id',function(){//filter team
	load();
})
$(document).on('click','#add',function(){//show modal
	$('.modal-title').html('Add New Plan (Group ' + $('#team_id').val() + ')')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('.modal-body').html(
	'<div class="row">' +
		'<div class="form-group form_input">' +
			'<div class="col-lg-4">' +
				'<label for="ctrl_num">Control #:</label>' +
			'</div>' +
			'<div class="col-lg-8">' +
				'<input type="text" id="ctrl_num" class="default form-control" maxlength="12" />' +
			'</div>' +
		'</div>' +
	'</div>' +
	'<div class="row">' +
		'<div id="form_input" class="form-group form_input">' +
			'<div class="col-lg-4">' +
				'<label for="p_stat">Status:</label>' +
			'</div>' +
			'<div class="col-lg-8">' +
				'<select id="p_status" class="form-control">' +
					'<option value="A">ADVANCED</option>' +
					'<option value="E">EXPECTED</option>' +
					'<option value="P">PENDING</option>' +
				'</select>' +
			'</div>' +
		'</div>' +
	'</div>' +
	'<div id="err_prompt" style="color: red; text-align: center;"></div>')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-primary" id="save" value="Save"	/>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	$('.modal').modal('show')
})
$(document).on('keypress','#ctrl_num,#txt_rec',function(){//control input
	return isCtrlnum(event)
})
$(document).on('click','#save',function(){//add plan
	var ctrl_num = $('#ctrl_num').val()
	var status = $('#p_status').val()
	if(ctrl_num.length != 12){
		return validate_error('Please check Control Number!','.form_input','#err_prompt','','',0)
	}
	$.ajax({
			type: 'post',
			url: 'server/check_list.php',
			data: {
				team_id: $('#team_id').val(),
				ctrl_num: ctrl_num,
				p_status: status
			}
		}).done(function(data){
			if(data){
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').removeClass('modal-sm');
				$('.modal-body').html('<h4>' + data + '</h4>');
				$('.modal-footer').html(
				'<input type="button" class="btn btn-primary" id="save_existing" value="Save"/>' +
				'<button type="button" id="default" class="btn btn-default" data-dismiss="modal">Close</button>');
				$('.modal').modal('show')
			} else {
				$.ajax({
						type: 'post',
						url: 'server/append.php',
						data: {
							team_id: $('#team_id').val(),
							ctrl_num: ctrl_num,
							p_status: status
						}
					}).done(function(data){
					return validate_error(data ,'.form_input','#err_prompt','','',1)
						console.log(data)
						//$('.modal').modal('hide')
					}).fail(function(data){
						console.log(data)
						alert('Failed.')
					})				
			}
			//console.log(data)
			//$('.modal').modal('hide')
		}).fail(function(data){
			console.log(data)
			alert('Failed.')
		})
	/*
	*/
})
$(document).on('click','#save_existing',function(){//add existing plan
	var ctrl_num = $('#ctrl_num').html()
	var status = $('#p_status').val()
	var comment = $('#text_note').val().trim()
	if(!comment){
		return validate_error('Please insert comment to continue!','.form_input','#err_prompt','','',0)
	}
	$.ajax({
		type: 'post',
		url: 'server/add_existing.php',
		data: {
			team_id: $('#team_id').val(),
			ctrl_num: ctrl_num,
			p_status: status,
			comment: comment
		}
	}).done(function(data){
	return validate_error(data ,'.form_input','#err_prompt','','',1)
		console.log(data)
		//$('.modal').modal('hide')
	}).fail(function(data){
		console.log(data)
		alert('Failed.')
	})
	/*
	*/
})
$(document).on('click','.remove',function(){//show modal to delete
	var c_num = $(this).parent().prevAll('.c_num').text()
	var data_id = $(this).parent().parent().attr('id').split('_')[1];
	$(this).removeClass('btn-danger')
	$(this).parent().parent().addClass('bg_red')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html('Remove')
	$('.modal-body').html(
	'<h4 id="delete_prompt">Are you sure you want remove ' + c_num + '?</h4>' +
	'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-danger" id="confirm_remove" value="Remove" />' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	$('.modal').modal('show')
})
$(document).on('click','#confirm_remove',function(){//confirm delete
	var data_id = $('#data_id').val()
	remove_data(data_id)
})
$(document).on('change','.p_stat',function(){//set plan status
	var data_id = $(this).parent().parent().attr('id').split('_')[1]
	var status = $(this).val()
	set_val(data_id,'plan_status',status,'','','','',1)
})
$(document).on('dblclick','.date_rec',function(){//show modal to update rec date
	var data_id = $(this).parent().attr('id').split('_')[1];
	$('.modal-title').html('Date Received')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('.modal-body').html(
	'<div class="input-group form_input">' +
		'<input type="text" class="default form-control input-lg" id="txt_rec" maxlength="10" placeholder="yyyy-mm-dd" style="text-align: center;">' +
		'<span class="input-group-addon">' +
			'<span class="glyphicon glyphicon-calendar"></span>' +
		'</span>' +
	'</div>' +
	'<div id="err_prompt" style="color: red; text-align: center;"></div>' +
	'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-primary" id="save_rec" value="Save"/>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	get_val(data_id,'date_rec','#txt_rec')
	$('.modal').modal('show')
})
$(document).on('dblclick','.date_fin',function(){//show modal to update fin date
	var data_id = $(this).parent().attr('id').split('_')[1];
	$('.modal-title').html('Date Finished')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('.modal-body').html(
	'<div class="input-group form_input">' +
		'<input type="text" class="default form-control input-lg" id="txt_fin" maxlength="10" placeholder="yyyy-mm-dd" style="text-align: center;">' +
		'<span class="input-group-addon">' +
			'<span class="glyphicon glyphicon-calendar"></span>' +
		'</span>' +
	'</div>' +
	'<div id="err_prompt" style="color: red; text-align: center;"></div>' +
	'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-primary" id="save_fin" value="Save"	/>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	get_val(data_id,'qc_status','#txt_fin')
	$('.modal').modal('show')
})
$(document).on('click','#save_rec',function(){//save date rec
	var data_id = $('#data_id').val()
	var date = $('#txt_rec').val()
	set_val(data_id,'date_rec',date,'.form_input','#err_prompt','Received date already updated.','Message',0)
})
$(document).on('click','#save_fin',function(){//save date fin
	var data_id = $('#data_id').val()
	var date = $('#txt_fin').val()
	set_val(data_id,'qc_status',date,'.form_input','#err_prompt','Released date already updated.','Message',0)
})
$(document).on('click','#btn_group_note',function(){//show modal to update group note
	$('.modal-title').html('Note')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-body').html('<textarea id="text_note" class="form-control default" style="height:300px;"></textarea>');
	$('.modal-footer').html(
		'<input type="button" class="btn btn-primary" id="save_group_note" value="Save"	/>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	get_note($('#team_id').val())
	$('.modal').modal('show')
})
$(document).on('click','#btn_fd_note',function(){//show modal to update fd note
	$('.modal-title').html('Note')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-body').html('<textarea id="text_note" class="form-control default" style="height:300px;"></textarea>');
	$('.modal-footer').html(
		'<input type="button" class="btn btn-primary" id="save_fd_note" value="Save"	/>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	get_note(1)
	$('.modal').modal('show')
})
$(document).on('click','#save_group_note',function(){//save group note
	set_note($('#team_id').val())
})
$(document).on('click','#save_fd_note',function(){//save group note
	set_note(1)
})
$(document).on('click','.move',function(){//show modal to transfer plan
	var c_num = $(this).parent().prevAll('.c_num').text()
	var data_id = $(this).parent().parent().attr('id').split('_')[1];
	$(this).removeClass('btn-info')
	$(this).parent().parent().addClass('bg_blue')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html('Move')
	$('.modal-body').html(
		'<h4>Are you sure you want move ' + c_num + ' to group ' + other_group($('#team_id').val()) + '?</h4>' +
		'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-info" id="confirm_move" value="Move" />' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	$('.modal').modal('show')
})
$(document).on('click','#confirm_move',function(){//confirm transfer
	var data_id = $('#data_id').val()
	var group = other_group($('#team_id').val())
	set_val(data_id,'team_id',group,'','','Successfully Moved!.','Message',0)
})
$(document).on('click','.comment',function(){
	var c_num = $(this).parent().prevAll('.c_num').text()
	var data_id = $(this).parent().parent().attr('id').split('_')[1];
	$(this).removeClass('btn-warning')
	$(this).removeClass('btn-success')
	$(this).parent().parent().addClass('bg_green')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html(c_num)
	$('.modal-body').html(
	'<textarea id="text_comment" class="form-control" style="height:300px;"></textarea>' +
	'<input type="hidden" id="data_id" value="' + data_id + '" />')
	$('.modal-footer').html(
		'<input type="button" class="btn btn-success" id="save_comment" value="Save" />' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
	);
	get_val(data_id,'remark','#text_comment')
	$('.modal').modal('show')
})
$(document).on('click','#save_comment',function(){
	var data_id = $('#data_id').val()
	var comment = $('#text_comment').val()
	set_val(data_id,'remark',comment,'','','','',1)
})
load();
})
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode = 47 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
}
function isCtrlnum(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 45 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function other_group(group){
	prompt = ''
	if(group == 1){
		prompt = 2
	}else if(group == 2){
		prompt = 1
	}
	return prompt
}
function message(title,message){
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html(title);
	$('.modal-body').html('<h4>' + message + '</h4>');
	$('.modal-footer').html('<button type="button" id="default" class="btn btn-default" data-dismiss="modal">Close</button>');
	$('.modal').modal('show')
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
		if(success_msg != ''){
			$('.modal').modal('hide')
			return message(success_title,success_msg)
		}else{
			if(modal_close == 1){
				$('.modal').modal('hide')
			}
		}
	}
}
function load(){//load table
	$.ajax({
			type: 'post',
			url: 'server/read_admin.php',
			data: {
				team_id: $('#team_id').val()
			}
		}).done(function(data){
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}