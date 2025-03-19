<?php
	require("ad_estconnecte_exe.php"); //Gestion de connexion
?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		<i class="bi bi-newspaper"></i>
		Gestion des actualités - Ajout d'une actualité
	</h1>
	<hr>
	<form action="ad_actu_ajout_exe.php" method="post" class="p-3 mb-4">
		<div class="row">
			<div class="col">
				<label for="TitreActu" class="form-label">Titre de l'actualité </label>
				<input 	name="txtTitre" id="TitreActu" type="text" class="form-control" required>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="DescriptionActu" class="form-label">Description </label>
				<textarea name="txtDescription" id="DescriptionActu" class="form-control" required rows="7">
				</textarea>
			</div>
		</div>	
		<div class="row mt-3">
			<div class="col-3">
				<label for="DateDebut" class="form-label">Date début</label>
				<input type="date" name="txtDateDeb" id="DateDebut" type="text" class="form-control" required>
			</div>
			<div class="col-3">
				<label for="DateFin" class="form-label">Date fin</label>
				<input type="date" name="txtDateFin" id="DateFin" type="text" class="form-control" required>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="ImgActu" class="form-label">Image actualité </label>
				<input 	name="txtImg" id="ImgActu" type="text" class="form-control" required>
			</div>
		</div>	
		<div class="row mt-3">
			<div class="col-10">
				<br>
				<input type="checkbox" class="form-check-input" name="chkImportance"> Important
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