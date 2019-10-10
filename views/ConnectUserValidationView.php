<?php
    /**
    * Vue qui s'affiche après que l'utilisateur ait saisi ses informations de connexion et appuyé sur 'connexion'
    * Différents cas sont traités suivant la réussite de la connexion ou son échec. En cas d'échec on indique la raison de l'échec.
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
                    <a href='./index.php?' class='logo'>SportTrack</a>
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

                    </header>      
	";
	// connexion a été défini dans le controller de gestion de la connexion et de la creéation de compte
	// on y stocke les informations concernant la tentative de connexion
	$connect = (String) $_SESSION['connexion'];

	switch ($connect) {
		case 'error_on_mail':
			$html .= '<h3>Email inconnu</h3> ';
			$html .= "<FORM method = 'POST' action = 'index.php?page=user_connect_form' >
						<INPUT type = submit value ='Se connecter' >
						</FORM>";
			break;
		case 'error_on_pwd' :
			$html .= '<h3>Mot de passe erroné</h3>';
			$html .= "<FORM method = 'POST' action = 'index.php?page=user_connect_form' >
						<INPUT type = submit value ='Se connecter' >
						</FORM>";
			break;			
		case 'ok' :
			$html .= '<h3>Identification réussie</h3>';

			// l'utilisateur peut se diriger vers son profil 
			$html .= "<FORM method= 'POST' action = 'index.php?page=list_activities'>
						<INPUT type = submit value = 'Profil'>
						</FORM>";
			// ou se déconnecter
			$html .= 
				 " <FORM method= 'POST' action = 'index.php?page=user_disconnect'>
				 <INPUT type='submit' value='Déconnexion'>
				 </FORM>";
			break;
		default : 	
			$html .= '<h3>Erreur</h3>';
			$html .= "<FORM method= 'POST' action = 'index.php'>
						<INPUT type='submit' value='Accueil'>
												</FORM>";	
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


";

echo $html;
















