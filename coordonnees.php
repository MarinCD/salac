<?php
$notif = (isset($_GET["notif"])) ? $_GET["notif"] : "defaut";
$notifications = [
	"ajoutok" => [
		"message" => "Votre demande à bien été envoyée",
		"couleur" => "success"
	],
	"ajoutko" => [
		"message" => "L'envoie de votre demande ne s'est pas effectuée correctement !",
		"couleur" => "danger"
	],
	"RGPDKO" => [
		"message" => "La politique de confidentialité n'a pas été validé",
		"couleur" => "danger"
	],
	"defaut" => [
		"message" => "",
		"couleur" => "white"
	]
];
$notif = (array_key_exists($notif, $notifications) ? $notif : "defaut");

?>



<main class="container pt-3 ">
	<h1 class="text-center text-dark">
		Coordonnées
	</h1>
	<hr>

	<div class="row">
		<div class="col">
			<div class="card mb-3">
				<div class="row g-0">
					<div class="col-md-1">
						<img src="./photos/logoSALAC.png" class="img-fluid rounded-start m-1" style="max-height: 8em"
							alt="logo">
					</div>
					<div class="col-md-4 align-self-center">
						<div class="card-body ">
							<h4 class="card-title">
								SA LAC
							</h4>
							<p class="card-text">38 rue de la rivière bruyante<br>29150 CHATEAULIN</p>
						</div>
					</div>
					<div class="col-md-4 align-self-center">
						<div class="card-body border-start">
							<h6 class="card-subtitle text-muted pb-4">
								<i class="bi bi-telephone-fill text-success"></i>
								+33 298 865 8900
							</h6>
							<h6 class="card-subtitle text-muted ">
								<i class="bi bi-envelope-fill text-success"></i>
								contact@salac2022.bzh
							</h6>

						</div>
					</div>
					<div class="col-md-3 align-self-center">
						<div class="card-body border-start">
							<h6 class="card-subtitle text-muted pb-3">
								<i class="bi bi-twitter text-info"></i>
								@salac2022
							</h6>
							<h6 class="card-subtitle text-muted pb-3">
								<i class="bi bi-facebook text-primary"></i>
								salac2022
							</h6>
							<h6 class="card-subtitle text-muted ">
								<i class="bi bi-instagram text-danger"></i>
								@salac2022
							</h6>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Gestion des notifications -->
	<div class="alert alert-<?php echo $notifications[$notif]["couleur"] ?>" role="alert">
		<?php echo $notifications[$notif]["message"] ?>
	</div>

	<h3 class="text-primary p-2 mb-0 mt-1">Informations complémentaires</h3>
	<form action="coordonnees_exe.php" method="post" class="bg-secondary bg-opacity-10 p-3 mb-4">
		<div class="row">
			<div class="col">
				<label for="Nom" class="form-label text-primary">Nom </label>
				<input id="Nom" name="Nom" type="text" class="form-control" required>

			</div>
			<div class="col">
				<label for="Prenom" class="form-label  text-primary">Prénom</label>
				<input id="Prenom" name="Prenom" type="text" class="form-control" required>

			</div>
		</div>

		<div class="row">
			<div class="col">
				<label for="email" class="form-label text-primary">Email </label>
				<input id="email" name="email" type="email" class="form-control" required>

			</div>
			<div class="col">
				<label for="tel" class="form-label  text-primary">Téléphone</label>
				<input id="tel" name="tel" type="tel" class="form-control">

			</div>
		</div>

		<div class="row">
			<div class="col">
				<label for="adress" class="form-label text-primary">Adresse </label>
				<input id="adress" name="adress" type="text" class="form-control">
			</div>
		</div>

		<div class="row">
			<div class="col-9">
				<label for="ville" class="form-label text-primary">Ville </label>
				<input id="ville" name="ville" type="text" class="form-control">

			</div>
			<div class="col-3">
				<label for="Codepost" class="form-label  text-primary">Code Postal</label>
				<input id="Codepost" name="Codepost" type="text" class="form-control">

			</div>
		</div>


		<div class="row mt-3">
			<div class="col">
				<label for="lstDoc" class="form-label text-primary">Vous désirez de la documentation sur :</label>
				<!-- </div> -->
				<!-- <div class="col"> -->
				<select name="lstDoc" id="lstDoc" class="form-select" required>
					<?php $value = 1; ?>
					<?php foreach ($residences as $residence) { ?>
						<option value="<?php echo $value++ ?>">La résidence
							<?php echo htmlentities($residence["nomResidence"]) ?>
						</option>
					<?php } ?>
					<option value="<?php echo $value++ ?>">Nos conditions générales</option>
				</select>
			</div>

		</div>
		<div class="row mt-3">
			<div class="col">
				<label for="question" class="form-label  text-primary" required>Votre question ici :</label>
				<textarea id="question" name="question" class="form-control" rows="3"></textarea>

			</div>
		</div>

		<div class="row mt-3">
			<div class="col">
				<label>
					<input type="checkbox" name="consent" required>
					J’accepte le traitement de mes données pour cette demande. <a role="button" class="text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Politique de confidentialité  </a>
				</label>
			</div>
		</div>
		<div class="row mt-3">

						
			<div class="col text-center">
				<!-- Button trigger modal -->
				<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					Envoyer <i class="bi bi-send-fill"></i>
				</button> -->
				<button class="btn btn-primary " type="submit">
							Envoyer&nbsp;
							<i class="bi bi-send-fill"></i>
						</button>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Politique de confidentialité</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Nous prenons la confidentialité de vos informations personnelles au sérieux. Cette politique
							de confidentialité explique comment nous collectons, utilisons et protégeons les
							informations que vous nous fournissez via notre formulaire.</p>

						<h3>1. Responsable du traitement des données</h3>
						<p>Le responsable du traitement de vos données est :</p>
						<ul>
							<li><strong>Nom de l'organisation :</strong> SALAC </li>
							<li><strong>Adresse :</strong> 38 rue de la rivière bruyante 29150 CHATEAULIN</li>
							<li><strong>Contact :</strong> +33 298 865 8900 ou contact@salac2022.bzh </li>
						</ul>

						<h3>2. Données collectées</h3>
						<p>Nous collectons et traitons les données suivantes :</p>
						<ul>
							<li>Nom et prénom</li>
							<li>Adresse e-mail</li>
							<li>Téléphone</li>
							<li>Adresse postale (incluant la ville et le code postal)</li>
							<li>Votre message ou question</li>
						</ul>

						<h3>3. Finalité du traitement des données</h3>
						<p>Vos données personnelles sont recueillies aux fins suivantes :</p>
						<ul>
							<li>Répondre à votre question ou demande d’information.</li>
							<li>Communiquer des informations pertinentes sur nos services.</li>
							<li>Améliorer notre service client et nos offres.</li>
						</ul>

						<h3>4. Base légale du traitement</h3>
						<p>Le traitement de vos données est basé sur votre <strong>consentement</strong> que vous
							exprimez en remplissant et envoyant le formulaire. Vous pouvez retirer votre consentement à
							tout moment en nous contactant à l’adresse suivante : contact@salac2022.bzh.</p>

						<h3>5. Partage des données personnelles</h3>
						<p>Les informations collectées via ce formulaire sont strictement réservées à un usage interne.
							Elles ne seront ni vendues, ni partagées avec des tiers, sauf dans les cas suivants :</p>
						<ul>
							<li>Pour des raisons de maintenance et de sécurité, auprès de prestataires autorisés et
								soumis aux mêmes exigences de confidentialité.</li>
							<li>Si requis par la loi ou par une autorité légale.</li>
						</ul>

						<h3>6. Durée de conservation des données</h3>
						<p>Les données sont conservées pour une durée ne dépassant pas celle nécessaire au traitement de
							votre demande. Au-delà, elles seront supprimées ou archivées conformément aux obligations
							légales.</p>

						<h3>7. Sécurité des données</h3>
						<p>Nous mettons en place des mesures techniques et organisationnelles pour garantir la sécurité
							de vos données et prévenir leur accès non autorisé, leur modification ou leur divulgation.
							Ces mesures incluent chiffrement des données, contrôle d’accès, audits de
							sécurité.</p>

						<h3>8. Vos droits</h3>
						<p>Conformément au RGPD, vous disposez des droits suivants :</p>
						<ul>
							<li><strong>Droit d’accès</strong> : Obtenir une copie de vos données personnelles traitées.
							</li>
							<li><strong>Droit de rectification</strong> : Corriger toute information inexacte ou
								incomplète.</li>
							<li><strong>Droit à l’effacement</strong> : Demander la suppression de vos données sous
								certaines conditions.</li>
							<li><strong>Droit de limitation</strong> : Limiter temporairement le traitement de vos
								données.</li>
							<li><strong>Droit d’opposition</strong> : Vous opposer au traitement de vos données dans
								certains cas.</li>
							<li><strong>Droit à la portabilité</strong> : Recevoir une copie de vos données dans un
								format lisible par machine pour les transmettre à un autre responsable de traitement.
							</li>
						</ul>
						<p>Pour exercer ces droits, contactez-nous à [adresse e-mail de contact]. Nous nous engageons à
							répondre dans un délai d’un mois.</p>

						<h3>9. Modification de la politique de confidentialité</h3>
						<p>Cette politique peut être mise à jour pour refléter les changements de la réglementation ou
							de nos pratiques internes. Nous vous encourageons à consulter cette page régulièrement pour
							rester informé.</p>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
						<!-- <button class="btn btn-primary " type="submit">
							Envoyer&nbsp;
							<i class="bi bi-send-fill"></i>
						</button> -->
					</div>
				</div>
			</div>
		</div>



	</form>




</main>