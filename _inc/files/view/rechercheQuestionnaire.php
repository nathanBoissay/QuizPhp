<?php
    namespace files\BD;
	use \PDO;
	use \PDOException;
?>
<!doctype html>
<html>
<head>
<title>
Recherche d'un Questionnaire par ID
</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../../../css/Bandeau.css">
<link rel="stylesheet" href="../../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../../css/rechercheQuestionnaire.css">
</head>
<body>
<?php
	require('../BD/connexionBD.php');
	$wanted=$_GET['IDQUESTIONNAIRE'];

	if (!empty($wanted)){
		$connexion=connect_bd();
		$sql="SELECT * from QUESTIONNAIRE where IDQUESTIONNAIRE=:IDQUESTIONNAIRE";
		$stmt=$connexion->prepare($sql);
		$stmt->bindParam(':IDQUESTIONNAIRE', $_GET['IDQUESTIONNAIRE'],PDO::PARAM_INT);//Permet de definir un nom a une variable preparé(?)
		$stmt->execute();
		if (!$stmt){
			echo "Pb de Requete";
		}
		else{
			$quiz = $stmt->fetch(PDO::FETCH_OBJ);
		?>

		<header class="navbar navbar-expand-lg navbar-dark bg-primary">
			<h1>Questionnaire n°<?php echo $wanted; ?></h1>
		</header>
		<main>
			<section id="sectionG">
				<h1>Jouer</h1>
				<form action="lancerQuestionnaire.php" method="GET">
					<h3> <?php echo $quiz->NOMQUESTIONNAIRE; ?> </h3>
					<h5>Thème: <?php echo $quiz->THEMEQUESTIONNAIRE; ?> </h5>
					<p> <?php echo $quiz->NOMBREQUESTION; ?> questions</p>
					<input type='hidden' name='IDQUESTIONNAIRE' value=<?php echo $quiz->IDQUESTIONNAIRE; ?>></input>
					<input type="submit" class="btn btn-success" value="Lancer le quiz">
				</form>
			</section>
			<?php } ?>
			<section id="sectionD">
				<table class="table table-hover">
					<thead>
						<tr>
						<th scope="col">Nom</th>
						<th scope="col">Prénom</th>
						<th scope="col">Score</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql="SELECT * from QUESTIONNAIRE natural join SCORE natural join USER where IDQUESTIONNAIRE=".$wanted;
						foreach ($connexion->query($sql) as $row){
							echo "<tr class='table-secondary'>";
							echo "<td>".$row['NOM']."</td>";
							echo "<td>".$row['PRENOM']."</td>";
							echo "<td>".$row['NBREPONSEBONNE']."/".$row['NOMBREQUESTION']."</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table> 
			</section>
		</main>
<?php
}
?>

</body>
</html>