<?php
/**
* Vue qui affiche un formulaire de création de compte dans lequel l'utilsiateur saisi différentes informations le concernant avant de les envoyer.
* Une fois les informations enregistrées il sera automatiquement connecté.
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
					<a href='./index.php?page=/' class='logo'>SportTrack</a>
					<nav id='nav'>
						<a href='./index.php?page=/'>Accueil</a>
						<a href='./index.php?page=user_connect_form'>Connexion</a>
						<a href='./index.php?page=/'>Annuler</a>
					</nav>
				</div>
			</header>
			<a href='#menu' class='navPanelToggle'><span class='fa fa-bars'></span></a>

		<!-- Main -->
			<section id='main'>
				<div class='inner'>
					<header class='major special'>
						<h1>Inscription</h1>
						<h4>Remplissez ce formulaire... et commencez à utiliser Sport Track !</h4>

					</header>

					<h2> Identifiants de connexions </h2>
						<form method = 'POST' action= 'index.php?page=user_add'>

							E-mail (sera votre identifiant):<br>
							<input type='email' name='mail'><br>

							Mot de passe:<br>
							<input type='password' name='motDePasse'>
							<br><br>

							<h2> Informations personnelles </h2>

							Prénom:<br>

							<input type='text' name='prenom'>
							<br>

							Nom:<br>
							<input type='text' name='nom'>
							<br>
							<br>

							Date de naissance
							<input type='date' name='dateNaissance'>
							<br><br>

							Sexe : <br>
						 	<input type='radio' name='sexe' value='homme' checked> Homme<br>
							<input type='radio' name='sexe' value='femme'> Femme<br>
						  	<input type='radio' name='sexe' value='autre'> Autre
						  	<br><br>

						 	<h2> Taille / poids  </h2>

						  	Taille en cm:
						  	<input type='number' name='taille' min='100' max='300'>
						 	 <br>
						 	 Poids en kg:
						 	 <input type='number' name='poids' min='0' max='300'>
						 	 <br><br><br>

					<!-- le champ<input type='submit' />permet de créer le bouton de validation du formulaire qui commande l'envoi des données, et donc la redirection du visiteur vers la page cible. form action=  -->
						<input type='submit' name='enregistrer' value='Enregistrer'>
						</form>
						
						<form method='POST' action='index.php'>
							<input type='submit' value = 'Annuler' >
						</form>	

					<img src='images/pic11.jpg' alt=''>

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

