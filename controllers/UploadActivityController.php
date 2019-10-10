<?php

require_once ('controllers/Controller.php');
require_once ('model/Activite.php');
require_once ('model/ActiviteDAO.php');
require_once ('model/Donnees.php');
require_once ('model/DonneesDAO.php');
require_once ('model/UtilisateurDAO.php');
require_once ('model/Utilisateur.php');
require_once ('model/SqliteConnection.php');
require_once ('model/CalculDistanceImpl.php');
/**
* Controlleur qui gère la création et l'insertion dans la base de données des Activités et Données
* extraites d'un fichier json chargé par l'utilisateur sur le site.
*/
class UploadActivityController implements Controller {
	/**
	* On commance par ouvrir le fichier chargé via la page UploadActivityform.php
	* puis on en extrait les données et les insère dans la BDD
	* Le fichier n'est chargé que temporairement, il n'est pas enregistré chez le client
	*/
	public function handle ($request){
		// limitation de la taille du fichier uploadé
		$taille_maxi = 10000;
		$taille = filesize($_FILES['fichier']['tmp_name']);
		// limitation de fichier analysé aux fichiers de format JSON
		$extensions = array('.json');
		$extension = strrchr($_FILES['fichier']['name'], '.'); 
		//Début des vérifications de sécurité...
		//Si l'extension n'est pas dans le tableau
		if(!in_array($extension, $extensions)){
			 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
		}
		// Si la taille du fichier est trop élevée
		if($taille>$taille_maxi){
			 $erreur = 'Le fichier est trop gros...';
		}

			$file = $_FILES['fichier']['tmp_name'];	 

			// sauvegarde de l'id de session
			$id = $_SESSION['id'];
			
	      	// Début de l'extraction des informations contenues dans le fichier
	     	if (isset( $file)){
	     		// lecture du fichier
		        $json = file_get_contents ($file);
		        $parsed_json = json_decode( $json );
		        
		        // stocke le tableau de données contenues dans le fichier dans un nouveau tableau
		        $data_array = $parsed_json -> data;
		        // stocke le tableau d'activités contenues dans le fichier dans un nouveau tableau
		        $activity_array = $parsed_json -> activity;

		        // ***** VERIFICATION si on doit insérer ces données ou si elles sont déjà dans la base ******
		        $date_activity = $activity_array->date;

				$debut_activite = $data_array[0]->time;

				// cherche l'heure de debut de l'activité
				for($i = 1; $i < count($data_array) ; $i++){
					$heure = $data_array[$i]->time ;
					if($heure < $debut_activite){
						$debut_activite = $heure;
					}
				}

				// récupère l'ensemble des activités enregistrées de l'utilisateur
		        try{
					$pdo = SqliteConnection::getInstance()->getConnection();
					$query = "SELECT dateActivite, heureDebut FROM Activite WHERE lUtilisateur = $id";
					$results = $pdo->query($query)->fetchAll();
				}catch(PDOException $ex){
					print $ex->getMessage();
				}

				// variable qui indiquera si les données peuvent être insérées ou non
				$insert= true;

				// boucle qui vérifie si il existe déjà une activité correspondant aux données que l'utilisateur essaye d'insérer
				// si la date et l'heure de début correspondent on refuse l'insertion des données
				foreach($results as list ($date, $heure)){
					if($date == $date_activity && $heure == $debut_activite){
						$insert = false;
					}
				}

				// si les données peuvent être ajoutées car non encore présentes
				if($insert){
				
						// recherche le dernier noActivite défini pour affecter une clé unique à chaque activité			
						try{
							$query = "SELECT MAX (noActivite) FROM Activite";
							$stmt = $pdo->query($query)->fetch();

							// si pas encore d'activité dans la base
							if($stmt == null){
								$cptActivity = 1;
							// sinon on incrémente ce numéro
							}else {
								$cptActivity = $stmt[0] + 1;
							}
						}catch(PDOException $ex){
							print $ex->getMessage();
						}

						// entrent les donnees inscrites dans le fichier dans la BDD
						$donnees = null;
				        $donnees_dao = DonneesDAO::getInstance();
				        for($i = 0; $i < count($data_array); $i++){
				        	$donnees = new Donnees();

				        	$donnees->init($cptActivity,
				        					$data_array[$i]->time,
				        					$data_array[$i]->cardio_frequency,
				        					$data_array[$i]->latitude,
				        					$data_array[$i]->longitude,
				        					$data_array[$i]->altitude
										);
				        	$donnees_dao->insert($donnees);
				        }

						try{
							// calcule / recherche dans la BDD, les différents paramètres à insérer dans Activite à partir des données insérées

							// frequence cardiaque maximale
							$query = "SELECT MAX(freqCardiaque) FROM Donnees WHERE lActivite = $cptActivity";
							$results= $pdo->query($query)->fetch();
							$freqCardMax =  $results[0];
							
							// frequence cardiaque minimale							
							$query = "SELECT MIN(freqCardiaque) FROM Donnees WHERE lActivite = $cptActivity";
							$results= $pdo->query($query)->fetch();
							$freqCardMin = $results [0];

							// frequence cardiaque moyenne
							$query = "SELECT SUM(freqCardiaque) FROM Donnees WHERE lActivite = $cptActivity";
							$results= ($pdo->query($query)->fetch());
							$freqCardMoy = (int) ((int)$results[0]) / count($data_array);

							// heure de début de l'activité
							$query = "SELECT MIN(temps) FROM Donnees WHERE lActivite = $cptActivity";
							$results= $pdo->query($query)->fetch();
							$heureDebut = $results[0];

							// que l'on convertit en DateTime
							$heure_debut = new DateTime ($results[0]);

							// recherche la valeur de temps la plus élevée dans les données correspondant à l'Activite							
							$query = "SELECT MAX(temps) FROM Donnees WHERE lActivite = $cptActivity";
							$results= ($pdo->query($query)->fetchAll());
							$heure_fin = new DateTime ($results[0][0]);

							// la différence entre heure de début et heure de fin nous donnes la durée de l'activité	
							$diff = date_diff($heure_debut, $heure_fin);
							$duree = ($diff->h) * 3600;
							$duree += ($diff->i) * 60;
							$duree += $diff->s;

						}catch(PDOException $ex){
							print $ex->getMessage();
						}

						// calcule de la distance parcourue à partir des données GPS
					    $calculDistance = new CalculDistanceImpl($file);
					    $distance = $calculDistance -> calculDistanceTrajet();

					    // on crée et initialise l'objet Activite à insérer dans la base

					    $activite = new Activite();
						$activite->init($cptActivity,
										$date_activity,
										$activity_array->description,
										$heureDebut,
										$duree,
										$distance,
										$freqCardMin,
										$freqCardMax,
										$freqCardMoy,
										$id
									);
						try{
							$activite_dao = ActiviteDAO::getInstance();
					   		$activite_dao->insert($activite);
					   		// variable de session qui enregistre la réussite ou l"échec de l'extraction et de l'insertion des données dans la BDD
							$_SESSION['inserted'] = true;		
						}catch(PDOException $ex){
							print $ex->getMessage();
						}
		 
				// si les données sont déjà dans la base
			 	}else {
			 		$_SESSION['inserted'] = false;
		 		}
		  			 
		}
	}
}
