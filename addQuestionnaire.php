<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Création d'un Questionnaire</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<?php

require("connexionBD.php");

$connexion = connect_bd();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['NomQuestionnaire'], $_GET['ThemeQuestionnaire'], $_GET['NombreQuestion'])) {
        $nomQuestionnaire = $_GET['NomQuestionnaire'];
        $themeQuestionnaire = $_GET['ThemeQuestionnaire'];
        $nombreQuestion = $_GET['NombreQuestion'];

        $sqlCheck = "SELECT * FROM QUESTIONNAIRE WHERE NOMQuestionnaire = :NomQuestionnaire AND ThemeQuestionnaire = :ThemeQuestionnaire";
        $stmtCheck = $connexion->prepare($sqlCheck);
        $stmtCheck->bindValue(':NomQuestionnaire', $nomQuestionnaire);
        $stmtCheck->bindValue(':ThemeQuestionnaire', $themeQuestionnaire);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() === 0) {
            echo "<h1>Création du Questionnaire </h1>";
            
            $sqlInsert = "INSERT INTO QUESTIONNAIRE VALUES(0, :NomQuestionnaire, :ThemeQuestionnaire, :NombreQuestion)";
            $stmtInsert = $connexion->prepare($sqlInsert);
            $stmtInsert->bindParam(':NomQuestionnaire', $nomQuestionnaire);
            $stmtInsert->bindParam(':ThemeQuestionnaire', $themeQuestionnaire);
            $stmtInsert->bindValue(':NombreQuestion', $nombreQuestion);
            $stmtInsert->execute();

            if ($stmtInsert) {
                echo "Le Questionnaire a bien été ajouté";

                $sqlSelect = "SELECT * FROM QUESTIONNAIRE WHERE NOMQuestionnaire = :NomQuestionnaire AND ThemeQuestionnaire = :ThemeQuestionnaire";
                $stmtSelect = $connexion->prepare($sqlSelect);
                $stmtSelect->bindValue(':NomQuestionnaire', $nomQuestionnaire);
                $stmtSelect->bindValue(':ThemeQuestionnaire', $themeQuestionnaire);
                $stmtSelect->execute();

                foreach ($stmtSelect as $row) {
                  header("Refresh:1; /addQuestions.php?IDQUESTIONNAIRE=".$row["IDQUESTIONNAIRE"]."&NOMQUESTIONNAIRE=".$_GET['NomQuestionnaire']."&THEMEQUESTIONNAIRE=".$_GET['ThemeQuestionnaire']."&NOMBREQUESTION=".$_GET['NombreQuestion']."");                    exit;
                }
            } else {
                echo "<p>Problème de Requête</p>";
            }
        } else {
            echo "Ce questionnaire existe déjà";
        }
    }
}
?>

<form name="ajout" action="" method="GET">
    <fieldset>
        <legend>Nouveau Questionnaire</legend>

        <p> NomQuestionnaire : 
            <input type="text" name="NomQuestionnaire" pattern="[a-zA-Z\s]{2,100}"
                required title="Entrez ici votre nom de Quiz" placeholder="Quiz sur Pirates de Shurima">
        </p>
        <p> ThemeQuestionnaire : 
            <input type="text" name ="ThemeQuestionnaire" 
                pattern="[a-zA-Z\ \-]{2,25}" 
                required title="Entrez ici le theme du quiz" placeholder="Films,Series">
        </p>

        <p> NOMBRE : 
            <input type="text" name ="NombreQuestion" 
                pattern="[0-9]{1,2}" 
                required title="Entrez ici le nombre de questions que vous souhaitez créer" placeholder="5,10,1,2">
        </p>

        <p><input type="submit" value="Ajouter"> </p>
    </fieldset>
</form>

</body>
</html>
