<?php

require_once ('Controller.php');
require_once ('model/Utilisateur.php');
require_once ('model/UtilisateurDAO.php');
require_once ('model/SqliteConnection.php');
/**
* Controlleur qui est appelé après que l'utilisateur ait saisi ses informations de création de compte via le formulaire AssUserForm.php
* Il crée un nouvel Utililisateur puis l'insert dans la Base de données.
*/
class AddUserController implements Controller{
	public function handle ($request){
		$user = new Utilisateur();
		
		// cherche la clé la plus haute dans la Utilsiateur afin de créer un nouveau tuple d'utilsiateur qui n'utilise pas une clé déjà utilisée
		try{
			$pdo = SqliteConnection::getInstance()->getConnection();
			$query = "SELECT MAX (id) FROM Utilisateur";
			$stmt = $pdo->query($query)->fetch();
			// si null, aucun utilisateur enregistré pour l'instant, on commence donc à 1
			if($stmt == null){
				$cptUsers = 1;
			// sinon on ajoute 1 à ce MAX
			}else {
				$cptUsers = $stmt[0] + 1;
			}
		}catch(PDOException $ex){
			print $ex->getMessage();
		}
		
		// login et psw sont des var de SESSION définie dans le formulaire AssUserForm		
		// conversion de l'adresse mail en minuscule pour éviter les erreurs de reconnaissance à la connexion
		$mail = trim(strtolower ((String) ($request['mail'])));		
		
		// initialisation de l'Utilsiateur en extrayant les données transmises dans le formulaire
		$user->init($cptUsers,
					$request['nom'],
					$request['prenom'],
					$request['dateNaissance'],
					$request['sexe'],
					$request['taille'],
					$request['poids'],
					$mail,
					trim($request['motDePasse'])
		);

		$pwd = $request['motDePasse'];
		$prenom = $request['prenom'];
		
		try{
			// vérifie que le mail n'est pas déjà enregistré dans la base
			$results = UtilisateurDAO::getInstance()->findIfMailInserted($mail); 
		
			// si results == null c'est que le mail n'est associé à aucun compte pour l'instant, on peut inséré l'utilisateur
			if($results == null){
				// tentative d'insertion du nouvel utilisateur dans la base
				try{
					$insert = UtilisateurDAO::getInstance()->insert($user);
					// enregistrement d'informations de session
					if ($insert){
						$_SESSION['insert'] = 'true';
						$_SESSION['identifiant'] = $mail;
						$_SESSION['password'] = $pwd;
						$_SESSION['prenom'] = $prenom;
						$_SESSION['id'] = $cptUsers;
						$_SESSION['connexion'] = 'ok';

					// indique que l'insertion n'a pas pu être effectuée
					}else{
						$_SESSION['insert'] = 'false_id';
					}
				}catch(PDOException $ex){
					print $ex->getMessage();
				}
			// si results != null mail déjà utilisé	
			}else {
				$_SESSION['insert'] = 'false_mail';
			}
		}catch(PDOExcepetion $ex){
			print $ex->getMessage();
		}
	}
}

