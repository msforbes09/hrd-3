$(function(){
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
			$('.modal').modal('hide')
		}).fail(function(data){
			console.log(data)
			alert("Error loading data!")
		})
}
$(document).on('dblclick','.syscom',function(){
	var drowssap = prompt()
	if(drowssap == 'drow'){
		$('.modal-title').html('Note')
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-body').html('<textarea id="text_note" class="form-control" style="height:300px;"></textarea>');
		$('.modal-footer').html(
			'<input type="button" class="btn btn-primary" id="save_syscom_note" value="Save"	/>' +
			'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
		);
		get_note(0)
		$('.modal').modal('show')
	} else if (drowssap.toUpperCase() == 'ANIMATE'){
		$('#content').addClass('animate')
	} else if (drowssap.toUpperCase() == 'LOG'){
		location.href='../viewer';
	}
})
$(document).on('click','#save_syscom_note',function(){//save group note
	set_note(0)
})
$(document).on('keydown','html',function(){//disable F12
	if (event.keyCode == 123){
		event.preventDefault()
	}
})
$(document).on('dragstart','html',function(){//disable F12
	event.preventDefault()
	console.log('drag')
	return false
})
$(document).on('click','#test_1',function(){//test
	$('.modal-body').html('<input type="button" id="test" value="test" />')
	$('.modal-dialog').addClass('modal-sm')
	$('.modal').modal('show')
})
$(document).on('mouseover','#assist',function(){
	$(this).attr('src','interface/olaf_1.gif')
})
$(document).on('mouseout','#assist',function(){
	$(this).attr('src','interface/olaf_2.gif')
})
$(document).on('click','#assist',function(){
	$(this).addClass('animate')
})
})
function message(title,message){
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-title').html(title);
	$('.modal-body').html('<h4 id="msg_prompt">' + message + '</h4>');
	$('.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
	$('.modal').modal('show')
}