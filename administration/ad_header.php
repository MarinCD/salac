<?php
	session_start(); //permet d'utiliser les variables sessions
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<script src="../bootstrap/js/bootstrap.js"></script>
	<title>administration d'appartement</title>
</head>

<body class="d-flex flex-column min-vh-100">
	<header>
		<nav class="navbar navbar-expand navbar-dark bg-dark bg-gradient">
			<div class="container">
				<a class="navbar-brand" href="../">
					<img src="../photos/logoSALAC.png" alt="logo" height="75" class="d-inline-block align-text-middle">
					SA LAC - Administration
                </a>
<?php			if(isset($_SESSION["login"])) {  //on est connecté
?>
                <ul class="navbar-nav me-auto mb-1 ms-1">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($page, 'res') > 0) ? "active" : "" ?>" href="./index.php?page=ad_res_main">
                            <i class="bi bi-building"></i>
                            Gestion des résidences
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($page, 'actu') > 0) ? "active" : "" ?>" href="./index.php?page=ad_actu_main">
                            <i class="bi bi-newspaper"></i>
                            Gestion des actualités
                        </a>
                    </li>
					</ul>
					<a class="btn btn-warning" href="ad_deconnect_exe.php" role="button">
						<?php echo $_SESSION["login"] ?>
						<i class="bi bi-box-arrow-right"></i>
					</a>
<?php			} else {  // on n'est pas connecté
?>
					<a class="btn btn-outline-light" href="index.php?page=ad_login" role="button">
						Login
					</a>
<?php 			}
?>
			</div>
		</nav>
	</header>