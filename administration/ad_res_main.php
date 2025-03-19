<?php
	require("ad_estconnecte_exe.php");
	// var_dump($_SESSION);
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	
    $sql = "SELECT idResidence, nomResidence, villeResidence
            FROM residences
            ORDER BY nomResidence;";
    // echo $sql."<br>"; // test de la requête
    $reponse = $bdd->prepare($sql);
	$reponse -> execute();
    $residences = $reponse->fetchall(PDO::FETCH_ASSOC); // fetchall : on récupère TOUTES les résidences
	// var_dump($residences);
	$notif = (isset($_GET["notif"])) ? $_GET["notif"] : "defaut";
	$notifications = [
        "supok" => [
            "message" => "La suppression d'une résidence a été correctement effectuée",
            "couleur" => "success"
		],
		"supko" => [
            "message" => "La suppression d'une résidence ne s'est pas effectuée correctement !",
            "couleur" => "danger"
		],
		"ajoutok" => [
            "message" => "L'ajout d'une résidence a été correctement effectuée",
            "couleur" => "success"
		],
		"ajoutko" => [
            "message" => "L'ajout d'une résidence ne s'est pas effectuée correctement !",
            "couleur" => "danger"
		],
		"modifok" => [
            "message" => "La modification d'une résidence a été correctement effectuée",
            "couleur" => "success"
		],
		"modifko" => [
            "message" => "La modification d'une résidence ne s'est pas effectuée correctement !",
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
		<i class="bi bi-building"></i>
		Gestion des résidences &nbsp;&nbsp;
		<a href="./index.php?page=ad_res_ajout">
			<i class="bi bi-plus-circle-fill text-success"></i>
		</a>
	</h1>
	<hr>
	<!-- Gestion des notifications -->
	<div class="alert alert-<?php echo $notifications[$notif]["couleur"]?>" role="alert">
        <?php echo $notifications[$notif]["message"]?>
    </div>
	<table class="table table-striped mt-4">
        <thead class="table-dark">
            <tr class="text-center">
				<th>Résidence</th>
				<th>Ville</th>
				<th>Appart/studios</th>
				<th>Modif</th>
				<th>Supp.</th>
            </tr>
        </thead>
        <tbody>
<!-- Partie dynamique du tableau -->
<?php		foreach($residences as $residence){
?>
				<tr>
					<td><?php echo htmlentities($residence['nomResidence'] )?></td>
					<td><?php echo htmlentities($residence['villeResidence']) ?></td>
					<td class="text-center">
						<a href="index.php?page=ad_res_apparts&idResidence=<?php echo htmlentities($residence['idResidence'] )?>">
							<i class="bi bi-building text-success"></i>
						</a>
					</td>
					<td class="text-center">
						<a href="./index.php?page=ad_res_modif&idResidence=<?php echo htmlentities($residence['idResidence']) ?>">
							<i class="bi bi-pencil-fill text-info"></i>
							</a>
					</td>
					<td class="text-center">
						<a href="ad_res_sup_exe.php?idResidence=<?php echo htmlentities($residence['idResidence'] )?>">
							<i class="bi bi-x-circle-fill text-danger"></i>
						</a>
					</td>
				</tr>
<?php       }
?>
        </tbody>
    </table>
    
</main>