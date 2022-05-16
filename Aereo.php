<?php
include_once "Viaje.php";
//Se crea la clase hija Aereo
class Aereo extends Viaje {
    private $numero_vuelo;
    private $categoria_asiento;
    private $aerolinea;
    private $cantidad_escalas;

    //se implementan el constructor de la clase Aereo y de la clase padre Viaje

    public function __construct($codigo, $destino, $maxPasajeros, $pasajeros, $responsable, $importe, $ida_vuelta, $numero_vuelo, $categoria_asiento, $aerolinea, $cantidad_escalas)
    {
        parent :: __construct ($codigo, $destino, $maxPasajeros, $pasajeros, $responsable, $importe, $ida_vuelta);
        $this -> numero_vuelo = $numero_vuelo;
        $this -> categoria_asiento = $categoria_asiento;
        $this -> aerolinea = $aerolinea;
        $this -> cantidad_escalas = $cantidad_escalas;
    }

    //se implementan los get y los set

    public function getnumero_vuelo (){
        return $this -> numero_vuelo;
    }

    public function getcategoria_asiento (){
        return $this -> categoria_asiento;
    }

    public function getaerolinea (){
        return $this -> aerolinea;
    }

    public function getcantidad_escalas(){
        return $this -> cantidad_escalas;
    }

    public function setnumero_vuelo ($new_num){
        $this -> numero_vuelo = $new_num;
    }

    public function setcategoria_asiento ($new_categoria){
        $this -> categoria_asiento = $new_categoria;
    }

    public function setaerolinea ($new_aerolinea){
        $this -> aerolinea = $new_aerolinea;
    }

    public function setcantidad_escalas ($new_cantidad){
        $this -> cantidad_escalas = $new_cantidad;
    }

    //se implementa el método __toString de la clase Aereo y el método  __toString de la clase padre Viaje
    public function __toString()
    {
        $infoTerrestre = "****** VIAJE AEREO ******\n" . "Categoría del asiento: ". $this -> getcategoria_asiento(). 
        "\nAerolínea: ". $this -> getaerolinea(). "\nCantidad de escalas: ". $this -> getcantidad_escalas. "\n".parent :: __toString();
        return $infoTerrestre;
    }

    //Función que registra la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible.
    public function venderPasaje ($pasajero){
        parent :: venderPasaje($pasajero);
        $importe = $this -> getimporte();
        $asiento = $this -> getcategoria_asiento();
        $escalas = $this -> getcantidad_escalas();
        if ($escalas > 0){
            if ($asiento == "primera clase"){
                $importe = $importe * 1.60;
            } else {
                $importe = $importe * 1.40;
            }
        }
        return $importe;
    }
    

}