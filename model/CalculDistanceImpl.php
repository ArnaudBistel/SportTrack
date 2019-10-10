<?php
  require_once("CalculeDistance.php");

  /**
  * Classe qui extrait des informations GPS d'un fichier JSON puis calcule la distance correspondant aux données recuillies.
  */
  class CalculDistanceImpl implements CalculDistance {
    private $leParcours;
    private $rayon = 6378137;
    //private $jsonFile;

    /**
    * Constructeur de la classe CalculDistanceImpl.
    * @param Array $points représente un tableau contenant les latitudes et longitudes de deux points GPS.
    */
    public function __construct( $fileName ) {
      if (isset( $fileName) ){
        $json = file_get_contents ($fileName);
        $parsed_json = json_decode( $json );
        $array = $parsed_json -> data;

        $array_length = count($array);

        for ( $i = 0 ; $i < $array_length ; $i++ ){
          $this -> leParcours[$i]["latitude"] = $array [$i] -> latitude;
          $this -> leParcours[$i]["longitude"] = $array [$i] -> longitude;
        }
        //var_dump($this -> leParcours);
      }
    }


    /**
     * Retourne la distance en mètres entre 2 points GPS exprimés en degrés.
     * @param float $lat1 Latitude du premier point GPS
     * @param float $long1 Longitude du premier point GPS
     * @param float $lat2 Latitude du second point GPS
     * @param float $long2 Longitude du second point GPS
     * @return float La distance entre les deux points GPS
     */
     public function calculDistance2PointsGPS($lat1, $long1, $lat2, $long2){
       $la1 = pi() * $lat1 / 180;
       $lon1 = pi() * $long1 / 180;
       $la2 = pi() * $lat2 / 180;
       $lon2 = pi() * $long2 / 180;
       $distance = $this -> rayon * acos( sin($la2) * sin($la1) + cos ($la2) * cos($la1) * cos ($lon2 - $lon1));
       return $distance;
    }


    /**
     * Retourne la distance en metres du parcours passé en paramètres. Le parcours est
     * défini par un tableau ordonné de points GPS.
     * @param Array $parcours Le tableau contenant les points GPS
     * @return float La distance du parcours
     */
     public function calculDistanceTrajet(){
       $distanceTotale = 0;
       $parcoursLength = count ( $this -> leParcours );

       for ($i = 0; $i < ( $parcoursLength - 1 ); $i++){
          $distance2points = $this -> calculDistance2PointsGPS(
               $this -> leParcours[$i]["latitude"],  $this -> leParcours[$i]["longitude"],
               $this -> leParcours[$i + 1]["latitude"],  $this -> leParcours[$i + 1]["longitude"]);
          $distanceTotale = $distanceTotale + $distance2points;
        }
        return $distanceTotale;
      }
    }
 ?>
