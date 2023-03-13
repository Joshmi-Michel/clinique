$(document).ready(function(){
	
	$("#rechercheOpt").change(function(e){
		e.preventDefault();
		var $this = $(this);
		var value = $this.val();
		var result;

		switch (value) {
		    case 'year':
		        $('.year').show();
		        $('.month').hide();
		        $('.custom').hide();
		        result = 'year';
		        break;
		    case 'month':
		        $('.month').show();		        
		        $('.year').hide();		        
		        $('.custom').hide();
		        result = 'month';		        
		        break;
		    case 'custom':
		        $('.custom').show();
		        $('.month').hide();
		        $('.year').hide();
		        result = 'custom';
		        break;
		} 

		$("#debutAnnee").change(function(e){
			e.preventDefault();
			var $this = $(this);
			var val = $this.val();

			for (var i = 2000; i <= val; i++) {
				$("#"+i).remove();
			}
		})

		$("#debutMois").change(function(e){
			e.preventDefault();
			var $this = $(this);
			var val = $this.val();

			for (var i = 0; i <= val; i++) {
				$("#"+i).remove();
			}
		})

		$("#search").show();
	})

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

	$("#editForm").submit(function(e){
		e.preventDefault();

		var numPret = $("#numPret").val();
		var currentNumLivre = $("#currentNumLivre").val();
		var numLecteur = $("#numLecteurEd").attr('val');
		var numLivre = $("#numLivreEd").val();
		var datePret = $("#datePretEd").val();

		var url = 'controller/ajax/pret/updatePretRecherche.php';

		$.post(url,{numPret:numPret,currentNumLivre:currentNumLivre,numLecteur:numLecteur,numLivre:numLivre,datePret:datePret},function(data){
			$('.notifUpdate').html(data);
		})
	})

})

