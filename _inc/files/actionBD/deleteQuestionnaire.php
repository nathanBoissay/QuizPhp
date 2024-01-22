<?php
    namespace files\BD;
	use \PDO;
	use \PDOException;
?>
<!doctype html>
<html>
<head>
<title>
Inscription d'une personne 
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>
<body>

<?php

require("../BD/connexionBD.php");
// pour oracle: $dsn="oci:dbname=//serveur:1521/base
// pour sqlite: $dsn="sqlite:/tmp/base.sqlite"
$wanted=$_GET['IDQUESTIONNAIRE']; 
if (!empty($wanted)){
  echo "<h1> Suppression du quiz  $wanted </h1>";
    $connexion=connect_bd();

    $sql="SELECT * from QUESTIONNAIRE where IDQUESTIONNAIRE=:IDQUESTIONNAIRE";

    $stmt=$connexion->prepare($sql);
    $stmt->bindValue(':IDQUESTIONNAIRE',$wanted); 
    $stmt->execute();

    if ($stmt->rowCount()==1){

        $sql2="SELECT * from QUESTION where IDQUESTIONNAIRE=:IDQUESTIONNAIRE";

        $stmt2=$connexion->prepare($sql2);
        $stmt2->bindValue(':IDQUESTIONNAIRE',$wanted); 
        $stmt2->execute();
        foreach($stmt2 as $row) { 
            $id_question=$row['IDQUESTION'];
    
            if ($stmt2->rowCount()>0){
                $sql3="SELECT * from REPONSE where IDQUESTION=:IDQUESTION";

                $stmt3=$connexion->prepare($sql3);
                $stmt3->bindValue(':IDQUESTION',$id_question);
                $stmt3->execute();
                if ($stmt3->rowCount()>0){
                    echo "<h1>Suppression des reponses </h1>";
                    // Supprime les reponses de la question de la base de données
                    $sql4 = "DELETE FROM REPONSE WHERE IDQUESTION = :IDQUESTION";
                    $stmt4 = $connexion->prepare($sql4);
                    $stmt4->bindValue(':IDQUESTION', $id_question); 
                    $stmt4->execute();
                }
            }
            
        }
        echo "<h1>Suppression des Questions </h1>";
        // Supprime les scores liés au questionnaire de la base de données
        $sql6 = "DELETE FROM SCORE WHERE IDQUESTIONNAIRE = :IDQUESTIONNAIRE";
        $stmt6 = $connexion->prepare($sql6);
        $stmt6->bindValue(':IDQUESTIONNAIRE', $wanted); 
        $stmt6->execute();

        echo "<h1>Suppression des Questions </h1>";
        // Supprime les questions liées au questionnaire de la base de données
        $sql5 = "DELETE FROM QUESTION WHERE IDQUESTIONNAIRE = :IDQUESTIONNAIRE";
        $stmt5 = $connexion->prepare($sql5);
        $stmt5->bindValue(':IDQUESTIONNAIRE', $wanted); 
        $stmt5->execute();

        echo "<h1>Suppression du Questionnaire </h1>";
        // Supprime le questionnaire de la base de données
        $sql = "DELETE FROM QUESTIONNAIRE WHERE IDQUESTIONNAIRE = :IDQUESTIONNAIRE";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':IDQUESTIONNAIRE', $wanted); 
        $stmt->execute();


        
            



        echo "<h1>Suppression du Questionnaire effectuée avec succès</h1>";
        header('Location: ../view/affichageQuestionnaire.php');
    } else {
        echo "<h1>Le Questionnaire que vous essayez de supprimer n'existe pas</h1>";
       


    }
}
?>
</body>
</html>