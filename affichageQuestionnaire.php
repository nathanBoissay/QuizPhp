<!DOCTYPE html>
<html>
<head>
  <title>Nos questionnaires</title>
  <link rel="stylesheet" href="../css/Bandeau.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/AfficheQuestionnaire.css">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h1>Nos questionnaires</h1>
    </header>

    <?php
    // Connexion à la base de données

    require("connexionBD.php");
    $connexion=connect_bd();

    // Récupération de la liste des questionnaires
    $sql = "SELECT * FROM QUESTIONNAIRE";
    if(!$connexion->query($sql)) echo "Pb d'accès au Questionnaire";
    else{
    ?>
    <main>
        <section id="questionnaire">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th class="align-middle" scope="col">Nom</th>
                    <th scope="col">Theme</th>
                    <th scope="col">Nb question</th>
                    <th scope="col">Jouer</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($connexion->query($sql) as $row){
                        echo "<form action='rechercheQuestionnaire.php' method='GET'>";
                        echo "<tr class='table-primary'>";
                        echo "<th scope='row'>".$row['NOMQUESTIONNAIRE']."</th>";
                        echo "<td>".$row['THEMEQUESTIONNAIRE']."</td>";
                        echo "<td>".$row['NOMBREQUESTION']."</td>";
                        echo "<td><input class='btn btn-outline-success' type='submit' value='JOUER'></td>";
                        echo "<input type='hidden' name='IDQUESTIONNAIRE' value='".$row['IDQUESTIONNAIRE']."'>";
                        echo "<td><input class='btn btn-outline-danger' formaction='deleteQuestionnaire.php' type='submit' formation value='SUPPR'></td>";
                        echo "</tr>";
                        echo "</form>";
                    }
                    ?>
                </tbody>
            </table>   
            <?php 
            } 
            ?>
        </section>
        <section id="other">
            <a href="addQuestionnaire.php/" class="btn btn-primary" value="Ajouter un Questionnaire">Ajouter un Questionnaire</a>
        </section>
    </main>
</body>
</html>
