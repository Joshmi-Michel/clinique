<?php 
	require_once '../../../config/db.php';

	function setUsine($nomU,$telU,$mailU){
		global $db;

		$nomU = htmlspecialchars(trim($nomU));
		$telU = htmlspecialchars(trim($telU));
		$mailU = htmlspecialchars(trim($mailU));

		$sql = "INSERT INTO usine (nomU,telU,mailU) VALUES (?,?,?)";
		$req = $db->prepare($sql);
		$req->execute([$nomU,$telU,$mailU]);
	}


	if (!empty($_POST['nomU']) && !empty($_POST['telU']) ) {
		 $errors = [];
		 extract($_POST);	 
		 	if (!empty($_POST['mailU'])) {

			 	setUsine($nomU,$telU,$mailU);
			 	setFlash('Ajout avec success');

				?>
				<script type="text/javascript">
					window.location.replace('?page=usine');
				</script>
				<?php
		 	} else {
		 		$errors[] = "Veuillez remplir tous les champs";
		 	}
		 	
		 
	} else {
		$errors[] = "Veuillez remplir tous les champs";
	}
	
 ?>
<?php 
	if (!empty($errors)) {
		foreach ($errors as $error) {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <?= $error ?>
		</div>
		<?php
		}
	} 
 ?>
