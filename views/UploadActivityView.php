<?php

	/**
	* Vue qui s'affiche apèrs que l'utilisateur ait chargé un fichier json contenant des activités et données.
	* Suivant la réussite ou l'échec de l'insertion la vue affichée n'est pas la même.
	*/

$html ="
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
                            <a href='./index.php'>Accueil</a>
                            <a href='./index.php?page=list_activities'>Mes activités</a>
                            <a href='./index.php?page=profil'>Profil</a>
                            <a href='./index.php?page=user_disconnect'>Déconnexion</a>
                        </nav>
                    </div>
                </header>
                <a href='#menu' class='navPanelToggle'><span class='fa fa-bars'></span></a>

            <!-- Main -->
                <section id='main'>
                    <div class='inner'>
                        <header class='major special'>

                        </header>      
        ";

			// var de session initialisée par le controller UploadActivityController.php
			if(isset($_SESSION['inserted'])){
				$insert_results = $_SESSION['inserted'];
			}

			// redirection vers la page d'affichage des activités si réussite
			if($insert_results){
		  		header('Location: index.php?page=list_activities');
		  		$html .= "<h3><Données ajoutées avec succès !</h3>";
		  		exit();
		  		
		  	// si échec d'insertion, l'information est affichée
		  	// le client est amené à cliquer sur 'revenir en arrière' après avoir pris connaissance de l'échec d'insertion
		  	// il sera également redirigé vers la page d'affichage des activités
			} else {
		 		$html .= "<h3>Données déjà insérées !</h3>
		 				<form method = 'POST' action = index.php?page=list_activities>
						<input type = submit name = 'annuler' value ='Retour au profil'>
						</form>
		 				<form method = 'POST' action = index.php?page=upload_activity_form>
						<input type = submit name = 'annuler' value ='Charger un autre fichier'>
						</form>";
			}

        $html .=      "  
                            
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
       
    <a href='#navPanel' class='navPanelToggle'></a><div id='navPanel'>
                            <a href='index.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Home</a>
                            <a href='generic.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Generic</a>
                            <a href='elements.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Elements</a>
                        <a href='#navPanel' class='close' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'></a></div></body></html>

    ";

    echo $html;

