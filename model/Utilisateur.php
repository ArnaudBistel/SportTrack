<?php
/**
* Classe représentant un Utilisateur.
* Elle sera notamment utilisée pour l'insertion des données concernant un Utilisateur dans la BDD
*/
class Utilisateur {
	private $id;
	private $nom;
	private $prenom;
	private $dateNaissance;
	private $sexe;
	private $taille;
	private $poids;
	private $mail;
	private $motDePasse;

	// Constructeur vide pour permettre l'utilisation de PDO pour la gestion de la BDD	
	public function __construct (){ }

	/**
	* Initialise les attributs de l'instance courante d(Utilisateur
	* @param i, clé représentant l'Utilisateur
	* @param n, nom de l'Utilisateur
	* @param p, prénom de l'Utilisateur
	* @param d, date de naissance de l'Utilisateur
	* @param s, sexe de l'Utilisateur
	* @param t, taille de l'Utilisateur
	* @param pds, poids de l'Utilisateur
	* @param m, mail de de l'Utilisateur
	* @param mp, mot de passe  de l'Utilisateur
	*/
	public function init ($i, $n, $p, $d, $s, $t, $pds, $m, $mp){
		$this->id = $i;
		$this->nom = $n;
		$this->prenom = $p;
		$this->dateNaissance = $d;
		$this->sexe = $s;
		$this->taille = $t;
		$this->poids = $pds;
		$this->mail = $m;
		$this->motDePasse = $mp;
	}

	// ---- GETTERS AND SETTERS
	public function getID(){ return $this->id; }
	public function getNom(){ return $this->nom; }
	public function getPrenom(){ return $this->prenom; }
	public function getDateNaissance(){ return $this->dateNaissance; }
	public function getSexe(){ return $this->sexe; }
	public function getTaille(){ return $this->taille; }
	public function getPoids(){ return $this->poids; }
	public function getMail(){ return $this->mail; }
	public function getMotDePasse(){ return $this->motDePasse; }
}

?>