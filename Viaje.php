<?php
//se crea la clase Viaje
class Viaje{
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $pasajeros; //Pasajeros es un arreglo multidimensional
    private $objResponsable;
    private $importe;
    private $ida_vuelta; //boolean true significa ida y vuelta, false significa solo ida


    //se implementa el constructor para crear los objetos codigo, destino, maxPasajeros y pasajeros
    public function __construct ($codigo, $destino, $maxPasajeros, $pasajeros, $responsable, $importe, $ida_vuelta){
        $this -> codigo = $codigo;
        $this -> destino = $destino;
        $this -> maxPasajeros = $maxPasajeros;
        $this -> pasajeros = $pasajeros;
        $this -> objResponsable = $responsable;
        $this -> importe = $importe;
        $this -> ida_vuelta = $ida_vuelta;
    }

    //se implementan las funciones para acceder a los datos de los objetos

    public function getcodigo (){
        return $this -> codigo;
    }

    public function getdestino (){
        return $this -> destino;
    }

    public function getmaxPasajeros (){
        return $this -> maxPasajeros;
    }

    public function getpasajeros (){
        return $this -> pasajeros;
    }
    
    public function getobjResponsable (){
        return $this -> objResponsable;
    }

    public function getimporte (){
        return $this -> importe;
    }

    public function getida_vuelta (){
        return $this -> ida_vuelta;
    }
    //se implementan las funciones para modificar los datos de los objetos

    public function setcodigo ($codigoNuevo){
        $this -> codigo = $codigoNuevo;
    }

    public function setdestino ($destinoNuevo){
        $this -> destino = $destinoNuevo;
    }

    public function setmaxPasajeros ($maxPasajerosNuevo){
        $this -> maxPasajeros = $maxPasajerosNuevo;
    }

    public function setpasajeros ($pasajerosNuevo){
        $this -> pasajeros = $pasajerosNuevo;
    }

    public function setobjResponsable ($responsableNuevo){
        $this -> objResponsable = $responsableNuevo;
    }

    public function setimporte ($importeNuevo){
        $this -> codigo = $importeNuevo;
    }

    public function setida_vuelta ($ida_vueltaNuevo){
        $this -> codigo = $ida_vueltaNuevo;
    }

    //se implementa la función __toString para concatenar el contenido de los objetos
    public function __toString (){
        //se utiliza una función a parte para concatenar el contenido del arreglo pasajeros
        //$infoPasajero = $this -> infoPasajero ();
        $infoPasajeros = $this -> infoPasajero();
        $infoViaje = "Código de viaje: ". $this -> getcodigo(). "\n 
        Destino de viaje: ". $this -> getdestino (). "\n 
        Responsable del viaje: \n". $this -> getobjResponsable(). "\n
        Cantidad máxima de pasajeros: ". $this -> getmaxPasajeros (). "\n
        Importe: ". $this -> getimporte(). "\n
        Ida y vuelta: " . $this -> idaYVuelta() ."\n
        INFORMACION PASAJEROS \n" . $infoPasajeros;
        return $infoViaje;
    }

    //Función que retorna true si hay objetos dentro del arreglo $pasajeros, caso contrario retorna false.
    public function hayPasajeros (){
        $pasajeros = $this -> getpasajeros();
        $existen = true;
        if (count ($pasajeros) == 0){
            $existen = false;
        }
        return $existen;
    }

    public function idaYVuelta (){
        $ida_vuelta = $this -> getida_vuelta();
        if ($ida_vuelta){
            $esida_vuelta = "ida y vuelta";
        } else {
            $esida_vuelta = "solo ida";
        }
        return $esida_vuelta;
    }


    //repetitiva que concatena la información de los pasajeros
    public function infoPasajero (){
        $listaPasajeros = " ";
        $pasajeros = $this -> getpasajeros ();
        for ($i = 0; $i < count ($pasajeros); $i++){
            $nombre = $pasajeros [$i] -> getatNombre();
            $apellido = $pasajeros [$i] -> getatApellido ();
            $dni = $pasajeros [$i] -> getatDNI ();
            $telefono = $pasajeros [$i] -> getatTelefono ();
            $listaPasajeros = $listaPasajeros. "\n". "Pasajero/a ". ($i+1). ": \nNombre: ".$nombre. "\nApellido: ". $apellido. "\nDNI: ". $dni. "\nTeléfono: ". $telefono."\n";
        }
        return $listaPasajeros;
    }

