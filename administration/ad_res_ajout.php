<?php
	require("ad_estconnecte_exe.php"); //Gestion de connexion
?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		<i class="bi bi-building"></i>
		Gestion des résidences - Ajout d'une résidence
	</h1>
	<hr>
	<form action="ad_res_ajout_exe.php" method="post" class="p-3 mb-4">
		<div class="row">
			<div class="col">
				<label for="NomRes" class="form-label">Nom de la résidence </label>
				<input name="txtNom" id="NomRes" type="text" class="form-control" required>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="RueRes" class="form-label">Rue </label>
				<input name="txtRue" id="RueRes" type="text" class="form-control" required>
			</div>
		</div>		
		<div class="row mt-3">
			<div class="col-3">
				<label for="CPRes" class="form-label">Code postal</label>
				<input name="txtCP" id="CPRes" type="text" class="form-control" required>
			</div>
			<div class="col-9">
				<label for="VilleRes" class="form-label">Ville</label>
				<input name="txtVille" id="VilleRes" type="text" class="form-control" required>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="ImgRes" class="form-label">Image résidence </label>
				<input name="txtImg" id="ImgRes" type="text" class="form-control" required>
			</div>
		</div>	
		<div class="row mt-3">
			<div class="col-2">
				<label for="ClasRes" class="form-label">Classement</label>
				<input name="nbrClasse" id="ClasRes" type="number" min="0" max="5" class="form-control" required>
			</div>
			<div class="col-10">
				<br>
				<input type="checkbox" class="form-check-input" name="chkParking" > Parking
				<br>
				<input type="checkbox" class="form-check-input" name="chkAscenseur" > Ascenseur
			</div>
		</div>
	

		<div class="row mt-3">
			<div class="col text-start">
				<button class="btn btn-primary" type="submit">
					Ajouter
				</button>
			</div>
		</div>

	</form>
</main>