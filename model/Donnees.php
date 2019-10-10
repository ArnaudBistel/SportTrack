<?php
/**
* Classe représentant une Donnée.
* Elle sera notamment utilisée pour l'insertion des instances de Données dans la BDD
*/
class Donnees {
	private $lActivite;
	private $temps;
	private $freqCardiaque;
	private $latitude;
	private $longitude;
	private $altitude;

	// Constructeur vide pour permettre l'utilisation de PDO pour la gestion de la BDD
	public function __construct (){ }

	/**
	* Initialise les attributs de l'instance courante de Donnée
	* @param a, le numéro d'activité correspondant à cette Donnée
	* @param t, temps  correspondant au moment où la Donnée a été enregistrée
	* @param f, fréquence cardiaque
	* @param lat, latitude à laquelle la donnée a été enregistrée
	* @param lon, longitude à laquelle la donnée a été enregistrée
	* @param alt, altitude à laquelle la donnée a été enregistrée
	*/
	public function init ($a, $t, $f, $lat, $lon, $alt){
		$this->lActivite = $a;
		$this->temps = $t;
		$this->freqCardiaque = $f;
		$this->latitude = $lat;
		$this->longitude = $lon;
		$this->altitude = $alt;
	}

	// ---- GETTERS AND SETTERS	
	public function getLActivite(){ return $this->lActivite; }
	public function getTemps(){ return $this->temps; }
	public function getFreqCardiaque(){ return $this->freqCardiaque; }
	public function getLatitude(){ return $this->latitude; }
	public function getLongitude(){ return $this->longitude; }
	public function getAltitude(){ return $this->altitude; }
}

?>
