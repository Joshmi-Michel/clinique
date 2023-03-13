$(document).ready(function(){
	
	$("#chauffeurForm").submit(function(e){
		e.preventDefault();

		var nomChauf = $("#nomChauf").val();
		var immVtr = $("#immVtr").val();

		var url = 'controller/ajax/chauffeur/setChauf.php';

		$.post(url,{nomChauf:nomChauf,immVtr:immVtr},function(data){
			$('.notifAdd').html(data);
		})
	})


	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var numChauf = id;
			
		var url = 'controller/ajax/chauffeur/deleteChauf.php';

		$.post(url,{numChauf:numChauf},function(data){
			$('.notifDel').html(data);
		})
		})
	})


	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/chauffeur/getChauf.php';

		$.post(url,{numChauf:id},function(data){
			$('.notifEdit').html(data);
		})
	})


	$("#editForm").submit(function(e){
		e.preventDefault();

		var numChauf = $("#numChauf").val();
		var nomChauf = $("#nomChaufEd").val();
		var immVtr = $("#immVtrEd").val();
		var dispo = $("#dispoEd").val();

		var url = 'controller/ajax/chauffeur/updateChauf.php';

		$.post(url,{numChauf:numChauf,nomChauf:nomChauf,immVtr:immVtr,dispo:dispo},function(data){
			$('.notifUpdate').html(data);
		})
	})
})