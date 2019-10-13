<?php

/**
* Vue qui permet d'afficher le tableau regroupant toutes les activités effectuées par l'utilisateur.
* Depuis cette page l'utilisateur peut ajouter de nouvelles activités à la base en chargeant un fichier JSON.
* Il voit aussi un résumé de son profil
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
                        <a href='./index.php?page=upload_activity_form'>Ajouter une activité</a>
                        <a href='./index.php?page=user_modify_form'>Modifier le profil</a>
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
 
    // si c'est var de session sont définies l'utilsiateur est bien connecté
    if(isset ($_SESSION['identifiant']) && isset ($_SESSION['password'])){

        $prenom = (String) $_SESSION['prenom'];
        $html .=  "<h3>Bienvenue, $prenom !</h3>";

        $html .= "
                <h3>Mes activités</h3>
                 <table border=1>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Début</th>
                        <th>Durée (en seconde)</th>
                        <th>Distance (en mètre)</th>
                        <th>Freq.Cardiaque Mini</th>
                        <th>Freq.Cardiaque Maxi</th>
                        <th>Freq.Cardiaque Moyenne</th>
                    </tr>
            ";

        // $_SESSION['activites'] est initialisée par le controleur ListActivityController
        $activites = $_SESSION['activites'];
            foreach ($activites as $activity)
            {
                $html .= "<tr>";
                $html .= "  <td>" . $activity['description'] . "</td>";
                $html .= "  <td>" . $activity['dateActivite'] . "</td>";
                $html .= "  <td>" . $activity['heureDebut'] .  "</td>";
                $html .= "  <td>" . $activity['duree'] .  "</td>";
                $html .= "  <td>" . $activity['distance'] .  "</td>";
                $html .= "  <td>" . $activity['freqCardiaqueMin'] .  "</td>";
                $html .= "  <td>" . $activity['freqCardiaqueMax'] .  "</td>";
                $html .= "  <td>" . number_format((float)$activity['freqCardiaqueMoy'], 2, '.', '') .  "</td>";
                $html .= "</tr>";
            }
        $html .= "</table>

                 <FORM method='POST' action='index.php?page=upload_activity_form'>
                     <INPUT type=submit value='Ajouter une activité'>
                </FORM>";

        $html .= "
                </br></br>
                <h3>Informations personnelles</h3>
                
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
            
            // on crée un affichage de tableau dans le quel on place les informations tirées de la base de données
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

    
    } else {
         $html .=  "<h3> Erreur d'identification </h3>";
        
        $html .= 
        " <FORM method= 'POST' action = 'index.php'>
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



