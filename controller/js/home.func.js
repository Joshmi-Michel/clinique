$(document).ready(function(){
	
	$("#loginForm").submit(function(e){
		e.preventDefault();

		var login = $("#login").val();
		var password = $("#password").val();
		var url = 'controller/ajax/login.php';
		$.post(url,{login:login, password:password},function(data){
			$('.notif').html(data);
			$("#password").val('');
		})
	})
})