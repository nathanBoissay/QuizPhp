<?php
session_start();

require("connexionBD.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement des données du formulaire
    $connexion = connect_bd();


    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['mdp'] = $_POST['mdp'];


    $user = "SELECT * FROM USER";

    foreach ($connexion->query($user) as $row) {
        $mail = $row["EMAIL"];
        $mdp = $row["PASSWORD"];
        if ($mail == $_POST['mail'] && $mdp == $_POST['mdp']) {
            // Rediriger vers la page d'affichage des questionnaires après la connexion réussie
            header("Location: affichageQuestionnaire.php");
            exit;
        }
    }

    // Rediriger vers la page de connexion en cas d'échec
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/Bandeau.css">
    <link rel="stylesheet" href="../css/Connexion.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
     <header class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h1>Bienvenue sur notre Quiz</h1>
     </header>
     <main>
        <section>
            <form action="" method="POST">
                <div id="info">
                    <h2>Entrez vos identifiants</h2>
                    <input id="infos" class="form-control" name="mail" type="text" placeholder="Ex:user@gmail" required value="">
                    <input id="infos" class="form-control" name="mdp" type="password" placeholder="Mot de passe = 24680" required value="">
                </div>
                <input id="valid" class="btn btn-lg btn-primary" type="submit" value="Se connecter">
            </form>
        </section>
     </main>
</body>
</html>
