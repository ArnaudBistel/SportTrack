<?php
require_once('SqliteConnection.php');
require_once('Utilisateur.php');
/**
* Classe utilisant le modèle d'accès aux données DAO afin de gérer les données de la classe Utilisateur.
* Elle offre un ensemble de méthodes permettant l'insertion, la suppression et la mise à jour des données d'Utilisateur dans la BDD du site.
* Mais également un ensemble de méthodes de recherche dans cette BDD.
*/
class UtilisateurDAO{
  // l'instance de DAO
    private static $dao;

    private function __construct() {}

  /**
  * Méthode qui permet retourne l'unique instance de UtilisateurDAO, en la créant si elle n'existe pas encore.
  * @return the instance of UtilisateurDAO
  */
    public final static function getInstance() {
       if(!isset(self::$dao)) {
           self::$dao= new UtilisateurDAO();
       }
       return self::$dao;
    }

  /**
  * Méthode de recherche qui retourne tous les attributs d'un Utilisateur associé à une adresse mail reçue en paramètre.
  * @param mail, mail d'un utilisateur dont on recherhce les infos
  */   
    public final function findProfilUser($mail){
      try{
        $pdo = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Utilisateur WHERE mail = :mail";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $pwd_results = $stmt->fetchAll();

        if($pwd_results != null){
          return $pwd_results;
        }

      }catch(PDOException $ex){
        print $ex->getMessage();
      }    
    }

