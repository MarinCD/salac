<?php
	require("ad_estconnecte_exe.php"); //Gestion de connexion
	
	$idActualite = htmlentities($_GET["idActualite"]);
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "SELECT idActualite, titre, description, dateDebut, dateFin, importance, photoActualite
			FROM actualites
			WHERE idActualite = $idActualite;";
	$reponse = $bdd->query($sql);
	$actualite = $reponse->fetch(PDO::FETCH_ASSOC); // fetch : on récupère un seul enregistrement
	$chkImportance = $actualite["importance"] == 1 ? "checked" : "";
?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		<i class="bi bi-building"></i>
		Gestion des actualités - Modification d'actualité' n° <?php echo $idActualite." : ".$actualite["idActualite"] ?>
	</h1>
	<hr>
	<form action="ad_actu_modif_exe.php" method="post" class="p-3 mb-4">
		<input 	name="hidId" type="hidden"
				value="<?php echo $idActualite ?>">
		<div class="row">
			<div class="col">
				<label for="TitreActu" class="form-label">Titre de l'actualité </label>
				<input 	name="txtTitre" id="TitreActu" type="text" class="form-control" required
						value="<?php echo $actualite["titre"] ?>">
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="DescriptionActu" class="form-label">Description </label>
				<textarea name="txtDescription" id="DescriptionActu" class="form-control" required rows="7">
<?php echo $actualite["description"] ?>
				</textarea>
			</div>
		</div>		
		<div class="row mt-3">
			<div class="col-3">
				<label for="DateDebut" class="form-label">Date début</label>
				<input type="date" name="txtDateDeb" id="DateDebut" type="text" class="form-control" required
						value="<?php echo $actualite["dateDebut"] ?>">
			</div>
			<div class="col-3">
				<label for="DateFin" class="form-label">Date fin</label>
				<input type="date" name="txtDateFin" id="DateFin" type="text" class="form-control" required
						value="<?php echo $actualite["dateFin"] ?>">
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="ImgActu" class="form-label">Image actualité </label>
				<input 	name="txtImg" id="ImgActu" type="text" class="form-control" required
						value="<?php echo $actualite["photoActualite"] ?>">
			</div>
		</div>	
		<div class="row mt-3">
			<div class="col-10">
				<br>
				<input type="checkbox" class="form-check-input" name="chkImportance" 
						<?php echo $chkImportance ?>
				> Important
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