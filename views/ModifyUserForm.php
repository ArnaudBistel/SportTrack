<?php
/**
* Vue qui permet la modification des informations du compte de l'utilisateur à l'exception de son adresse mail à l'aide d'un formulaire.
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
                <a href='./index.php?page=profil'>Mon profil</a>
                <a href='./index.php?page=list_activities'>Annuler</a>
              </nav>
            </div>
          </header>
          <a href='#menu' class='navPanelToggle'><span class='fa fa-bars'></span></a>

        <!-- Main -->
          <section id='main'>
            <div class='inner'>
              <header class='major special'>

              </header>

              <h2>Modifier votre compte</h2>

              <h3> Modifier votre mot de passe </h3>
              <form method = 'POST' action= 'index.php?page=user_modify'>
                   Ancien mot de passe: <input Name=OldPassword>
                   <br>
                   Nouveau mot de passe: <input Name=NewPassword>
                    <br><br>

                   <h3> Informations personnelles </h3>

                   Prénom:<br>
                    <input type='text' name='prenom'>
                    <br>
                    Nom:<br>
                    <input type='text' name='nom'>
                    <br>
                    <br>
                    Date de naissance
                    <input type='date' name='bday'>
                    <br><br>

                    Sexe : <br>
                    <input type='radio' name='sexe' value='homme' checked> Homme<br>
                    <input type='radio' name='sexe' value='femme'> Femme<br>
                    <input type='radio' name='sexe' value='autre'> Autre
                    <br><br>

                   <h3> Taille / poids  </h3>

                    Taille en cm:
                    <input type='number' name='taille' min='100' max='300'>
                    <br>
                    Poids en kg:
                    <input type='number' name='poids' min='0' max='300'>
                    <br><br><br>

                    <input type='submit' name='enregistrer' value='Enregistrer les modifications'>
              </form>

             <FORM method='POST' action='index.php?page=list_activities'>
             <INPUT type=submit value='Annuler'>
           </FORM>

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