  /**
  * Méthode de recherche qui retourne le mot de passe associé à une adresse mail reçue en paramètre.
  * @param mail, mail d'un utilisateur dont on recherhce le mot de passe
  */   
    public final function findPassword($mail){
      try{
        $pdo = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT motDePasse FROM Utilisateur WHERE mail = :mail";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $pwd_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($pwd_results != null){
          $password = $pwd_results [0]['motDePasse'];
          return $password;
        }

      }catch(PDOException $ex){
        print $ex->getMessage();
      }    
    }
  /**
  * Méthode de recherche qui retourne l'identifaint (la clé) associée à une adresse mail reçue en paramètre.
  * @param mail, mail d'un utilisateur dont on recherche l'id'
  */   
    public final function findID($mail){
      try{
        $pdo = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT id FROM Utilisateur WHERE mail = :mail";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($results != null){
          $id = $results [0]['id'];
          return $id;  
        }

      }catch(PDOException $ex){
        print $ex->getMessage();
      } 
    }

    /**
    * Méthode de recherche qui retourne le prénom associé à une adresse mail reçue en paramètre.
    * @param mail, mail d'un utilisateur dont on recherhce le le prénom
    */   
    public final function findPrenom($mail){
       try{
          $pdo = SqliteConnection::getInstance()->getConnection();
          $query = "SELECT prenom FROM Utilisateur WHERE mail = :mail";
          $stmt = $pdo->prepare($query);
          $stmt->bindValue(':mail', $mail);
          $stmt->execute();
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if($results != null){
            $prenom = $results[0]['prenom'];
            return $prenom;  
          }
          
      }catch(PDOException $ex){
          print $ex->getMessage();
      }       
    }

    /**
    * Méthode de recherche qui retourne true si le mail passé en paramètre est déjà présent dans la BDD.
    * @param mail, mail d'un utilisateur dont on recherche le mot de passe
    */ 
    public final function findIfMailInserted($mail){
       try{
          $pdo = SqliteConnection::getInstance()->getConnection();
          $query = "SELECT * FROM Utilisateur WHERE mail = :mail";
          $stmt = $pdo->prepare($query);
          $stmt->bindValue(':mail', $mail);
          $stmt->execute();
          $results=$stmt->fetchAll(PDO::FETCH_CLASS, 'Utilisateur');
          return $results;
      }catch(PDOException $ex){
          print $ex->getMessage();
      }       
    }

    /**
    * Retourne l'ensemble des tuples enregistrés dans la table Utilisateur
    */
    public final function findAll(){
       try{
         // on récupère une connection à la BDD, la classe PDO représente une connexion entre PHP et un serveur de base de données. 
         $dbc = SqliteConnection::getInstance()->getConnection();
         
         // création de la requête qui recherche tous les Utilisateurs stockés dans la BDD
         $query = "SELECT * FROM Utilisateur;";
         
         // query appliquée à une instance de PDO exécute une requête SQL, retourne un jeu de résultats en tant qu'objet PDOStatement
         // La classe PDOStatement Représente une requête préparée et, une fois exécutée, le jeu de résultats associé.
         $stmt = $dbc->query($query);
         
         // PDOStatement::fetchAll  Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 
         // PDO::FETCH_CLASS: Retourne une instance de la classe désirée. Les colonnes sélectionnées sont liées aux attributs de la classe. 
         $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Utilisateur');
      }catch(PDOException $ex){
          print $ex->getMessage();
      } 
    }  

    /**
    * Méthode de recherche de la clé de l'utilisateur associé au mail passé en paramètre.
    * @param mail, mail d'un utilisateur dont on recherche le mot de passe
    */ 
    public final function findUserFromMail($mail){
      try{
        $dbc = SqliteConnection::getInstance()->getConnection();
        
        $query = "SELECT id FROM Utilisateur WHERE mail = :mail;";

        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $result=$stmt->fetch();
        return $result;
      }catch(PDOException $ex){
          print $ex->getMessage();
      }      
    }

    /**
    * Méthode de recherche qui retourne le prénom associé à une adresse mail reçue en paramètre.
    * @param mail, mail d'un utilisateur dont on recherhce le le prénom
    */  
    public final function findPwdFromMail($mail){
      $dbc = SqliteConnection::getInstance()->getConnection();
      
      $query = "SELECT motDePasse FROM Utilisateur WHERE mail = :mail;";

      $stmt = $dbc->prepare($query);
      $stmt->bindValue(':mail', $mail);
      $stmt->execute();
      $result=$stmt->fetch();
      return $result;
    }


  /**
  * Méthode d'insertion d'une instance d'Utilisateur dans la BDD
  * @param Utilisateur , une instance d'Utilisateur
  */
   public final function insert($user){
      if($user instanceof Utilisateur){
      		try{
        			 // récupère une connection à la BDD 
        			 $dbc = SqliteConnection::getInstance()->getConnection();
        			 
        			 // prepare the SQL statement
        			 $query = "INSERT into Utilisateur(id, nom, prenom,dateNaissance, sexe, taille, poids, mail, motDePasse) values (:i,:n,:p, :d, :s, :t, :pds, :m, :mp)";
        			 
        			 // Prépare la requête SQL et retourne un gestionnaire de requête instance de PDOStatement à utiliser pour les futures opérations sur la requête
        			 $stmt = $dbc->prepare($query); 

        			 // bind the paramaters
        			 // Associe une valeur à un nom correspondant ou à un point d'interrogation (comme paramètre fictif) dans la requête SQL qui a été utilisé pour préparer la requête. Ici dans $query
        			 $stmt->bindValue(':i', $user->getID());
        			 $stmt->bindValue(':n', $user->getNom());
        			 $stmt->bindValue(':p', $user->getPrenom());
        			 $stmt->bindValue(':d', $user->getDateNaissance());
        			 $stmt->bindValue(':s', $user->getSexe());
        			 $stmt->bindValue(':t', $user->getTaille());
        			 $stmt->bindValue(':pds', $user->getPoids());
        			 $stmt->bindValue(':m', $user->getMail());
        			 $stmt->bindValue(':mp', $user->getMotDePasse());

        			 $stmt->execute();
        			 return true;
      			 
      		}catch(PDOException $ex){
        			print $ex->getMessage();
        			return false;
      		} 
      }
  }

  /**
  * Supprime le tuples correspondant à l'instance d'Utilisateur reçue en paramètre de la BDD
  * @param Utilisateur, l'instance d'Utilisateur dont il faut supprimer le tuple
  */
  public final function delete($user){  
      if($user instanceof Utilisateur){
        try{
           $dbc = SqliteConnection::getInstance()->getConnection();


  	     	// récupère l'id de l'Utilisateur à supprimer
          $id = $user->getID();       
          $query = "DELETE FROM Utilisateur WHERE id = :id" ;
   
          $stmt = $dbc->prepare($query);
          $stmt->bindValue(':id', $id);
   
          $stmt->execute();
        }catch(PDOException $ex){
          print $ex->getMessage();
        } 
      }
   }

  /**
  * Méthode de mise à jour d'un tuple correspondant à l'Utilisateur reçue en paramètre.
  * @param Utilisateur, l'instance d'Utilisateur dont il faut modifier le tuple.
  * @return true si la mise à jour a été effectuée  
  */
  public final  function update($user){
      if($user instanceof Utilisateur){
          try{
              $dbc = SqliteConnection::getInstance()->getConnection();

              $id = $user->getID();

              $query = "UPDATE Utilisateur
                        SET nom = :n,
                        prenom = :p,
                        dateNaissance = :d,
                        sexe = :s,
                        taille = :t,
                        poids = :pds,
                        mail = :m,
                        motDePasse = :mp
                        where id = :i"; 

              $stmt = $dbc->prepare($query);

              $stmt->bindValue(':n', $user->getNom(), PDO::PARAM_STR);
              $stmt->bindValue(':p', $user->getPrenom(), PDO::PARAM_STR);
              $stmt->bindValue(':d', $user->getDateNaissance(), PDO::PARAM_STR);
              $stmt->bindValue(':s', $user->getSexe(), PDO::PARAM_STR);
              $stmt->bindValue(':t', $user->getTaille(), PDO::PARAM_STR);
              $stmt->bindValue(':pds', $user->getPoids(), PDO::PARAM_STR);
              $stmt->bindValue(':m', $user->getMail(), PDO::PARAM_STR);
              $stmt->bindValue(':mp', $user->getMotDePasse(), PDO::PARAM_STR);
              $stmt->bindValue(':i', $id, PDO::PARAM_STR);          

              $stmt->execute();
              return true;
          }catch(PDOException $ex){
             print $ex->getMessage();
          } 
      }
   }
}
?>
