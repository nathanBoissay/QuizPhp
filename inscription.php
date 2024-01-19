<?php

// Inclure le fichier de connexion à la base de données
require("connexionBD.php");

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['tele'];
    $password = "123";
    $genre = $_POST['Genre'];

    // Connexion à la base de données
    $connexion = connect_bd();

    // Requête SQL pour vérifier si l'utilisateur existe déjà
    $checkUserSql = "SELECT COUNT(*) FROM USER WHERE EMAIL = :email";
    $checkUserStmt = $connexion->prepare($checkUserSql);
    $checkUserStmt->bindParam(':email', $email);
    $checkUserStmt->execute();
    $userExists = $checkUserStmt->fetchColumn();

    if ($userExists) {
        // L'utilisateur existe déjà, afficher un message d'erreur ou effectuer une action appropriée
        echo "Un utilisateur avec cette adresse email existe déjà.";
        exit;
    }

    // Requête SQL pour insérer les données dans la table USER
    $sql = "INSERT INTO USER (NOM, PRENOM, EMAIL, TELEPHONE, PASSWORD, SEXE) VALUES (:nom, :prenom, :email, :telephone, :password, :sexe)";

    // Préparation de la requête
    $stmt = $connexion->prepare($sql);

    // Bind des valeurs
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':sexe', $genre);

    // Exécution de la requête
    $stmt->execute();

    // Fermeture de la connexion
    $connexion = null;

    // Rediriger vers une page de confirmation ou effectuer d'autres actions nécessaires
    header("Location: connexion.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulaire Identity</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <section id="Formulaire">
            <h1>Formulaire Identity</h1>
            <form name ="f1" action="inscription.php" method="POST">
            <fieldset>
                <legend>Informations Personnelles</legend>
                <p>Nom:<input type="text" id="Nom" name="Nom" pattern="[a-z A-Z]{1,20}([-][a-z A-Z]{1,20})?" placeholder="Ex:Monsieur HERALD DE LA FAILLE"></input></p>
                <p>Prenom:<input type="text" id="Prenom"name="Prenom" pattern="[a-z A-Z]{1,20}([-][a-z A-Z]{1,20})?" placeholder="Ex:Thierry"></input></p>
                <p>Email:<input type="email" id="email" name="email" pattern="[a-z A-Z -._%]+@[a-z A-Z]+\.[a-z A-Z]{1,50}" placeholder="Ex:@gmail,@laposte"></input></p>
                <p>Telephone<input type="tel" id="tele" name="tele" pattern="[\d]{10,12}" placeholder="Ex: 0 1 2 3 4 5" title=«Entrez un telephone entre 10 et 12 chiffres »/></p>        
            </fieldset>
            <br/>
            <fieldset>
                <legend>Genre</legend>
                <p>Homme</p><input type="radio" id="Genre" name="Genre" value="H">  </input>
                <p>Femme</p><input type="radio" id="Genre" name="Genre" value="F">  </input>
            </fieldset>
            <br/>
            <input id= valider type="submit" name="Changer" value="Confirmez les Informations "  onclick =verif()></input>
        </section>
        <br/>
        

        </form>
    </body>
</html>