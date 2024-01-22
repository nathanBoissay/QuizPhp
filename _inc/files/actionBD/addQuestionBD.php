<?php
    namespace files\BD;
?>
<!doctype html>
<html>
<head>
<title>Inscription d'une personne</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<?php
require("../BD/connexionBD.php");
$connexion=connect_bd();


$idQuestionnaire = $_GET['IDQUESTIONNAIRE'];
$nomQuestion = "Question";

// Boucle pour traiter chaque question
for ($i = 1; $i <= $_GET['NOMBREQUESTION']; $i++) {
    $nomQuestion_i = $nomQuestion . $i;
    $intitule_question_i = $_GET['IntituleQuestion' . $i];
    $typeQuestionI = $_GET['TypeQuestion'];
    // Ajoutez d'autres variables pour récupérer les valeurs nécessaires pour chaque question

    // Vérifie si la question existe déjà dans la base de données
    $sqlCheck = "SELECT * FROM QUESTION WHERE IDQUESTIONNAIRE = :IDQUESTIONNAIRE AND INTITULE = :INTITULE";
    $stmtCheck = $connexion->prepare($sqlCheck);
    $stmtCheck->bindValue(':IDQUESTIONNAIRE', $idQuestionnaire);
    $stmtCheck->bindValue(':INTITULE', $intitule_question_i);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() == 0) {
        // La question n'existe pas, l'ajouter à la base de données
        $sql_insert_question = "INSERT INTO QUESTION (NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES (:NOMQUESTION, :INTITULE, :TYPEQUESTION, :IDQUESTIONNAIRE)";
        $stmtInsertQuestion = $connexion->prepare($sql_insert_question);
        $stmtInsertQuestion->bindParam(':NOMQUESTION', $nomQuestion_i);
        $stmtInsertQuestion->bindParam(':INTITULE', $intitule_question_i);
        $stmtInsertQuestion->bindParam(':TYPEQUESTION', $typeQuestionI);
        $stmtInsertQuestion->bindParam(':IDQUESTIONNAIRE', $idQuestionnaire);
        $stmtInsertQuestion->execute();

        // Récupérer l'ID de la question nouvellement ajoutée
        $idQuestionI = $connexion->lastInsertId();

        // Ajouter les réponses associées à cette question
        for ($j = 1; $j <= 3; $j++) { // Supposons que chaque question a trois réponses
            $reponseIJ = $_GET['Reponse' . $j . $i];
            $bonneReponseIJ = ($_GET['BonneReponse' . $i] == $j) ? 1 : 0;

            $sql_insert_reponse = "INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES (:NOMREPONSE, :INTITULEREPONSE, :BONNE, :IDQUESTION)";
            $stmtInsertReponse = $connexion->prepare($sql_insert_reponse);
            $stmtInsertReponse->bindParam(':NOMREPONSE', $reponseIJ);
            $stmtInsertReponse->bindParam(':INTITULEREPONSE', $reponseIJ);
            $stmtInsertReponse->bindParam(':BONNE', $bonneReponseIJ);
            $stmtInsertReponse->bindParam(':IDQUESTION', $idQuestionI);
            $stmtInsertReponse->execute();
        }

        echo "La question a bien été ajoutée avec ses réponses.<br>";
    } else {
        echo "La question avec l'intitulé '$intitule_question_i' existe déjà.<br>";
    }
}


// Redirection vers la page d'affichage des questionnaires après un certain délai
header("Location:  ../view/affichageQuestionnaire.php");

?>
</body>
</html>
