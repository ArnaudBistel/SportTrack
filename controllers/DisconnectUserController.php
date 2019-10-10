<?php

require_once ('controllers/Controller.php');
/**
* Gère la déconnexion de l'utilsiateur après qu'il est cliqué sur 'deconnexion'
*/
class DisconnectUserController implements Controller{
	public function handle ($request){ 
		
		// vérifie que le client est bien connecté
		if(isset ($_SESSION['identifiant']) && isset ($_SESSION['password'])){
			// détruit les variables de session
			session_unset();
			// détruit la session
			session_destroy();
	    }
	}
}
