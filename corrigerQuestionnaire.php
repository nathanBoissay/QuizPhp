<!doctype html>
<html>
<head>
<title>
Lancement d'un Questionnaire par ID
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<?php 
    session_start();

    require('connexionBD.php');
    $connexion = connect_bd();
    $wanted=$_GET['IDQUESTIONNAIRE']; 
    $score = 0;
    $i=0;
    $reponses = array(
    );
    
    // Parcourir les paramètres
    foreach($_GET as $key => $value) {
        // Vérifier si le nom du paramètre commence par "reponse_"
        if (strpos($key, 'reponse_') === 0) {
            // Récupérer la valeur du paramètre
            $reponse = $_GET[$key];
            array_push($reponses, $reponse);

            $i++;
            
        }
    }


    // Traiter la réponse     
    foreach ($reponses as $reponse){
        $sql = "SELECT * FROM REPONSE WHERE IDREPONSE =:IDREPONSE";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':IDREPONSE', $reponse, PDO::PARAM_INT);
        $stmt->execute();
        if(!$stmt)
            echo "Pb de Requete";
        
        else{
            $rep = $stmt->fetch(PDO::FETCH_OBJ);
            if ($rep->BONNE == 1) {
                $score++;
            }
            foreach($stmt as $row){
                if($row['BONNE'] == 1){
                    $score++;
                }
            }
        }
        
    
    }
    $nbReponse= count($reponses);
    // Afficher le résultat
    echo "<h1 class='text text-center'> Votre score est de " . $score . " sur ". $nbReponse." </h1>";
    
    $query = "SELECT id FROM USER WHERE EMAIL = :email";
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(':email', $_SESSION['mail']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $idJoueur = $result['id'];


    $sql="INSERT INTO SCORE VALUES(NULL,:id,:idQ,:score);";
    $stmt=$connexion->prepare($sql);
    $stmt->bindParam(':id', $idJoueur); 
    $stmt->bindParam(':idQ', $_GET['IDQUESTIONNAIRE']); 
    $stmt->bindValue(':score', $score); 
    $stmt->execute();
    header("Refresh:1; affichageQuestionnaire.php");
    ?> 
        
    </body>
    </html>

    $sql="INSERT INTO SCORE VALUES(NULL,:id,:idQ,:score);";
    $stmt=$connexion->prepare($sql);
    $stmt->bindParam(':id',$_SESSION['id']); 
    $stmt->bindParam(':idQ',$_GET['IDQUESTIONNAIRE']); 
    $stmt->bindValue(':score',$score); 
    $stmt->execute();
    header("Refresh:3; affichageQuestionnaire.php");
    ?> 
    
</body>
</html>