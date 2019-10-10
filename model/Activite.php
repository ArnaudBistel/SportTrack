<?php
/**
* Classe représentant une activité.
* Elle sera notamment utilisée pour l'insertion des données concernant une activité dans la BDD
*/
class Activite {
	private $noActivite;
	private $dateActivite;
	private $description;
	private $heureDebut;
	private $duree;
	private $distance;
	private $freqCardiaqueMin;
	private $freqCardiaqueMax;
	private $freqCardiaqueMoy;
	private $lUtilisateur;

	// Constructeur vide pour permettre l'utilisation de PDO pour la gestion de la BDD
	public function __construct (){ }

	/**
	* Initialise les attributs de l'instance courante d'Activité
	* @param na, le numéro d'activité
	* @param da, la date de l'activité
	* @param desc, la description d'activité
	* @param h, l'heure de début de l'activité
	* @param d, durée d'activité
	* @param dist, distance parcourue durant d'activité
	* @param fmin, fréquence cardiaque minimale durant l'activité
	* @param fmax, fréquence cardiaque maximale durant l'activité
	* @param fmoy,  fréquence cardiaque moyenne durant l'activité
	* @param u, utilisateur concerbé par l'activité
	*/
	public function init ($na, $da, $desc, $h, $d, $dist, $fmin, $fmax, $fmoy, $u){
		$this->noActivite = $na;
		$this->dateActivite = $da;
		$this->description = $desc;
		$this->heureDebut = $h;
		$this->duree = $d;
		$this->distance = $dist;
		$this->freqCardiaqueMin = $fmin;
		$this->freqCardiaqueMax = $fmax;
		$this->freqCardiaqueMoy = $fmoy;
		$this->lUtilisateur = $u;
	}

	// ---- GETTERS AND SETTERS
	public function getNoActivite(){ return $this->noActivite; }
	public function getDateActivite(){ return $this->dateActivite; }
	public function getDescription(){ return $this->description; }
	public function getHeureDebut(){ return $this->heureDebut; }
	public function getDuree(){ return $this->duree; }
	public function getDistance(){ return $this->distance; }
	public function getFreqCardiaqueMin(){ return $this->freqCardiaqueMin; }
	public function getFreqCardiaqueMax(){ return $this->freqCardiaqueMax; }
	public function getFreqCardiaqueMoy(){ return $this->freqCardiaqueMoy; }
	public function getLUtilisateur(){ return $this->lUtilisateur; }
}

?>