<?php

/**
* Controller d'application, est appelé à chaque nouvelle requête émanant du client.
* Il détermine quel controller et quelle vue utilisée
*/

class ApplicationController{
    private static $instance;
    private $routes;
    
    /**
    * Constructeur qui permet d'associer au mot clé de page transmis par la requête un controller et une vue
    */
    private function __construct(){
        // Sets the controllers and the views of the application.
        $this->routes = [
            '/' => ['controller'=>'MainController', 'view'=>'MainView'],
            'error' => ['controller'=>null, 'view'=>'ErrorView'],
			'user_add_form' => ['controller'=>null, 'view'=>'AddUserForm'],
			'user_connect_form' => ['controller'=>null, 'view'=>'ConnectUserForm'],
            'upload_activity_form' => ['controller'=>null, 'view'=>'UploadActivityForm'],
            'user_add' => ['controller' => 'AddUserController', 'view' => 'AddUserValidationView'],
            'user_connect' => ['controller' => 'ConnectUserController', 'view' => 'ConnectUserValidationView'],
            'user_disconnect' => ['controller' => 'DisconnectUserController', 'view' => 'DisconnectUserView'],
            'upload_activity' => ['controller' => 'UploadActivityController', 'view' => 'UploadActivityView'],
            'list_activities' => ['controller' => 'ListActivityController', 'view' => 'ListActivityView'],
            'user_modify_form' => ['controller' => null, 'view' => 'ModifyUserForm'],    
            'user_modify' => ['controller' => 'ModificationController', 'view' => 'ModificationValidationView'],  
            'profil' => ['controller' => 'ProfilController', 'view' => 'ProfilView']     
        ];
    }

    /**
     * Returns the single instance of this class.
     * @return ApplicationController the single instance of this class.
     */
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new ApplicationController;
        }
        return self::$instance;
    }

    /**
     * Returns the controller that is responsible for processing the request
     * specified as parameter. The controller can be null if their is no data to
     * process.
     * @param Array $request The HTTP request.
     * @param Controller The controller that is responsible for processing the
     * request specified as parameter.  
     */
    public function getController($request){
		if(array_key_exists($request['page'], $this->routes)){
			return $this->routes[$request['page']]['controller'];
		}	
		return null;
	}

    /**
     * Returns the view that must be return in response of the HTTP request
     * specified as parameter.  
     * @param Array $request The HTTP request.
     * @param Object The view that must be return in response of the HTTP request
     * specified as parameter. 
     */
    public function getView($request){
		if( array_key_exists($request['page'], $this->routes)){
			return $this->routes[$request['page']]['view'];
		}
		return $this->routes['error']['view'];
	}
}
?>
