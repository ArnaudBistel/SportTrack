<?php
    /**
    * Vue qui s'affiche après que l'utilisateur ait appuyé sur le bouton déconnexion.
    * Différents cas sont traités suivant la réussite de la déconnexion ou son échec.
    */
	$html = "
<!DOCTYPE
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
                        <a href='./index.php?page=user_connect_form'>Connexion</a>
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
	// si les variables de Session sont encore définies, l'utilsiateur est toujours connecté
	if(isset ($_SESSION['connexion'])){
		$html .= '<h3>Identification réussie</h3>';

		// redirection vers le profil
		$html .= "<FORM method= 'POST' action = 'index.php?page=list_activities'>
			<INPUT type = submit value = 'Profil'>
			</FORM>";
	}else{
		$html .= '<h3>Déconnecté avec succès</h3>';
		$html .= "<FORM method= 'POST' action = 'index.php'>
					<INPUT type = 'submit' value = 'Retour accueil'>
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


