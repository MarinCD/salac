<?php
	require("ad_estconnecte_exe.php"); //Gestion de connexion
?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
		Administration du site
	</h1>
	<hr>

    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="col d-flex align-items-start">
            <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <h3><i class="bi bi-building"></i></h3>
            </div>
            <div>
                <h3 class="fs-2">Gestion des résidences</h3>
                <p>Gérer les résidences et les appartements/studios associées aux résidences</p>
                <a href="./index.php?page=ad_res_main" class="btn btn-secondary">
                    Gestion résidences
                </a>
            </div>
        </div>
        <div class="col d-flex align-items-start">
            <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <h3><i class="bi bi-newspaper"></i></h3>
            </div>
            <div>
                <h3 class="fs-2">Gestion des actualités</h3>
                <p>Administrer les actualités sur la page d'accueil du site</p>
                <a href="./index.php?page=ad_actu_main" class="btn btn-secondary">
                Gestion actualités
                </a>
            </div>
        </div>
      
    </div>
</main>