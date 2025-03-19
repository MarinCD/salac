<?php 
    if(isset($_GET["notif"])){
        $notif = htmlentities($_GET["notif"]);
    } 
    else {
        $notif = "defaut";
    }
    // Gestion des notifications
    $notifs =[
        "badlogin" => [
            "message" =>"Le login et/ou le mot de passe est incorrect", 
            "couleur"=> "danger"
        ],
        "mustconnect" => [
            "message" =>"Connexion obligatoire pour accéder aux pages d'administration", 
            "couleur"=> "warning"
        ],
        "disconnect" => [
            "message" =>"Deconnexion réussie", 
            "couleur"=> "success"
        ],
        "defaut" => [
            "message" =>"", 
            "couleur"=> "white"
        ]
    ];
    $notif = (array_key_exists($notif, $notifs) ? $notif : "defaut");

?>
<main class="container pt-3 ">
	<h1 class="text-start text-dark">
        <i class="bi bi-person-circle"></i>
		Authentification
	</h1>
	<hr>
    <div class="alert alert-<?php echo $notifs[$notif]["couleur"]; ?>" role="alert">
        <?php echo $notifs[$notif]["message"]; ?>
    </div>
    <form action="./ad_login_exe.php" method="post" class="mt-4">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-warning">Se connecter</button>
            </div>
        </div>
    </form>

</main>