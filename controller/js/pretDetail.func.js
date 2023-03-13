$(document).ready(function(){

	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');
		var nL = btn.val();
		var nLec = btn.attr('val');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var numPret = id;
			var numLivre = nL;
			var numLecteur = nLec;

			var url = 'controller/ajax/pret/deletePret.php';
			
			$.post(url,{numPret:numPret,numLivre:numLivre,numLecteur:numLecteur},function(data){
			 	$('.notifAjax').html(data);
			 })
		})
	})


	$(".editPret").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/pret/getPret.php';

		$.post(url,{numPret:id},function(data){
			$('.notifEdit').html(data);
		})
	})

	// $(".livDetail").click(function(e){
	// 	e.preventDefault();
	// 	var btn = $(this);
	// 	var id = btn.attr('id');

	// 	var url = 'controller/ajax/livre/detailLivre.php';

	// 	$.post(url,{numLivre:id},function(data){
	// 		$('.notifDetail').html(data);
	// 	})
	// })

	$("#editForm").submit(function(e){
		e.preventDefault();

		var numPret = $("#numPret").val();
		var currentNumLivre = $("#currentNumLivre").val();
		var numLecteur = $("#numLecteurEd").attr('val');
		var numLivre = $("#numLivreEd").val();
		var datePret = $("#datePretEd").val();

		var url = 'controller/ajax/pret/updatePret.php';

		$.post(url,{numPret:numPret,currentNumLivre:currentNumLivre,numLecteur:numLecteur,numLivre:numLivre,datePret:datePret},function(data){
			$('.notifUpdate').html(data);
		})
	})
})