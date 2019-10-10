<?php
    /**
    * Vue qui représente le formulaire de connection dans lequel l'utilisateur saisie son adresse mail et son mot de passe.
    * S'il n'est pas encore enregistré il peut créer un compte en appuyant sur le bouton correspondant.
    * Suivant la réussite ou l'échec de la création du compte la vue affichée n'est pas la même.
    * Si l'utilisateur est déjà connecté on affiche un bouton de redirection vers son profil.
    */

$html = "
<!--
	Introspect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html><head>
		<title>Sport Track création de compteD</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
		<link rel='stylesheet' href='resources/css/main.css'>
		<link rel='stylesheet' href='../resources/css/main.css'>
	</head>
	<body class=''>

		<!-- Header -->
			<header id='header'>
				<div class='inner'>
					<a href='./index.php' class='logo'>SportTrack</a>
					<nav id='nav'>
						<a href='./index.php?page=/'>Accueil</a>
						<a href='./index.php?page=user_add_form'>Inscription</a>
						<a href='./index.php?page=/'>Annuler</a>
					</nav>
				</div>
			</header>
			<a href='#menu' class='navPanelToggle'><span class='fa fa-bars'></span></a>

		<!-- Main -->
			<section id='main'>
				<div class='inner'>";


		if (!isset ($_SESSION['identifiant'])){
			$html .= "<header class='major special'>
						<h1>Connectez vous</h1>
						<h4>et commencez à utiliser Sport Track !</h4>

					</header>

					<form method='POST' action='index.php?page=user_connect'>
						

						<div class='container'>
						    <label for='loginLabel'><b>Email</b></label>
						    <input type='text' placeholder='Entrez votre email' name='login' required>
						 	<br>

						    <label for='psw'><b>Password</b></label>
						    <input type='password' placeholder='Entrez mot de passe' name='psw' required>
						    <br>

						    <button type='submit'>Entrer</button>
						 </div>
					</form>
					<form method='POST' action='index.php?page=user_add_form'>
			 					<input type='submit' name='créer compte' value='Créer compte'>
					</form>
					<form method='POST' action='index.php'>
			 					<input type='submit' name='créer compte' value='Accueil'>
					</form>
				</body>
			</html>";

		}else {
		    if( isset ($_SESSION['prenom'])){
				$prenom = (String) $_SESSION['prenom'];
				$html .=" <h3>Bienvenue, $prenom !</h3>";
			}
			
			$html .= "<FORM method= 'POST' action = 'index.php?page=list_activities'>
			<INPUT type = submit value = 'Voir le profil'>
			</FORM>";
			
			$html .= 
			 " <FORM method= 'POST' action = 'index.php?page=user_disconnect'>
			 <INPUT type='submit' value='Déconnexion'>
			 </FORM>";
		}


	$html .="				<img src='images/pic11.jpg' alt=''>

				</div>
			</section>

		<!-- Footer -->
				<section id='footer'>
					<div class='inner'>
						<header>
							<h6>author : Arnaud Bistel</h6>
						</header>
						<div class='copyright'>
							© Untitled Design: <a href='https://templated.co/'>TEMPLATED</a>. Images <a href='https://unsplash.com/'>Unsplash</a>
						</div>
					</div>
				</section>
				</body></html>


";

echo $html;


