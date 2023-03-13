$(document).ready(function(){
	
	$("#clientForm").submit(function(e){
		e.preventDefault();

		var nomCli = $("#nomCli").val();
		var prenomCli = $("#prenomCli").val();
		var adCli = $("#adCli").val();
		var cpCli = $("#cpCli").val();
		var telCli = $("#telCli").val();
		var mailCli = $("#mailCli").val();

		var url = 'controller/ajax/client/setClient.php';

		$.post(url,{nomCli:nomCli, prenomCli:prenomCli, adCli:adCli, cpCli:cpCli, telCli:telCli, mailCli:mailCli},function(data){
			$('.notifAdd').html(data);
		})
	})


	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var numCli = id;
			
		var url = 'controller/ajax/client/deleteClient.php';

		$.post(url,{numCli:numCli},function(data){
			$('.notifDel').html(data);
		})
		})
	})


	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/client/getClient.php';

		$.post(url,{numCli:id},function(data){
			$('.notifEdit').html(data);
		})
	})


	$("#editForm").submit(function(e){
		e.preventDefault();

		var numCli = $("#numCli").val();
		var nomCli = $("#nomCliEd").val();
		var prenomCli = $("#prenomCliEd").val();
		var adCli = $("#adCliEd").val();
		var cpCli = $("#cpCliEd").val();
		var telCli = $("#telCliEd").val();
		var mailCli = $("#mailCliEd").val();

		var url = 'controller/ajax/client/updateClient.php';

		$.post(url,{numCli:numCli,nomCli:nomCli, prenomCli:prenomCli, adCli:adCli, cpCli:cpCli, telCli:telCli, mailCli:mailCli},function(data){
			$('.notifUpdate').html(data);
		})
	})
})