    //función que agrega objetos pasajero a un arreglo arrayPasajeros
    public function agregarPasajeros ($objPasajero){
        $arrayPasajeros = $this -> getpasajeros();
        $i = count($arrayPasajeros);
        $arrayPasajeros [$i] = $objPasajero;
        $this -> setpasajeros($arrayPasajeros);
    }

    //función que recibe la ubicación de un pasajero y con ese dato reconstruye 
    //el arreglo pasajeros sin el pasajero correspondiente al id ingresado por parámetro
    public function eliminarPasajeros ($idPasajero){
        $pasajeros = $this -> getpasajeros();
        $pasajerosNuevo = array();
        for ($i=0; $i< count($pasajeros); $i++){
            if ($i == $idPasajero){
            } else {
                array_push($pasajerosNuevo, $pasajeros[$i]);
            }
        }
        $this -> setpasajeros($pasajerosNuevo);
    }

    //función que modifica el contenido del atributo nombre de un objeto pasajero a partir de un 
    // índice en el arreglo pasajeros
    public function modificarNombrePasajero ($indice, $nombreNuevo){
        $pasajeros = $this -> getpasajeros ();
        $pasajeros [$indice] -> setatNombre ($nombreNuevo);
        $this -> setpasajeros ($pasajeros);
    }

    //función que modifica el contenido del atributo apellido de un objeto pasajero a partir de un 
    // índice en el arreglo pasajeros
    public function modificarApellidoPasajero ($indice, $apellidoNuevo){
        $pasajeros = $this -> getpasajeros ();
        $pasajeros [$indice] -> setatApellido ($apellidoNuevo);
        $this -> setpasajeros ($pasajeros);
    }

    //función que modifica el contenido del atributo dni de un objeto pasajero a partir de un 
    // índice en el arreglo pasajeros
    public function modificarDNIPasajero ($id, $dniNuevo){
        $pasajeros = $this -> getpasajeros ();
        $pasajeros [$id] -> setatDNI ($dniNuevo);
        $this -> setpasajeros ($pasajeros);
     }

     
    //función que modifica el contenido del atributo telefono de un objeto pasajero a partir de un 
    // índice en el arreglo pasajeros
    public function modificarTelefonoPasajero ($id, $telefonoNuevo){
        $pasajeros = $this -> getpasajeros ();
        $pasajeros [$id] -> setatTelefono ($telefonoNuevo);
        $this -> setpasajeros ($pasajeros);
    }

    //Función que modifica el atributo numero_empleado del objeto objResponsable
    public function modificarNumero_empleadoResponsable ($new_numeroEmpleado){
        $objResponsable = $this -> getobjResponsable ();
        $objResponsable -> setnum_empleado ($new_numeroEmpleado);
        $this -> setobjResponsable ($objResponsable);
    }

    //Función que modifica el atributo numero_licencia del objeto objResponsable
    public function modificarNumero_licenciaResponsable ($new_numeroLicencia){
        $objResponsable = $this -> getobjResponsable ();
        $objResponsable -> setnum_licencia ($new_numeroLicencia);
        $this -> setobjResponsable ($objResponsable);
    }

    //Función que modifica el atributo nombre del objeto objResponsable
    public function modificarNombre_Responsable ($new_nombre){
        $objResponsable = $this -> getobjResponsable ();
        $objResponsable -> setnombre ($new_nombre);
        $this -> setobjResponsable ($objResponsable);
    }

    //Función que modifica el atributo apellido del objeto objResponsable
    public function modificarApellido_Responsable ($new_apellido){
        $objResponsable = $this -> getobjResponsable ();
        $objResponsable -> setapellido ($new_apellido);
        $this -> setobjResponsable ($objResponsable);
    }

    //Función que retorna true si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y false caso contrario.
    public function hayPasajesDisponibles (){
        $maxPasajeros = $this -> getmaxPasajeros();
        $pasajeros = $this -> getpasajeros();
        if ($maxPasajeros > count($pasajeros)){
            $hayPasajes = true;
        } else {
            $hayPasajes = false;
        }
        return $hayPasajes;
    }

    //Función que registra la venta de un viaje al pasajero que es recibido por parámetro. La venta se realiza solo si hayPasajesDisponible.
    public function venderPasaje ($pasajero){
        $importe = $this -> getimporte();
        $ida_vuelta = $this -> getida_vuelta();
        $hayPasajes = $this -> hayPasajesDisponibles();
        if ($hayPasajes){
            $this -> agregarPasajeros($pasajero);
            if ($ida_vuelta){
                $importe = $importe*1.5;
            }
        } else {
            $importe = -1;
        }
        return $importe;
    } 
}