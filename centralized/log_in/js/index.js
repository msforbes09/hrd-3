$(function(){	
$(document).on('click','#login-button',function(){
	$.ajax({
		type: 'post',
		url: 'server/check_user.php',
		data:	{
			username: $('#username').val(),
			password: $('#password').val()
		}
	}).done(function(data){
		if (data == 1){
			$('#visitor').html('')
			$('.form').fadeOut(500);
			$('.wrapper').addClass('form-success');
			$('.welcome').append('<p style="color: rgba(50, 50, 50, 1);">click anywhere to continue</p>');
			$('body').addClass('continue')
		} else {
			$('#username').val('')
			$('#username').focus()
			$('#password').val('')
			$('#alert').html('Invalid Log-In!')
		}
	}).fail(function(data){
		alert('Something went wrong!')
	})
})
$(document).on('click','.continue',function(){
	location.href='../plan_monitoring';
})
$(document).on('click','#visitor',function(){
	location.href='../plan_monitoring/visitor.php';
})
$(document).on('keypress','#username,#password',function(){
	$('#alert').html('')
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
})