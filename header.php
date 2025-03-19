<?php
	require("./connect.php"); // instancie l'objet $bdd à partir de la classe PDO
    $sql = "SELECT idResidence, nomResidence
            FROM residences
            ORDER BY nomResidence;";
    // echo $sql."<br>"; // test de la requête
	$reponse = $bdd->prepare($sql);
    $reponse ->execute();
    $residences = $reponse->fetchall(PDO::FETCH_ASSOC); // fetchall : on récupère TOUTES les résidences
	// var_dump($residences);

	// if (isset($_GET["page"])){
	// 	$page=htmlentities($_GET["page"]);}
	// else{
	// 	$page="accueil";}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="./photos/logoSALAC.png" />
	<!-- <script src="bootstrap/js/bootstrap.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<title>location appartement</title>
</head>
<body class="d-flex flex-column min-vh-100">
	<header>
		<nav class="navbar navbar-expand navbar-dark bg-dark bg-gradient">
			<div class="container">
				<span class="navbar-brand" href="./index.php?page=accueil">
					<img src="./photos/logoSALAC.png" alt="logo" height="75" class="d-inline-block align-text-middle">
					SA LAC
				</span>
				<ul class="navbar-nav me-auto mb-1 ms-1">
					<li class="nav-item">
						<a class="nav-link <?php echo ($page == 'accueil') ? "active" : "" ?>" href="./index.php?page=accueil">Accueil</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($page == 'coordonnees') ? "active" : "" ?>" href="./index.php?page=coordonnees">Coordonnées</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle <?php echo ($page == 'residences') ? "active" : "" ?>" data-bs-toggle="dropdown" href="#" role="button"
							aria-expanded="false">Résidences</a>
						<ul class="dropdown-menu">
<?php						foreach($residences as $residence) {
?>
								<li>
									<a class="dropdown-item" href="./index.php?page=residences&idResidence=<?php echo htmlentities($residence["idResidence"]) ?>">
										<?php echo htmlentities($residence["nomResidence"]) ?>
									</a>
								</li>
<?php						}
?>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="./administration">Administration</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>