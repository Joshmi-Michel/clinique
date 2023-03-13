/*$(document).ready(function(){
	
	$("#achatForm").submit(function(e){
		e.preventDefault();

		var nomProd = $("#nomProd").val();
		var pu1= $("#pu1").val();
		var qt1= $("#qt1").val();
		var montant = $("#montant").val();

		var url = 'controller/ajax/achat/setAchat.php';

		$.post(url,{ nomProd:nomProd, pu1:pu1 , qt1:qt1, montant:montant},function(data){
			$('.notifAdd').html(data);
		})
	})
})
/*

	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var idAch = id;
			
			var url = 'controller/ajax/achat/deleteAchat.php';
			$.post(url,{idAch:idAch},function(data){
				$('.notifDel').html(data);
			})
		})
	})


	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/achat/getAchat.php';

		$.post(url,{idAch:id},function(data){
			$('.notifEdit').html(data);
		})
	})


	$("#editForm").submit(function(e){
		e.preventDefault();

		var idAch = $("#idAch").val();
		var design = $("#designEd").val();
		var qte = $("#qteEd").val();
		var dateAchat = $("#dateAchatEd").val();

		var url = 'controller/ajax/achat/updateAchat.php';

		$.post(url,{idAch:idAch,design:design, qte:qte, dateAchat:dateAchat},function(data){
			$('.notifUpdate').html(data);
		})
	})




	$(".livraison").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/achat/getAchatLivraison.php';

		$.post(url,{idAch:id},function(data){
			$('.notifLivraison').html(data);
		})
	})


	$("#livraisonForm").submit(function(e){
		e.preventDefault();

		var idAch = $("#idAch").val();
		var numChauf = $("#numChauf").val();

		var url = 'controller/ajax/achat/livraison.php';

		$.post(url,{idAch:idAch,numChauf:numChauf},function(data){
			$('.notifUpdate').html(data);
		})
	})
})