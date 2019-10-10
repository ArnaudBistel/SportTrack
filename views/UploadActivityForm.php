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

				<h1>Ajouter un fichier d’activité sportive </h1>
				<p>Veuillez sélectionner un fichier, attention seul le format JSON est accepté:</p>
				<form method=post action='index.php?page=upload_activity' enctype='multipart/form-data'>
					<input type="file" name="fichier"  accept="json"><br><br>
		 			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
					<input type="submit" name='envoyer' value='Envoyer' >
				</form><br>

				<form method = 'POST' action = index.php?page=list_activities>
					<input type = submit name = 'annuler' value ='Revenir aux activités'>
				</form>

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
