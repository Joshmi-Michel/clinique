$(document).ready(function(){
	$("#stockForm").submit(function(e){
		e.preventDefault();

		var refProd = $("#refProd").val();
		var qte = $("#qte").val();
		var peremption = $("#datePeremption").val();

		var url = 'controller/ajax/stock/reaprov.php';

		$.post(url,{refProd:refProd, qte:qte , peremption:peremption},function(data){
			$('.notifAdd').html(data);
		})
	})

	$(".editLec").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');
		var url = 'controller/ajax/stock/getStock.php';
		$.post(url,{refProd:id},function(data){
			$('.notifEdit').html(data);
		})
	})

	$("#editForm").submit(function(e){
		e.preventDefault();
		var refProd = $("#refProdEd").val();
		var design = $("#designEd").val();
		var qte = $("#qteEd").val();
		var pu = $("#puEd").val();
		var url = 'controller/ajax/stock/updateStock.php';
		$.post(url,{refProd:refProd,design:design, qte:qte, pu:pu},function(data){
			$('.notifUpdate').html(data);
		})
	})
})