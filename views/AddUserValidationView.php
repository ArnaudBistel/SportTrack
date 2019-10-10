<?php
    /**
    * Vue qui s'affiche après qu'un utilisateur ait remplit et envoyé le formulaire de création de compte.
    * Suivant la réussite ou l'échec de la création du compte la vue affichée n'est pas la même.
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
                    <a href='../index.php' class='logo'>SportTrack</a>
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

        // var de session initialisée par le controller AddUserController.php
        $insert = (String) $_SESSION['insert'];

        // si réussite redirection de l'utilsiateur peut se diriger vers la page de liste d'actvités
        if ( $insert == 'true' ){
            $html .= "<h3>Utilisateur enregistré avec succès ! </h3>";
            $html .= "
                    <FORM method='POST' action='index.php?page=list_activities'>
                    <INPUT type=submit value='Afficher les activités'>
                    </FORM>";
        // si le mail indiqué par l'utilsiateur est déjà enregistré dans la BDD
        // redirection vers le formulaire de création de compte
        }elseif ( $insert == 'false_mail' ){
            $html .= "<h3>Adresse mail déjà enregistrée : </h3>";
            $html .= "
                    <FORM method='POST' action='index.php?page=user_connect_form'>
                    <INPUT type=submit value='Se connecter'>
                    </FORM>";

        // si l'id est déjà utilisé, si cette conditionnelle est utilisé le problème vient de l'appli et non pas de la saisie de l'utilisateur
        }   elseif ( $insert == 'false_id' ){
            $html .= "<h3>Error : id déjà utilisé</h3>";
            $html .= "
                    <FORM method='POST' action='index.php?page=user_add_form'>
                    <INPUT type=submit value='Retour'>
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
