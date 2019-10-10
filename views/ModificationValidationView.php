<?php
    /**
    * Vue qui s'affiche après qu'un utilisateur ait remplit et envoyé le formulaire de modification de compte.
    * Suivant la réussite ou l'échec de la modification du compte la vue affichée n'est pas la même.
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

            // var de session initialisée par le controller ModificationController.php
            $update = (String) $_SESSION['update'];

            // si réussite redirection de l'utilsiateur peut se diriger vers la page de liste d'actvités
            if ( $update == 'true' ){
                $html .= "<h3>Modifications effectuées avec succès ! </h3>";
                $html .= "
                        <FORM method='POST' action='index.php?page=list_activities'>
                        <INPUT type=submit value='Afficher les activités.'>
                        </FORM>";
            // si une erreur quelconque est survenue
            // redirection vers la liste d'activités
            }elseif ( $update == 'error' ){
                $html .= "<h3>Une erreur s'est produite : </h3>";
                $html .= "
                        <FORM method='POST' action='index.php?page=list_activities'>
                        <INPUT type=submit value='Retour au profil.'>
                        </FORM>";
            // si l'ancien password saisi lors de la modification est erroné
            }   elseif ( $update == 'wrong_pwd' ){
                $html .= "<h3>Mauvais mot de passe</h3>";
                $html .= "
                        <FORM method='POST' action='index.php?page=list_activities'>
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

            <!-- Scripts -->
                <script src='assets/js/jquery.min.js'></script>
                <script src='assets/js/skel.min.js'></script>
                <script src='assets/js/util.js'></script>
                <script src='assets/js/main.js'></script>

        
    <a href='#navPanel' class='navPanelToggle'></a><div id='navPanel'>
                            <a href='index.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Home</a>
                            <a href='generic.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Generic</a>
                            <a href='elements.html' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'>Elements</a>
                        <a href='#navPanel' class='close' style='-webkit-tap-highlight-color: rgba(0, 0, 0, 0);'></a></div></body></html>

    ";

    echo $html;






