<?php
    namespace files\BD;
    use \PDO;
    use \PDOException;
?>
<!doctype html>
<html>
  <head>
    <title>
      Questionnaire
    </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/Bandeau.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/lancerQ.css">
  </head>
  <body>
    <?php 
      require('../BD/connexionBD.php');
      $connexion = connect_bd();
      $wanted=$_GET['IDQUESTIONNAIRE']; 

      $questionnaire = "SELECT * from QUESTIONNAIRE where IDQUESTIONNAIRE = :IDQUESTIONNAIRE";
      $stmt = $connexion->prepare($questionnaire);
      $stmt->bindParam(':IDQUESTIONNAIRE', $wanted, PDO::PARAM_INT);
      $stmt->execute();
      $quiz = $stmt->fetch(PDO::FETCH_OBJ);
    ?>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary">
      <h1> <?php echo $quiz->NOMQUESTIONNAIRE; ?></h1>
    </header>
    <main>
      <?php 
        $sql = "SELECT q.IDQUESTION, q.NOMQUESTION, q.INTITULE, q.TYPEQUESTION, r.IDREPONSE, r.INTITULEREPONSE FROM QUESTION q 
        JOIN QUESTIONNAIRE qu ON q.IDQUESTIONNAIRE = qu.IDQUESTIONNAIRE 
        JOIN REPONSE r ON q.IDQUESTION = r.IDQUESTION 
        WHERE qu.IDQUESTIONNAIRE = :IDQUESTIONNAIRE";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':IDQUESTIONNAIRE', $_GET['IDQUESTIONNAIRE'], PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt) {
          echo "<p>Pb de Requete Question</p>";
        } else {
          if ($stmt->rowCount() == 0) {
            echo "Inconnu !<br/>";
          } else {
            $idQuestion = null;
            echo "<form action='corrigerQuestionnaire.php' method='GET'>";
            foreach($stmt as $row) {
              if ($row['IDQUESTION'] != $idQuestion) {
                echo "<h2>".$row['NOMQUESTION']."</h2>";
                echo "<h5>Question: ".$row['INTITULE']."</h5>";
                $idQuestion = $row['IDQUESTION'];
              }
              if($row['TYPEQUESTION'] == 'Choix unique' ){
                echo "<input id='btn' type='radio' required name='reponse_".$row['IDQUESTION']."' value='".$row['IDREPONSE']."'>"
                .$row['INTITULEREPONSE']."</input>";
              }
            }
            echo "<p id='up'></p>";
            echo "<input type='hidden' name='IDQUESTIONNAIRE' value='".$_GET['IDQUESTIONNAIRE']."'></input>";
            echo "<input type='hidden' name='SCORE' value='".$score."'></input>";
            echo "<input type='submit' value='Valider le Quiz'>";
            echo "</form>";
          }
        }
      ?>
    </main>
  </body>
</html>
<?php 
?>

