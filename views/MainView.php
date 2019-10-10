<?php
	/**
	* MainView : Vue affichée lorsque le client arrive à la racine du site.
	*/
	$html ="
	<!--
		Introspect by TEMPLATED
		templated.co @templatedco
		Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	-->
	<html><head>
			<title>Sport Track</title>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
			<link rel='stylesheet' type='text/css' href='resources/css/main.css'>
			<link rel='stylesheet' type='text/css' href='../resources/css/main.css'>
		</head>
		<body class=''>

			<!-- Header -->
				<header id='header'>
					<div class='inner'>
						<a href='./index.php?page=/' class='logo'>SportTrack</a>
						<nav id='nav'>
							<a href='./index.php?page=/'>Accueil</a>";
		    // si l'utilisateur est connecté
		    if(isset ($_SESSION['identifiant']) && isset ($_SESSION['password'])){			
		    	$html .= "<a href='./index.php?page=profil'>Mon profil</a>
							<a href='./index.php?page=list_activities'>Mes activités</a>
						<a href='./index.php?page=user_disconnect'>Déconnexion</a>";
			//sinon
			}else{
				$html .="
						<a href='./index.php?page=user_add_form'>Inscription</a>
						<a href='./index.php?page=user_connect_form'>Connexion</a>";
			}

			$html .="
						</nav>
					</div>
				</header>
				<a href='images/banner.png' class='navPanelToggle'><span class='fa fa-bars'></span></a>

			<!-- Banner -->
				<section id='banner'>
					<div class='inner'>
						<h1>Sport Track: <span>L'application de suivi de vos activités sportives </span></h1>
						<ul class='actions'>";
						
			// si l'utilisateur est connecté
		    if(isset ($_SESSION['identifiant']) && isset ($_SESSION['password'])){			
		    	$html .= "<li><a href='./index.php?page=list_activities' class='button alt'>Voir mes performances</a></li>";
			//sinon
			}else{	
				$html .= "<li><a href='./index.php?page=user_add_form' class='button alt'>Commencer</a></li>";
			}
			
				$html .= "		</ul>
					</div>
				</section>

			<!-- One -->
				<section id='one'>
					<div class='inner'>
					</div>
				</section>
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


