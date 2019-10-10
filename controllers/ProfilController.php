<?php

require_once ('controllers/Controller.php');
require_once ('model/Utilisateur.php');
require_once ('model/UtilisateurDAO.php');
require_once ('model/SqliteConnection.php');

/**
* Recherche l'ensemble des activités chargées par le client et les transmets à la vue pour affichage.
*/
class ProfilController implements Controller{
	public function handle ($request){
		
		// récupère l'email de l'utilisateur
		$mail = (String) $_SESSION['identifiant'];

		// si il existe
		if($mail !== null){
			// on récupère l'ensemble des Activités de l'Utilsiateur dans une var de session
			try{
				$_SESSION['profil'] = UtilisateurDAO::getInstance()->findProfilUser($mail);
			}catch(PDOException $ex){
				print $ex->getMessage();
			}
		}
	
	}
}

