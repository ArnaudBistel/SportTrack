<?php

require_once ('Donnees.php');
require_once ('Activite.php');
require_once ('SqliteConnection.php');
/**
* Classe utilisant le modèle d'accès aux données DAO afin de gérer les données de la classe Donnée.
* Elle offre un ensemble de méthodes permettant l'insertion, la suppression et la mise à jour des Données dans la BDD du site.
* Mais également un ensemble de méthodes de recherche dans cette BDD.
*/
class DonneesDAO{
	// l'instance de DAO
	private static $dao = null;
	
	// constructeur vide
	private final function __construct(){}

	/**
	* Méthode qui permet retourne l'unique instance de DonneeDAO, en la créant si elle n'existe pas encore.
	* @return the instance of DonneeDAO
	*/
	public final static function getInstance(){
		if( !isset (self::$dao)) {
			self::$dao = new DonneesDAO();
		}
		return self::$dao;
	}

	/**
	* Méthode d'insertion d'une instance de Donnee dans la BDD
	* @param activite , une instance d'Donnee
	*/
	public final function insert ($donnee){
		if( $donnee instanceof Donnees ){
			try{
				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "INSERT INTO Donnees (lActivite, temps, freqCardiaque, latitude, longitude, altitude) VALUES (:lActivite, :temps, :freqCardiaque, :latitude, :longitude, :altitude)";

				$stmt = $dbc->prepare($query);

				$time = new DateTime($donnee->getTemps());


				$stmt->bindValue(':lActivite', $donnee->getLActivite(), PDO::PARAM_INT);
				$stmt->bindValue(':temps', $time->format('H:i:s'), PDO::PARAM_STR);
				$stmt->bindValue(':freqCardiaque', $donnee->getFreqCardiaque(), PDO::PARAM_INT);
				$stmt->bindValue(':latitude', $donnee->getLatitude(), PDO::PARAM_INT);
				$stmt->bindValue(':longitude', $donnee->getLongitude(), PDO::PARAM_INT);
				$stmt->bindValue(':altitude', $donnee->getAltitude(), PDO::PARAM_INT);

				$stmt->execute();
			}catch(PDOException $ex){
				print $ex->getMessage();
			}
		}
	}
	/**
	* Supprime le tuples correspondant à l'instance de Donnée reçue en paramètre de la BDD
	* @param activite, l'instance d'activite dont il faut supprimer le tuple
	*/
	public final function delete($donnee){
		try{
			if($donnee instanceof Donnees){

				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "DELETE FROM Donnees
							WHERE lActivite = :lActivite
							AND temps = :temps";

				$stmt = $dbc->prepare($query);

				$stmt->bindValue(':lActivite', $donnee->getLActivite(), PDO::PARAM_INT);
				$stmt->bindValue(':temps', $donnee->getTemps(), PDO::PARAM_INT);

				$stmt->execute();
			}
		}catch(PDOException $ex){
			print $ex->getMessage();
		}		
	}

	/**
	* Supprime tous les tuples contenus dans la table Donnée
	*/
	public final function deleteAll(){
		try{
			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "DELETE FROM Donnees";
			$stmt = $dbc->query($query);
			echo "toute Données supprimées";

		}catch(PDOException $ex){
			print $ex->getMessage();
		}			
	}

	/**
	* Méthode de mise à jour d'un tuple correspondant à la Donnée reçue en paramètre.
	* @param activite, l'instance de Donnée dont il faut modifier le tuple
	* @return true si la mise à jour a été effectuée
	*/
	public final function update($donnee){
		if($donnee instanceof Donnees){
			try{
				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "UPDATE Donnees SET freqCardiaque = :freqCardiaque,
											latitude = :latitude,
											longitude = :longitude,
											altitude = :altitude
											WHERE lActivite = :lActivite
											AND temps = :temps";

				$stmt=$dbc->prepare($query);

				$stmt->bindValue(':freqCardiaque', $donnee->getFreqCardiaque(), PDO::PARAM_INT);
				$stmt->bindValue(':latitude', $donnee->getLatitude(), PDO::PARAM_INT);
				$stmt->bindValue(':longitude', $donnee->getLongitude(), PDO::PARAM_INT);
				$stmt->bindValue(':altitude', $donnee->getAltitude(), PDO::PARAM_INT);
				$stmt->bindValue(':temps', $donnee->getTemps(), PDO::PARAM_INT);
				$stmt->bindValue(':lActivite', $donnee->getLActivite());

				$stmt->execute();
				return true;
			}catch(PDOException $ex){
				print $ex->getMessage();
			}			
		}
	}

	/**
	* Retourne l'ensemble des tuples enregistrés dans la table Donnee
	*/
	public final function findAll(){
		try{
			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "SELECT * FROM Donnees";
			$stmt= $dbc->query($query);
			$results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Donnees');
		}catch(PDOException $ex){
			print $ex->getMessage();
		}
		return $results;
	}	

	/**
	* Méthode de recherche qui retourne l'ensemble des tuples de Donnée associés à une activité représentée par son numéro.
	* @param activite, l'activité dont on recherche les Données
	*/
	public final function trouverDonneeDActivite($activité){
		try{	
			if($activité instanceof Activite){
				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "SELECT * FROM Donnees WHERE lActivite = :lActivite";

				$stmt=$dbc->prepare($query);

				$stmt->bindValue(':lActivite', $activité->getNoActivite(), PDO::PARAM_INT);

				$stmt->execute();

				$results = $stmt->fetchAll();
				return $results;
			}
		}catch(PDOException $ex){
			print $ex->getMessage();
		}	
	}
}

?>
