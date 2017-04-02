<?php
$pseudo='Entrez votre pseudonyme';
if (!isset($_COOKIE['cookiepseudo'])){
	setcookie('cookiepseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
	}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<!-- formulaire  -->
<form action="minichat_post.php" method="post" id="minichat">
		<label for="pseudo"> Pseudo:
			<input type="text" id="pseudo" name="pseudo" value="<?= $_COOKIE['cookiepseudo'] ?>" placeholder="entrez votre pseudonyme">
		</label></br>
		<label for="Message">Message: </label>
		<textarea form ="minichat" name="message"  cols="90" wrap="soft"></textarea></br>
		<input type="submit" value="Envoyer">
	</form>	
<!-- affichage du contenu de la bdd -->
<?php


	$pdo = new PDO('mysql:host=localhost;dbname=tpMinichat;charset=utf8', 'root', '');

	$req = $pdo->prepare("
		SELECT pseudo, message, DATE_FORMAT(dateMessage, '%d/%m/%Y %h:%i') 
		AS dateMessage 
		FROM minichat 
		ORDER BY ID 
		DESC LIMIT 10");

	$req->execute();
	echo '<ul>';
	while ($donnees = $req->fetch())
	{
		echo '</br>'. $donnees['dateMessage'] .'<strong> '. htmlspecialchars($donnees['pseudo']) . '</strong> : </br>' . htmlspecialchars($donnees['message']) . '</br>';
	}
	echo '</ul>';

	$req->closeCursor();
	

?>



</body>
</html>

