<?php
	require("ad_estconnecte_exe.php"); //Gestion de connexion
	$idResidence = $_GET["idResidence"];
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	
	$sql = "SELECT nomResidence, adresseResidence, villeResidence, cpResidence, classResidence, ascResidence, parkResidence, photoResidence
			FROM residences
			WHERE idResidence = :idResidence;";
	$reponse = $bdd->prepare($sql);
	$reponse ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
	$reponse ->execute();
	$residence = $reponse->fetch(PDO::FETCH_ASSOC); // fetch : on récupère un seul enregistrement
	$chkAsc = $residence["ascResidence"] == 1 ? "checked" : "";
	$chkPark = $residence["parkResidence"] == 1 ? "checked" : "";
?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		<i class="bi bi-building"></i>
		Gestion des résidences - Modification de la résidence n° <?php echo htmlentities($idResidence)." : ".htmlentities($residence["nomResidence"]) ?>
	</h1>
	<hr>
	<form action="ad_res_modif_exe.php" method="post" class="p-3 mb-4">
		<input 	name="hidId" type="hidden"
				value="<?php echo htmlentities($idResidence) ?>">
		<div class="row">
			<div class="col">
				<label for="NomRes" class="form-label">Nom de la résidence </label>
				<input 	name="txtNom" id="NomRes" type="text" class="form-control" required
						value="<?php echo htmlentities($residence["nomResidence"]) ?>">
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="RueRes" class="form-label">Rue </label>
				<input 	name="txtRue" id="RueRes" type="text" class="form-control" required
						value="<?php echo htmlentities($residence["adresseResidence"] )?>">
			</div>
		</div>		
		<div class="row mt-3">
			<div class="col-3">
				<label for="CPRes" class="form-label">Code postal</label>
				<input 	name="txtCP" id="CPRes" type="text" class="form-control" required
						value="<?php echo htmlentities($residence["cpResidence"]) ?>">
			</div>
			<div class="col-9">
				<label for="VilleRes" class="form-label">Ville</label>
				<input 	name="txtVille" id="VilleRes" type="text" class="form-control" required
						value="<?php echo htmlentities($residence["villeResidence"] )?>">
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="ImgRes" class="form-label">Image résidence </label>
				<input 	name="txtImg" id="ImgRes" type="text" class="form-control" required
						value="<?php echo htmlentities($residence["photoResidence"]) ?>">
			</div>
		</div>	
		<div class="row mt-3">
			<div class="col-2">
				<label for="ClasRes" class="form-label">Classement</label>
				<input 	name="nbrClasse" id="ClasRes" type="number" min="0" max="5" class="form-control" required
						value="<?php echo htmlentities($residence["classResidence"] )?>">
			</div>
			<div class="col-10">
				<br>
				<input 	type="checkbox" class="form-check-input" name="chkParking" 
						<?php echo htmlentities($chkPark) ?>
				> Parking
				<br>
				<input 	type="checkbox" class="form-check-input" name="chkAscenseur" 
						<?php echo htmlentities($chkAsc) ?>
				> Ascenseur
			</div>
		</div>
	

		<div class="row mt-3">
			<div class="col text-start">
				<button class="btn btn-primary" type="submit">
					Modifier
				</button>
			</div>
		</div>

	</form>
</main>