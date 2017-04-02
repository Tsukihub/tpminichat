<?php
////////////////intialisation bdd/////////////////////////////////////////////
$pdo = new PDO('mysql:host=localhost;dbname=tpMinichat;charset=utf8', 'root', '');


if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
	$pseudo=htmlspecialchars($_POST['pseudo']);

	//////////////////écrase le cookie si le pseudo de l'utilisateur change ou si cookie = cookie par défault/////////////////////////////////////////////
	if ($_COOKIE['cookiepseudo']=='Entrez votre pseudonyme' OR $_COOKIE['cookiepseudo']!==$_POST['pseudo']){
	setcookie('cookiepseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
    }





	if (isset($_POST['message']) && !empty($_POST['message']) && $_COOKIE['cookiepseudo']!=='Entrez votre pseudonyme'){
		$message=htmlspecialchars($_POST['message']);

		////////////////envoie vers bdd si tous les champs ont été remplis par l'utilisateur/////////////////////////////////////////////
		$req = $pdo->prepare('INSERT INTO minichat(pseudo, message, dateMessage) VALUES(:pseudo, :message, :dateMessage)');
		$req->execute(array(
		'pseudo' => $pseudo,
		'message' => $message,
		'dateMessage' => date("Y-m-d H:i:s")
		));
		$req->closeCursor();
		header('Location: minichat.php');



	}


}









header('Location: minichat.php');

?>