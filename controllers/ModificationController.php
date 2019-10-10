<?php
require_once ('Controller.php');
require_once ('model/Utilisateur.php');
require_once ('model/UtilisateurDAO.php');
require_once ('model/SqliteConnection.php');
/**
* Controlleur qui est appelé après que l'utilisateur ait saisi ses informations de modification de son compte via le formulaire ModifyUserForm.php
* Il crée un nouvel Utililisateur avec les nouveaux paramètres saisis et récupère les paramètres non modifiable (id et mail) puis l'update dans la Base de données.
*/
class ModificationController implements Controller{
	public function handle ($request){
		$user = new Utilisateur();
		
		// récupère l'id de l'Utilisateur
		$id = $_SESSION['id'];
		// son mail
		$mail = strtolower ((String) $_SESSION['identifiant']);	
		// et son ancien mot de passe	
		$ancien_mdp = UtilisateurDAO::getInstance()->findPassword($mail); 

		// vérifie que l'utilisateur a saisi le bon ancien mot de passe
		if($request['OldPassword'] == $ancien_mdp){
			// initialisation de l'Utilsiateur en extrayant les données transmises dans le formulaire
			$profil = UtilisateurDAO::getInstance()->findProfilUser($mail);

			// suite de conditionnelles qui permettent de récupérer la valeur d'origine si le champ n'a pas été remplit lors de la modification
			if($request['nom'] == ""){
				$nom = $profil[0]['nom'];
			} else {
				$nom = $request['nom'];
			}
			if($request['prenom'] == ""){
				$prenom = $profil[0]['prenom'];
			} else {
				$prenom = $request['prenom'];
			}
			if($request['bday'] == ""){
				$naissance = $profil[0]['dateNaissance'];
			} else {
				$naissance = $request['bday'];
			}
			if($request['sexe'] == ""){
				$sexe = $profil[0]['sexe'];
			} else {
				$sexe = $request['sexe'];
			}
			if($request['taille'] == ""){
				$taille = $profil[0]['taille'];
			} else {
				$taille = $request['taille'];
			}
			if($request['poids'] == ""){
				$poids = $profil[0]['poids'];
			} else {
				$poids = $request['poids'];
			}
			if($request['NewPassword'] == ""){
				$mdp = $profil[0]['motDePasse'];
			} else {
				$mdp = $request['NewPassword'];
			}

				$user->init($id,
							$nom,
							$prenom,
							$naissance,
							$sexe,
							$taille,
							$poids,
							$mail,
							$mdp
				);

			$pwd = $request['NewPassword'];
			$prenom = $request['prenom'];
			
			// tentative d'update de l'utilisateur
			try{
				$insert = UtilisateurDAO::getInstance()->update($user);
				// enregistrement d'informations de session
				if ($insert){
					$_SESSION['update'] = 'true';
					$_SESSION['identifiant'] = $mail;
					$_SESSION['password'] = $pwd;
					$_SESSION['prenom'] = $prenom;
					// indique que l'insertion n'a pas pu être effectuée
				}else{
					$_SESSION['update'] = 'error';
				}
			}catch(PDOExcepetion $ex){
				print $ex->getMessage();
			}
		}else{
			$_SESSION['update'] = 'wrong_pwd';
		}
	}
}

