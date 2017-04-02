
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/style.css">
	<title>minichat</title>
</head>
<body>

<!-- formulaire  -->
<form action="minichat_post.php" method="post" id="minichat">
	<fieldset>
    	<legend>Mon petit chat</legend>
		<label for="pseudo"> Pseudo:
			<input type="text" id="pseudo" name="pseudo" value="<?php if(isset($_COOKIE['cookiepseudo'])){echo $_COOKIE['cookiepseudo'];} ?>" placeholder="entrez votre pseudonyme">
		</label></br>
		<label for="Message">Message: </label>
		<textarea form ="minichat" name="message"  cols="90" wrap="soft"></textarea></br>
		<input type="submit" value="Envoyer" id='input'>
	</fieldset>
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
	echo '<section class="textechat" >';
	while ($donnees = $req->fetch())
	{
		echo '</br>'. $donnees['dateMessage'] .'<strong> '. htmlspecialchars($donnees['pseudo']) . '</strong> : </br>' . htmlspecialchars($donnees['message']) . '</br>';
	}
	echo '</section>';

	$req->closeCursor();
	

?>



</body>
</html>

