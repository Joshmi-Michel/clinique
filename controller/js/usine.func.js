$(document).ready(function(){
	
	$("#usineForm").submit(function(e){
		e.preventDefault();

		var nomU = $("#nomU").val();
		var telU = $("#telU").val();
		var mailU = $("#mailU").val();

		var url = 'controller/ajax/usine/setUsine.php';

		$.post(url,{nomU:nomU,telU:telU, mailU:mailU},function(data){
			$('.notifAdd').html(data);
		})
	})


	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var numU = id;
			
		var url = 'controller/ajax/usine/deleteUsine.php';

		$.post(url,{numU:numU},function(data){
			$('.notifDel').html(data);
		})
		})
	})


	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/usine/getUsine.php';

		$.post(url,{numU:id},function(data){
			$('.notifEdit').html(data);
		})
	})


	$("#editForm").submit(function(e){
		e.preventDefault();

		var numU = $("#numU").val();
		var nomU = $("#nomUEd").val();
		var telU = $("#telUEd").val();
		var mailU = $("#mailUEd").val();

		var url = 'controller/ajax/usine/updateUsine.php';

		$.post(url,{numU:numU,nomU:nomU,telU:telU,mailU:mailU},function(data){
			$('.notifUpdate').html(data);
		})
	})
})