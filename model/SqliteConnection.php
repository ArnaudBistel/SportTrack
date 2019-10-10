<?php

/**
 * SqliteConnection
 */

class SqliteConnection {
	private static $instance = null;

    private function __construct() {}

	/** 
	* Crée la connection à la BDD et retourne cette connexion.
	*/
	public static function getConnection() {	
      try{
    		$connection = new PDO('sqlite:'.__ROOT__."/db/sport_track.db");
        	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
		    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		    die($msg);
		}
		return $connection;
	}

	/**
	* Retourne l'unique instance de la Connection à la BDD.
	* @return l'unique instance de SqliteConnection
	*/
	public final static function getInstance(){
		if ( !isset (self::$instance)){
			self::$instance = new SqliteConnection();
		}
		return self::$instance;
	}
}

?>

