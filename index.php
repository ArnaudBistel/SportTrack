<?php
	// début de la session à l'arrivé sur la page index.
	// permettra d'avoir accès aux variables de session
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	define('__ROOT__', dirname(__FILE__));	

	require_once ('controllers/ApplicationController.php');
	require_once ('controllers/MainController.php');

	// si une page est spécifiée AplicationController lancera le controleur concerné et la vue associée
	if(isset($_REQUEST['page']) && ! empty($_REQUEST['page'])){
		$controller = ApplicationController::getInstance()->getController($_REQUEST);
		//appel du controller concerné
		if($controller != null){
			// L'instruction de langage require inclut et exécute le fichier spécifié en argument. 
			require_once "controllers/$controller.php";
			(new $controller())->handle($_REQUEST);
		}
		// appel de la vue concernée
		$view = ApplicationController::getInstance()->getView($_REQUEST);
			if($view != null){
			include "views/$view.php";
		}

	// sinon on lance le MainController et la MainView 
	} else{
		$controller = new MainController();	
		$controller->handle($_REQUEST);
		include "views/MainView.php";
	}
?>

