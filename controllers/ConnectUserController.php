<?php

require_once ('controllers/Controller.php');
require_once ('model/Utilisateur.php');
require_once ('model/UtilisateurDAO.php');
require_once ('model/SqliteConnection.php');

/**
* Controlleur qui est appelé après que l'utilisateur ait saisi ses informations de connexion via le formulaire ConnectUserForm.php
* Il vérifie que l'adresse mail et le mot de passe saisis sont valides et définis des var de Sessions.
*/
class ConnectUserController implements Controller {
	public function handle ($request){
		
		// login et psw sont des var de SESSION définie dans le formulaire ConnectUserForm.php
		if (isset ($_REQUEST['login']) && isset ($_REQUEST['psw'])){

			// conversion de l'adresse mail en minuscule pour éviter les erreurs de reconnaissance
			// et suppression des espaces autour, pour éviter des refus d'identifiants valides
			$mail = trim(strtolower((String) $request['login']));
			$pwd = trim((String) $request['psw']);

			try{
				// recherche du mot de passe associé au mail saisi
				$password = UtilisateurDAO::getInstance()->findPassword($mail); 

				// recherche de l'id associée à ce mail 
				$id = UtilisateurDAO::getInstance()->findID($mail);  

				// si password inexistant, c'est que ce mail n'est pas référencé dans la BDD
				if(!isset ($password)) {
					$_SESSION['connexion'] = 'error_on_mail';
				} else {					
					// si le mot de passe saisi est correct
					if(isset($password) && $password == $pwd){
						// enregistre différentes informations concernant l'utilisateur connecté dans des variables de session qui seront réutilisées durant la navigation					
						$_SESSION['prenom'] = UtilisateurDAO::getInstance()->findPrenom($mail); 						
						$_SESSION['connexion'] = 'ok';
						$_SESSION['identifiant'] = $mail;
						$_SESSION['password'] = $pwd;
						$_SESSION['id'] = $id;
					
					//si le mot de passe est erroné
					} else {
						$_SESSION['connexion'] = 'error_on_pwd';
					}
				}
			}catch(PDOException $ex){
				print $ex->getMessage();
			}
		}
	}
}












