$(function(){
$(document).on('mouseover','.d_staff,.d_stat',function(){//hover
	$('#d_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.e_staff,.e_stat',function(){//hover
	$('#e_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.c_staff,.c_stat',function(){//hover
	$('#c_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.q_staff,.q_stat',function(){//hover
	$('#q_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseout','.d_staff,.d_stat',function(){//hover
	$('#d_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.e_staff,.e_stat',function(){//hover
	$('#e_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.c_staff,.c_stat',function(){//hover
	$('#c_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.q_staff,.q_stat',function(){//hover
	$('#q_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$('.modal').on('shown.bs.modal', function () {//modal set focus
	$('.default').focus()
})
$(document).on('dblclick','.c_num',function(){//copy to clipboard
	var c_num = $(this).text().trim()
	$('#clipboard').html('<input type="text" id="text_board" value="' + c_num + '" />')
	$('#text_board').select()
	document.execCommand("copy")
	$('#clipboard').html('')
	validate_error('','','','"' + c_num + '" has been copied to clipboard.','',0)
})
$(document).on('click','.d_staff,.d_stat',function(){//show modal
	var data_id = $(this).parent().attr('id').split('_')[1];
	get_modal(data_id,0)
})
$(document).on('click','.e_staff,.e_stat',function(){//show modal
	var data_id = $(this).parent().attr('id').split('_')[1];
	get_modal(data_id,1)
})
$(document).on('click','.c_staff,.c_stat',function(){//show modal
	var data_id = $(this).parent().attr('id').split('_')[1];
	get_modal(data_id,2)
})
$(document).on('click','.q_staff,.q_stat',function(){//show modal
	var data_id = $(this).parent().attr('id').split('_')[1];
	get_modal(data_id,3)
})
$(document).on('keypress','#text_ss',function(){//validate number
	return isNumber(event)
})
$(document).on('change','#text_stat',function(){//set text_staff visual 
	set_textstaff($(this).val())
})
$(document).on('change','#text_staff',function(){//set text_stat visual
	set_textstat($(this).val().trim())
})
$(document).on('change','#text_planstat',function(){//set visual
	set_planstat($(this).val())
})
$(document).on('change','#kibiroi_stat',function(){//set visual
	set_kibiroistat($(this).val())
})
$(document).on('click','#save_design',function(){//update
	update_data(0)
})
$(document).on('click','#save_encode',function(){//update
	update_data(1)
})
$(document).on('click','#save_check',function(){//update
	if($('#text_stat').val() && ($('#kibiroi_stat').val() == 0 || !$('#text_ss').val())){
		validate_error('Invalid Site Survey/Kibiroi Status Value!','.input-group','#err_prompt','','',0)
		return false
	}
	update_data(2)
})
$(document).on('click','#save_qc',function(){//update
	$.ajax({
		type: 'post',
		url: 'server/check_prev_proc.php',
		data: {
			data_id: $('#data_id').val()
		}
	}).done(function(data){
		if(!data){
			update_data(3)
		} else {
			validate_error('Not yet finished in previous process!','.input-group','#err_prompt','','',0)
		}
	}).fail(function(data){
		alert("Error loading data!")
	})
})
load();
})
function get_today(){
	var dt = new Date()
	var day = ('0' + dt.getDate()).slice(-2)
	var month = ('0' + (dt.getMonth() + 1)).slice(-2)
	var year = dt.getFullYear()
	var today = year + '-' + month + '-' + day
	return today	
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode = 47 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
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
function get_modal(data_id,process_code){
	var title = ['Designing','Encoding','Checking','QC Checking']
	var button = ['design','encode','check','qc']
	$.ajax({
			type: 'post',
			url: 'server/user_modal_2.php',
			data: {
				data_id: data_id,
				process_code: process_code,
				team_id : $('#team_id').val(),
				staff_id : $('#staff_id').val()
			}
		}).done(function(data){
			$(".modal-body").html(data)
			$('.modal-title').html('<b>' + title[process_code] + ' Process</b>')
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').removeClass('modal-sm');
			$('.modal-footer').html(
				'<input type="button" class="btn btn-default" id="save_' + button[process_code] + '" value="Save"	/>' +
				'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
			$('.modal').modal('show')
		}).fail(function(data){
			message('Error','Something went wrong!!!')
		})
}
function set_textstaff(val){
	if(val){
		$('#text_staff').attr('disabled',1)
	} else {
		$('#text_staff').removeAttr('disabled')
	}
}
function set_textstat(val){
	var prompt = ''
	if(val == 1){
		prompt = '<input type="text" class="form-control" id="text_stat" placeholder="Process Status" style="padding-left: 20px; text-transform:uppercase;" tabindex="-1" disabled />'
	}else{
		prompt = '<select class="form-control" id="text_stat" style="padding-left: 16px;">' +
			'<option value="">ON PROCESS</option>' +
			'<option value="' + get_today() +'">FINISHED</option>' +
		'</select>'
	}
	prompt += '<span class="input-group-addon">' +
				'<span class="glyphicon glyphicon-dashboard"></span>' +
			'</span>'
	$('#text_stat').parent().html(prompt)
}
function set_planstat(val){
	if(val == 'P'){
		$('#text_planstat').parent().addClass('has-error')
	} else {
		$('#text_planstat').parent().removeClass('has-error')
	}
}
function set_kibiroistat(val){
	if(val == '2'){
		$('#kibiroi_stat').parent().addClass('has-error')
	} else {
		$('#kibiroi_stat').parent().removeClass('has-error')
	}
}
function load(){//load table
	$.ajax({
			type: 'post',
			url: 'server/read_summary.php',
			data: {
				team_id: $('#team_id').val()
			}
		}).done(function(data){
			$("#summary").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	$.ajax({
			type: 'post',
			url: 'server/read_monitoring.php',
			data: {
				team_id: $('#team_id').val()
			}
		}).done(function(data){
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}
function update_data(proc){
	$.ajax({
		type: 'post',
		url: 'server/data_update.php',
		data: {
			proc_id: proc,
			data_id: $('#data_id').val(),
			staff: $('#text_staff').val().trim().toUpperCase(),
			stat: $('#text_stat').val(),
			planstat: $('#text_planstat').val(),
			ss: $('#text_ss').val(),
			kibiroi: $('#kibiroi_stat').val(),
			remark: $('#text_remark').val().trim()
		}
	}).done(function(data){
		validate_error(data,'.input-group','#err_prompt',$('#cnum_text').val() +' Successfully Updated!','',1)
	}).fail(function(data){
		alert("Error loading data!")
	})
}	