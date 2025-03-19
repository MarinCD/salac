<?php
	require("ad_estconnecte_exe.php");
	// var_dump($_SESSION);
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	
    $sql = "SELECT idActualite, titre, dateDebut, dateFin, importance
            FROM actualites
            ORDER BY dateDebut;";
    // echo $sql."<br>"; // test de la requête
    $reponse = $bdd->prepare($sql);
	$reponse -> execute();
    $actualites = $reponse->fetchall(PDO::FETCH_ASSOC); // fetchall : on récupère TOUTES les actualités
	// var_dump($actualites);
	$notif = (isset($_GET["notif"])) ? $_GET["notif"] : "defaut";
	$notifications = [
        "supok" => [
            "message" => "La suppression d'une actualité a été correctement effectuée",
            "couleur" => "success"
		],
		"supko" => [
            "message" => "La suppression d'une actualité ne s'est pas effectuée correctement !",
            "couleur" => "danger"
		],
		"ajoutok" => [
            "message" => "L'ajout d'une actualité a été correctement effectuée",
            "couleur" => "success"
		],
		"ajoutko" => [
            "message" => "L'ajout d'une actualité ne s'est pas effectuée correctement !",
            "couleur" => "danger"
		],
		"modifok" => [
            "message" => "La modification d'une actualité a été correctement effectuée",
            "couleur" => "success"
		],
		"modifko" => [
            "message" => "La modification d'une actualité ne s'est pas effectuée correctement !",
            "couleur" => "danger"
		],
		"defaut" => [
            "message" =>"", 
            "couleur"=> "white"
        ]
    ];
	$notif = (array_key_exists($notif, $notifications) ? $notif : "defaut");

?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		<i class="bi bi-newspaper"></i>
		Gestion des actualités
        <a href="./index.php?page=ad_actu_ajout">
			<i class="bi bi-plus-circle-fill text-success"></i>
		</a>
	</h1>
	<hr>

	<!-- Gestion des notifications -->
	<div class="alert alert-<?php echo htmlentities($notifications[$notif]["couleur"])?>" role="alert">
        <?php echo $notifications[$notif]["message"]?>
    </div>
	<table class="table table-striped mt-4">
        <thead class="table-dark">
            <tr class="text-center">
				<th>Titre</th>
				<th>Date début</th>
				<th>Date fin</th>
                <th>Important</th>
				<th>Modif</th>
				<th>Supp.</th>
            </tr>
        </thead>
        <tbody>
<!-- Partie dynamique du tableau -->
<?php		foreach($actualites as $actualite){

?>
				<tr>
					<td><?php echo htmlentities($actualite['titre'] )?></td>
					<td><?php echo htmlentities($actualite['dateDebut'] )?></td>
					<td><?php echo htmlentities($actualite['dateFin'] )?></td>
                    <td class="text-center">
                        <i class="bi bi-<?php echo ($actualite['importance'] == 1) ? "check-" : "" ?>circle"></i>
					</td>
					<td class="text-center">
						<a href="./index.php?page=ad_actu_modif&idActualite=<?php echo htmlentities($actualite['idActualite']) ?>">
							<i class="bi bi-pencil-fill text-info"></i>
							</a>
					</td>
					<td class="text-center">
						<a href="ad_actu_sup_exe.php?idActualite=<?php echo htmlentities($actualite['idActualite'] )?>">
							<i class="bi bi-x-circle-fill text-danger"></i>
						</a>
					</td>
				</tr>
<?php       }
?>
        </tbody>
    </table>

</main>