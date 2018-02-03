//this is the previous js saved for references

$(function(){
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
$('.modal').on('hide.bs.modal',function(){
	load()
})
$(document).on('click','.update',function(){//show modal
	var data_id = $(this).attr('id').split('_')[1];
	var c_num = $(this).children('.c_num').text();
	var remark = $(this).attr('title');
	var d_staff = $(this).children('.d_staff').text();
	var d_stat = $(this).children('.d_stat').text();
	var e_staff = $(this).children('.e_staff').text();
	var e_stat = $(this).children('.e_stat').text();
	var c_staff = $(this).children('.c_staff').text();
	var c_stat = $(this).children('.c_stat').text();
	var q_staff = $(this).children('.q_staff').text();
	var q_stat = $(this).children('.q_stat').text();
	var p_stat = $(this).children('.p_stat').text();
	var s_survey = $(this).children('.s_survey').text();
	$('.modal-title').html(c_num);
	$('.modal-dialog').addClass('modal-lg');
	$('.modal-body').html(
		'<h4>Process</h4>' +
		'<div class="row">' +
			'<div class="col-lg-3">' +
				'<label>Designing:</label>' +
			'</div>' +
			'<div class="col-lg-3">' +
				'<label>Encoding:</label>' +
			'</div>' +
			'<div class="col-lg-3">' +
				'<label>Checking:</label>' +
			'</div>' +
			'<div class="col-lg-3">' +
				'<label>Quality Check:</label>' +
			'</div>' +
		'</div>' +
		'<div class="row">' +
			'<div class="col-lg-3">' + set_staff(d_staff,d_stat,'d_staff') + '</div>' +
			'<div class="col-lg-3">' + set_staff(e_staff,e_stat,'e_staff') + '</div>' +
			'<div class="col-lg-3">' + set_staff(c_staff,c_stat,'c_staff') + '</div>' +
			'<div class="col-lg-3">' + set_staff(q_staff,q_stat,'q_staff') + '</div>' +
		'</div>' +
		'<div class="row">' +
			'<div class="col-lg-3">' + set_stat(d_staff,d_stat,'d_stat') + '</div>' +
			'<div class="col-lg-3">' + set_stat(e_staff,e_stat,'e_stat') + '</div>' +
			'<div class="col-lg-3">' + set_stat(c_staff,c_stat,'c_stat') + '</div>' +
			'<div class="col-lg-3">' + set_stat(q_staff,q_stat,'q_stat') + '</div>' +
		'</div>' +
		'<hr />' +
		'<div class="row">' +
			'<div class="col-lg-5" style="text-align: center;">' +
				'<div class="form-inline">' +
					'<label>Plan Status:&nbsp</label>' +
					'<select class="form-control input-lg" id="p_status">' + set_status(p_stat) + '</select>' +
				'</div>' +
			'</div>' +
			'<div class="col-lg-5" style="text-align: center;">' +
				'<div class="form-inline">' +
					'<label>Site Survey:&nbsp</label>' +
					'<input type="text" class="form-control input-lg" id="s_survey" value="' + s_survey + '" style="text-align: right;" />' +
				'</div>' +
			'</div>' +
			'<div class="col-lg-1" style="text-align: center;">' + comm_button(remark) + '</div>' +
		'</div>' +
		'<hr />' +
		'<div class="row">' +
			'<div class="col-lg-1"></div>' +
			'<div class="col-lg-10">' +
				'<div id="extra">' + check_comm(remark) + '</div>' +
			'</div>' +
		'</div>' +
		'<input type="hidden" id="data_id" value="' + data_id + '" />'
	);
	$('.modal-footer').html(
		'<input type="button" class="btn btn-lg btn-primary" id="save" value="Save"	/>' +
		'<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Close</button>'
	);
	$('.modal').modal('show');
	/*
	*/
})
$(document).on('click','#save',function(){
	$.ajax({
			type: 'post',
			url: 'server/user_update.php',
			data: {
				data_id: $('#data_id').val(),
				d_staff: $('#d_staff').val(),
				e_staff: $('#e_staff').val(),
				c_staff: $('#c_staff').val(),
				q_staff: $('#q_staff').val(),
				d_stat: $('#d_stat').val(),
				e_stat: $('#e_stat').val(),
				c_stat: $('#c_stat').val(),
				q_stat: $('#q_stat').val(),
				p_status: $('#p_status').val(),
				s_survey: $('#s_survey').val(),
				comm: $('#comm_text').val()
			}
		}).done(function(data){
			console.log(data)
			$('.modal').modal('hide')
		}).fail(function(data){
			alert('Failed.')
		})
})
$(document).on('keyup','#d_staff,#e_staff,#c_staff,#q_staff',function(){
	$(this).val($(this).val().toUpperCase()) 
	var stat_text = $(this).attr('id').split('_')[0] + '_stat'
	var status = ''
	var staff = $(this).val()
	$('#' + stat_text).parent().html(set_stat(staff,status,stat_text))
})
$(document).on('change','#d_stat,#e_stat,#c_stat,#q_stat',function(){
	var staff_text = $(this).attr('id').split('_')[0] + '_staff'
	var staff = $('#' + staff_text).val()
	var status = $(this).val()
	$('#' + staff_text).parent().html(set_staff(staff,status,staff_text))
})
$(document).on('click','#ss',function(){
	$('#extra').html(
	'<label>Site Survey Value:</label>' +
	'<input type="text" id="ss_text" class="form-control input-lg" />')
	$('#ss_text').focus()
})
$(document).on('click','#pend',function(){
	$('#extra').html(
	'<label>Insert Pending Reason:</label>' +
	'<textarea id="comm_text" class="form-control input-lg"> </textarea>')
	$('#comm_text').focus()
})
$(document).on('click','#comm',function(){
	$('#extra').html(
	'<label>Comment:</label>' +
	'<textarea id="comm_text" class="form-control input-lg"></textarea>')
	$('#comm_text').focus()
	$(this).remove()
})
$(document).on('keypress','#s_survey',function(){
	return isNumber(event)
})
$(document).on('mouseover','.d_staff,.d_stat',function(){
	$('#d_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.e_staff,.e_stat',function(){
	$('#e_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.c_staff,.c_stat',function(){
	$('#c_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseover','.q_staff,.q_stat',function(){
	$('#q_head').addClass('item_active')
	$(this).prevAll('.c_num').addClass('item_active')
})
$(document).on('mouseout','.d_staff,.d_stat',function(){
	$('#d_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.e_staff,.e_stat',function(){
	$('#e_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.c_staff,.c_stat',function(){
	$('#c_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
})
$(document).on('mouseout','.q_staff,.q_stat',function(){
	$('#q_head').removeClass('item_active')
	$(this).prevAll('.c_num').removeClass('item_active')
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
function set_stat(staff,status,id){
	if(!staff || (status !== get_today() && status !== 'ON PROCESS' && status !== '') ){
		return '<input type="text" class="form-control" id="' + id + '" tabindex="-1" readonly value="' + status + '" />'
	}else{
		return '<select class="form-control" id="' + id + '">' +
			'<option value="">ON PROCESS</option>' +
			'<option value="' + get_today() + '"' + selected(status,get_today()) + '>FINISHED</option>' +
		'</select>'
	}
}
function set_staff(staff,status,id){
	if(status !== 'ON PROCESS' && status !== ''){
		return '<input type="text" class="form-control" id="' + id + '" tabindex="-1" readonly value="' + staff + '" />'
	}else{
		return '<input type="text" class="form-control" style="text-transform:uppercase;" id="' + id + '" value="' + staff + '" />'
	}
}
function selected(var1,var2){
	if(var1 == var2){
		return 'selected'
	}
}
function check_comm(comm){
		var prompt = '<input type="hidden" id="comm_text" />'
	if (comm){
		var prompt = '<label>Comment:</label><textarea id="comm_text" class="form-control input-lg">' + comm + '</textarea>'
	}
	return prompt
}
function comm_button(comm){
	if (!comm){
		var prompt = '<button type="button" id="comm" class="btn btn-lg btn-warning" title="Insert Comment"><span class="glyphicon glyphicon-comment"></span></button>'
		return prompt
	}
	return ''
}
function set_status(p_stat){
		prompt = '<option value="A" selected>ADVANCED</option><option value="P">PEND</option>'
	if(p_stat == 'P'){
		prompt = '<option value="E">EXPECTED</option><option value="P" selected>PEND</option>'
	}
	if(p_stat == 'E'){
		prompt = '<option value="E" selected>EXPECTED</option><option value="P">PEND</option>'
	}
	return prompt
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode = 47 && (charCode < 46 || charCode > 57)) {
        return false;
    }
    return true;
}