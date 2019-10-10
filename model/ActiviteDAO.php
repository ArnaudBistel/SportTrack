<?php

require_once ('Activite.php');
require_once ('Utilisateur.php');
require_once ('SqliteConnection.php');
/**
* Classe utilisant le modèle d'accès aux données DAO afin de gérer les données de la classe Activité.
* Elle offre un ensemble de méthodes permettant l'insertion, la suppression et la mise à jour des données d'Activité dans la BDD du site.
* Mais également un ensemble de méthodes de recherche dans cette BDD.
*/
class ActiviteDAO{
	
	// l'instance de DAO
	private static $dao = null;

	// constructeur vide
	private function __construct (){}

	/**
	* Méthode qui permet retourne l'unique instance de ActiviteDAO, en la créant si elle n'existe pas encore.
	* @return the instance of ActiviteDAO
	*/
	public final static function getInstance(){
		if( !isset (self::$dao)){
			self::$dao = new ActiviteDAO();
		}
		return self::$dao; 
	}

	/**
	* Retourne l'ensemble des tuples enregistrés dans la table Activite
	*/
	public final function findAll(){
		try {
			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "SELECT * FROM Activite";
			$stmt = $dbc->query($query);
			$results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Activite');
			return $results;
		}catch(PDOException $ex){
			print $ex->getMessage();
		}
	}

	/**
	* Retourne l'ensemble des tuples d'Activite associé à l'utilisateur reçu en paramètre.
	* @param user, l'utilisateur paramètre de la recherche
	*/	
	public final function findUsersActivities($id){

			try{
				$dbc = SqliteConnection::getInstance()->getConnection();

				$identifiant = (int) $id;

				$query = "SELECT * FROM Activite WHERE lUtilisateur = $identifiant";

				$stmt = $dbc->query($query);
				$results = $stmt->fetchAll();
			}catch(PDOException $ex){
				print $ex->getMessage();
			}			
			return $results;
		
	}

	/**
	* Méthode d'insertion d'une instance d'Activite dans la BDD
	* @param activite , une instance d'Activite
	*/
	public final function insert($activite){
		if( $activite instanceof Activite) {
			try{
				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "INSERT INTO Activite (noActivite, dateActivite, description, heureDebut, duree, distance, freqCardiaqueMin, freqCardiaqueMax, freqCardiaqueMoy, lUtilisateur)
						 VALUES (:noActivite, :dateActivite, :description, :heureDebut, :duree, :distance, :freqCardiaqueMin, :freqCardiaqueMax, :freqCardiaqueMoy, :lUtilisateur)";

				// on formate l'heure de début en DateTime
				$heure_debut = new DateTime($activite->getHeureDebut());
				//$date_activite = new DateTime($activite->getDateActivite());
				$date= $activite->getDateActivite();

				$stmt = $dbc->prepare($query);

				$stmt->bindValue(':noActivite', $activite->getNoActivite(), PDO::PARAM_INT);
				$stmt->bindValue(':dateActivite', $activite->getDateActivite(), PDO::PARAM_STR);
				$stmt->bindValue(':description', $activite->getDescription(), PDO::PARAM_STR);
				$stmt->bindValue(':heureDebut', $heure_debut->format('H:i:s'), PDO::PARAM_STR);
				$stmt->bindValue(':duree', $activite->getDuree(), PDO::PARAM_INT);
				$stmt->bindValue(':distance', $activite->getDistance(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMin', $activite->getFreqCardiaqueMin(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMax', $activite->getFreqCardiaqueMax(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMoy', $activite->getFreqCardiaqueMoy(), PDO::PARAM_STR);
				$stmt->bindValue(':lUtilisateur', $activite->getLUtilisateur(), PDO::PARAM_INT);

				$stmt->execute();
			}catch(PDOException $ex){
				print $ex->getMessage();
			}			
		}
	}

	/**
	* Supprime tous les tuples contenus dans la table Activite
	*/
	public final function deleteAll(){
		try{	
			$dbc = SqliteConnection::getInstance()->getConnection();
			$query = "DELETE FROM Activite";
			$stmt = $dbc->query($query);
			echo "tout supprimé";
		}catch(PDOException $ex){
			print $ex->getMessage();
		}		
	}

	/**
	* Supprime le tuples correspondant à l'instance d'Activite reçue en paramètre de la BDD
	* @param activite, l'instance d'activite dont il faut supprimer le tuple
	*/
	public final function delete($activite){
		if($activite instanceof Activite){
			try{
				$dbc = SqliteConnection::getInstance()->getConnection();
				$query = "DELETE FROM Activite WHERE noActivite = :na";
				$stmt = $dbc->prepare($query);
				$stmt->bindValue(":na", $activite->getNoActivite());
				$stmt->execute();
				return true;
			}catch(PDOException $ex){
				print $ex->getMessage();
			}
		}
	}

	/**
	* Méthode de mise à jour d'un tuple correspondant à l'activite reçue en paramètre.
	* @param activite, l'instance d'Activite dont il faut modifier le tuple.
	* @return true si la mise à jour a été effectuée	
	*/
	public final function update($activite){
		if($activite instanceof Activite){
			try{
				$dbc = SqliteConnection::getInstance()->getConnection();

				$query = "UPDATE Activite SET dateActivite = :dateActivite,
											description = :description,
											heureDebut = :heureDebut,
											duree = :duree,
											distance = :distance,
											freqCardiaqueMin = :freqCardiaqueMin,
											freqCardiaqueMax = :freqCardiaqueMax,
											freqCardiaqueMoy = :freqCardiaqueMoy,
											lUtilisateur = :lUtilisateur
											WHERE noActivite = :noActivite";

				$stmt = $dbc->prepare($query);

				$stmt->bindValue(':dateActivite', $activite->getDateActivite(), PDO::PARAM_INT);
				$stmt->bindValue(':description', $activite->getDescription(), PDO::PARAM_INT);
				$stmt->bindValue(':heureDebut', $activite->getHeureDebut(), PDO::PARAM_INT);
				$stmt->bindValue(':duree', $activite->getDuree(), PDO::PARAM_INT);
				$stmt->bindValue(':distance', $activite->getDistance(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMin', $activite->getFreqCardiaqueMin(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMax', $activite->getFreqCardiaqueMax(), PDO::PARAM_INT);
				$stmt->bindValue(':freqCardiaqueMoy', $activite->getFreqCardiaqueMoy(), PDO::PARAM_INT);
				$stmt->bindValue(':lUtilisateur', $activite->getLUtilisateur(), PDO::PARAM_INT);
				$stmt->bindValue(':noActivite', $activite->getNoActivite(), PDO::PARAM_INT);

				$stmt->execute();
				return true;
			}catch(PDOException $ex){
				print $ex->getMessage();
			}		
		}
	}

}
?>
