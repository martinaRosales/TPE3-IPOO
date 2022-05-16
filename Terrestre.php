<?php
include_once "Viaje.php";
//se crea la clase hija Terrestre
class Terrestre extends Viaje {
    private $comodidad_asiento;

    //se implementan los constructores de la clase padre Viaje y de la clase Terrestre
    public function __construct($codigo, $destino, $maxPasajeros, $pasajeros, $responsable, $importe, $ida_vuelta, $comodidad_asiento)
    {
        parent :: __construct ($codigo, $destino, $maxPasajeros, $pasajeros, $responsable, $importe, $ida_vuelta);
        $this -> comodidad_asiento = $comodidad_asiento;    
    }

    //se implementan los get y los set

    public function getcomodidad_asiento (){
        return $this -> comodidad_asiento;
    }

    public function setcomodidad_asiento ($new_asiento){
        $this -> comodidad_asiento = $new_asiento;
    }

    //se implementta el método __toString de la clase Padre Viaje y de la clase Terrestre
    public function __toString()
    {
        $infoTerrestre = "****** VIAJE TERRESTRE ******\n" . "Tipo de asiento: ". $this -> getcomodidad_asiento(). "\n". parent :: __toString();
        return $infoTerrestre;
    }

    //Función que registra la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible.
    public function venderPasaje ($pasajero){
        parent :: venderPasaje($pasajero);
        $importe = $this -> getimporte();
        $asiento = $this -> getcomodidad_asiento();
        if ($asiento == "cama"){
            $importe = $importe * 1.25;
        } 
        return $importe;
    }
}