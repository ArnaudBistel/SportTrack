<?php

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
                        <a href='./index.php'>Accueil</a>
                        <a href='./index.php?page=user_modify_form'>Modifier le profil</a>
                        <a href='./index.php?page=list_activities'>Mes activités</a>
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
 
    if(isset ($_SESSION['identifiant']) && isset ($_SESSION['password'])){

        $prenom = (String) $_SESSION['prenom'];
       
        $html .=  "<h2>Mon profil</h2>
                     </br>
                 <table border=1>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
                        <th>Taille (cm)</th>
                        <th>Poids (kg)</th>
                        <th>Email</th>
                    </tr>
            ";

        // $_SESSION['activites'] est initialisée par le controleur ListprofilController
        $user_profil = $_SESSION['profil'];
            foreach ($user_profil as $profil)
            {
                $html .= "<tr>";
                $html .= "  <td>" . $profil['prenom'] . "</td>";
                $html .= "  <td>" . $profil['nom'] . "</td>";
                $html .= "  <td>" . $profil['dateNaissance'] .  "</td>";
                $html .= "  <td>" . $profil['sexe'] .  "</td>";
                $html .= "  <td>" . $profil['taille'] .  "</td>";
                $html .= "  <td>" . $profil['poids'] .  "</td>";
                $html .= "  <td>" . $profil['mail'] .  "</td>";
                $html .= "</tr>";
            }
        $html .= "</table>";

        $html .=" 
                
        <FORM method='POST' action='./index.php?page=user_modify_form'>
            <INPUT type=submit value='Modifier mon profil'>
         </FORM>
        
        <FORM method= 'POST' action = 'index.php?page=list_activities'>
			<INPUT type='submit' value='Retour aux activités'>
        </FORM>";      

    
    } else {
     
        $html .= "
        <h3> Erreur d'identification </h3>
         <FORM method= 'POST' action = 'index.php'>
        <INPUT type='submit' value='Retour à l'accueil'>
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

