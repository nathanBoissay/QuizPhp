<!doctype html>
<html lang="fr">
<head>
  <title>Ajouter Vos Questions</title>
  <link rel="stylesheet" href="../css/Bandeau.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/AfficheQuestionnaire.css">
</head>
<body>
<?php
$nombrequestion=$_GET['NOMBREQUESTION'];
$id_questionnaire=$_GET['IDQUESTIONNAIRE'];
$x=1;

echo "<form name='ajout' action='/addQuestionBD.php?' method='GET'>";
while($x<=$nombrequestion){
    echo " <fieldset>";
    echo  "<legend>Nouvelle Question</legend>";


    echo "<input type='text' hidden name ='NomQuestion".$x."' '>";
    echo "<p> IntituleQuestion :" ;
    echo "<input type='text' name ='IntituleQuestion".$x."' 
        pattern='[a-zA-Z\ \-]{2,25}' 
        required title='Entrez ici votre Question' placeholder=''> </p>";

    echo "<p> TypeQuestion :"; 
    echo "<select name='TypeQuestion'>
        <option value='Choix unique'>Choix unique</option>";
    echo "</select>";

    echo "<p> Réponse 1 :"; 
    echo "<input type='text' name ='Reponse1".$x."' 
        required title='Entrez ici la réponse 1' placeholder='Réponse 1'> </p>";

    echo "<p> Réponse 2 :"; 
    echo "<input type='text' name ='Reponse2".$x."' 
        required title='Entrez ici la réponse 2' placeholder='Réponse 2'> </p>";

    echo "<p> Réponse 3 :"; 
    echo "<input type='text' name ='Reponse3".$x."' 
        required title='Entrez ici la réponse 3' placeholder='Réponse 3'> </p>";

    echo "<p> Indice de la bonne réponse :"; 
    echo "<select name='BonneReponse".$x."'>
        <option value='1'>Réponse 1</option>
        <option value='2'>Réponse 2</option>
        <option value='3'>Réponse 3</option>
    </select>";

    echo "</fieldset>";
    $x++;
}
echo "<input type='hidden' name='IDQUESTIONNAIRE' id=IDQUESTIONNAIRE value=".$id_questionnaire.">";
echo "<input type='hidden' name='NOMBREQUESTION' id=NOMBREQUESTION value=".$nombrequestion.">";
echo "<p><input type='submit' value='Ajouter'> </p>";

echo "</form>";
?>
