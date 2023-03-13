$(document).ready(function(){
	
	$("#produitForm").submit(function(e){
		e.preventDefault();

		var design = $("#design").val();
		var qte = $("#qte").val();
		var peremption = $("#peremption").val();
		var pu = $("#pu").val();
		var numU = $("#numU").val();

		var url = 'controller/ajax/produit/setProd.php';

		$.post(url,{design:design, qte:qte,peremption:peremption, pu:pu, numU:numU},function(data){
			$('.notifAdd').html(data);
		})
	})


	$(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var refProd = id;
			
		var url = 'controller/ajax/produit/deleteProd.php';

		$.post(url,{refProd:refProd},function(data){
			$('.notifDel').html(data);
		})
		})
	})


	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');

		var url = 'controller/ajax/produit/getProd.php';

		$.post(url,{refProd:id},function(data){
			$('.notifEdit').html(data);
		})
	})


	$("#editForm").submit(function(e){
		e.preventDefault();

		var refProd = $("#refProd").val();
		var numU = $("#numUEd").val();
		var design = $("#designEd").val();
		var qte = $("#qteEd").val();
		var peremption = $("#peremptionEd").val();
		var pu = $("#puEd").val();

		var url = 'controller/ajax/produit/updateProd.php';
		$.post(url,{refProd:refProd, numU:numU, design:design, qte:qte, peremption:peremption, pu:pu},function(data){
			$('.notifUpdate').html(data);
		})
	})
})