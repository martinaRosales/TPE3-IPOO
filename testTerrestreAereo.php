<?php 
//Se llama al script con las clases
require_once ("Clases.php");

//Se crea un objeto Terrestre por defecto, para poder probar el programa sin necesidad de crear uno nuevo
$objResponsable = new ResponsableV (3445, 3334445562, "Silvana", "Martínez");

$pasajero1 = new Pasajero ("María","Dolores", 40208976, 2995467324);
$pasajero2 = new Pasajero ("Ezequiel", "Zuñiga", 26188133, 117895543);
$pasajero3 = new Pasajero ("Muriel", "Jara", 44365218, 2234478895); 
$pasajero4 = new Pasajero ("Rogelio", "Buendia", 20459678, 154099876);
$pasajero5 = new Pasajero ("Franco", "Rezanovich", 39850322, 445673432);
$pasajero6 = new Pasajero ("Camila", "Troncoso", 41198762, 2343647585);
$pasajero7 = new Pasajero ("Mariana", "Arias", 42335785, 2435647586);

$arreglo_objpasajero = [$pasajero1, $pasajero2, $pasajero3, $pasajero4, $pasajero5, $pasajero6, $pasajero7];

$objViaje = new Terrestre (314, "Jujuy", 30, $arreglo_objpasajero, $objResponsable, 5000, false, "cama");

//************************************* 

/**
 * función cargarDatos
 * carga los datos del obj viaje, utiliza funciones para generar los obj responsableV y 
 * los pasajeros del array $pasajeros
 * @return object 
 */
function cargarDatos (){
    echo "Ingrese el código del viaje.\n";
    $codigoV = trim(fgets(STDIN));
    echo "Ingrese el destino del viaje.\n";
    $destinoV = trim(fgets(STDIN));
    echo "Ingrese el máximo de pasajeros del viaje.\n";
    $maxPasajerosV = trim(fgets(STDIN));
    echo "Ingrese el importe del viaje. \n";
    $importe = trim(fgets(STDIN));
    echo "Ingrese 1 si es solo ida o 2 si es ida y vuelta. \n";
    $rta = trim(fgets(STDIN));
    if ($rta==1){
        $ida_vuelta = false;
    } else {
        $ida_vuelta = true;
    }
    $objResponsable = cargarResponsableV();
    echo "Ingrese 1 si es viaje terrestre y 2 si es viaje aéreo. \n";
    $rta2 = trim(fgets(STDIN));
    if ($rta2== 1){
        echo "Ingrese el tipo de asiento.\n";
        $comodidad_asiento = trim(fgets(STDIN));
        $arregloPasajeros = generarArregloPasajeros($maxPasajerosV);
        $objViaje = new Terrestre ($codigoV, $destinoV, $maxPasajerosV, $arregloPasajeros, $objResponsable, $importe, $ida_vuelta, $comodidad_asiento);
    }else {
        echo "Ingrese el número de vuelo.\n";
        $numero_vuelo = trim(fgets(STDIN));
        echo "Ingrese la categoría del asiento. \n";
        $categoria_asiento = trim(fgets(STDIN));
        echo "Ingrese el nombre de la aerolínea.\n";
        $aerolínea = trim(fgets(STDIN));
        echo "Ingrese la cantidad de escalas. \n";
        $cantidad_escalas = trim(fgets(STDIN));
        $arregloPasajeros = generarArregloPasajeros($maxPasajerosV);
        $objViaje = new Aereo ($codigoV, $destinoV, $maxPasajerosV, $arregloPasajeros, $objResponsable, $importe, $ida_vuelta, $numero_vuelo, $categoria_asiento, $aerolínea, $cantidad_escalas);
    }    
    return $objViaje;
}

/**
 * función cargarResponsableV 
 * carga los datos del objeto responsableV y los retorna en una variable obj.
 * @return object
 */
function cargarResponsableV (){
    echo "Ingrese el número de empleado.\n";
    $numEmpleado = trim(fgets(STDIN));
    echo "Ingrese el número de licencia.\n";
    $numLicencia = trim(fgets(STDIN));
    echo "Ingrese el nombre del responsable del viaje.\n";
    $nombre_responsable = trim(fgets(STDIN));
    echo  "Ingrese el apellido del resposable del viaje.\n";
    $apellido_responsable = trim(fgets(STDIN));
    $objresponsableV = new ResponsableV ($numEmpleado, $numLicencia, $nombre_responsable, $apellido_responsable);
    return $objresponsableV;
}

/**
 * función generarPasajero
 * genera un solo objeto pasajero.
 * @return object
 */
function generarPasajero (){
    echo "Ingrese el nombre del pasajero.\n";
    $nombre_pasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido del pasajero.\n";
    $apellido_pasajero = trim(fgets(STDIN));
    echo "Ingrese sin puntos ni espacios el numero de documento del pasajero.\n";
    $dni_pasajero = trim(fgets(STDIN));
    echo "Ingrese sin espacios el número de teléfono del pasajero.\n";
    $telefono_pasajero = trim(fgets(STDIN));
    $objPasajero = new Pasajero ($nombre_pasajero, $apellido_pasajero, $dni_pasajero, $telefono_pasajero);
    return $objPasajero;
}

/**
 * función generarArregloPasajeros
 * genera objetos pasajeros, los agrega a un arregloPasajeros y lo retorna
 * @param int $maxPasajerosV
 * @return array
 */
function generarArregloPasajeros ($maxPasajerosV){
    $arregloPasajeros = [];
    $i = 0;
    do {
        $objPasajero = generarPasajero();
        if ($i > 0){
            $existe = buscarPasajeroRepetido($arregloPasajeros, $objPasajero);
            if ($existe){
                echo "*******\nEse pasajero ya existe, por favor ingrese uno nuevo.\n*******\n";
            } else {
                $arregloPasajeros [$i]= $objPasajero;
                $i = $i+1;
                echo "¿Desea cargar otro pasajero? S/N \n";
                $seguir = trim(fgets(STDIN));
                if ($i > $maxPasajerosV){
                    echo "**********\nYa llegó al límite de pasajeros, el pasajero no entra en este viaje.\n**********\n";
                }
            }
        }else {
            $arregloPasajeros [$i]= $objPasajero;
            $i = $i+1;
            echo "¿Desea cargar otro pasajero? S/N \n";
            $seguir = trim(fgets(STDIN));
            if ($i = $maxPasajerosV){
                echo "Ya llegó al límite de pasajeros, el pasajero no entra en este viaje.";
            }
        }
    } while ($seguir == "S" && $i <= $maxPasajerosV);
    return $arregloPasajeros;
}


/**
 * función buscarPasajeroRepetido
 * compara los datos dentro del atributo dni de ambos objetos y retorna true si hay coincidencias, false si no.
 * @param array $arregloPasajeros
 * @param object $objPasajero
 * @return boolean
 */
function buscarPasajeroRepetido ($arregloPasajeros, $objPasajero){
    $dniPasajero = $objPasajero -> getatDNI ();
    for ($i=0; $i < count($arregloPasajeros); $i++){
        $dniAcomparar = $arregloPasajeros[$i] -> getatDNI();
        if ($dniPasajero == $dniAcomparar){
            $existe = true;
        } else {
            $existe = false;
        }
    }
    return $existe;
}

/**
 * función modificarDatos
 * menu que da opciones para modificar datos, usa funciones para modificar el viaje, responsable y pasajero
 * @param object $objViaje
 */
function modificarDatos ($objViaje){
    do{
     echo "********* MENU DE CAMBIOS *********\n
     1) Modificar Viaje \n
     2) Modificar Responsable del viaje \n
     3) Modificar o eliminar un Pasajero \n
     4) Volver al menú principal. \n";
     $opcion_modificarDatos = trim(fgets(STDIN));
     if ($opcion_modificarDatos <= 4 && $opcion_modificarDatos >= 1){
         switch ($opcion_modificarDatos){
             case 1: 
                 modificarViaje ($objViaje);
             break;
             case 2:
                 modificarResponsable($objViaje);
             break;
             case 3: 
                //Se verifica que hayan pasajeros registrados
                if ($objViaje -> hayPasajeros()){
                    modificar_borrarPasajeros($objViaje);
                } else {
                    echo "No hay pasajeros registrados en este viaje.\n";
                }

             break;
             case 4:
             break;
         } 
     } else {
         echo "Su número no entra en el rango de opciones, vuelva a intentar.\n";
     }
    }while ($opcion_modificarDatos <> 4);
     echo "Datos modificados exitosamente.\n";
 }

 
/**
 * función modificarViaje
 * modifica los datos del objeto viaje.
 * @param object $objViaje
 */
function modificarViaje ($objViaje){
    if (is_a($objViaje, "Terrestre")){
        modificarTerrestre($objViaje);
    } else {
        modificarAereo($objViaje);
    }   
}

/**
 * función modificarAereo
 * modifica los datos del objeto viaje de la clase Aereo.
 * @param object $objViaje
 */
function modificarAereo ($objViaje){
    do{
        echo "**** MODIFICAR VIAJE ****\n
        1) Modificar código del viaje \n
        2) Modificar destino del viaje \n
        3) Modificar el máximo de pasajeros del viaje \n
        4) Modificar número de vuelo \n
        5) Modificar la categoría del asiento \n
        6) Modificar la aerolínea \n
        7) Modificar la cantidad de escalas \n 
        8) Volver atrás.\n";
        $opcion_modificarViaje = trim(fgets(STDIN));
        if ($opcion_modificarViaje <= 4 && $opcion_modificarViaje >= 1){
            switch ($opcion_modificarViaje ){
                case 1: //modificar código del viaje.
                    echo "Escriba el nuevo código.\n";
                    $codigo_nuevo = trim(fgets(STDIN));
                    $objViaje -> setcodigo ($codigo_nuevo);
                break;
                case 2: //modificar destino del viaje.
                    echo "Escriba el nuevo destino. \n";
                    $destino_nuevo = trim(fgets(STDIN));
                    $objViaje -> setdestino ($destino_nuevo);
                break; 
                case 3:  //modificar el máximo de pasajeros.
                    echo "Escriba el nuevo máximo de pasajeros. \n";
                    $maximoPasajeros_nuevo = trim(fgets(STDIN));
                    if ($maximoPasajeros_nuevo = count($objViaje -> getpasajeros())){
                        $objViaje -> setmaxPasajeros ($maximoPasajeros_nuevo);
                    } else {
                        echo "El número ingresado es igual al máximo actual";
                    }
                break;
                case 4: //modificar número de vuelo .
                    echo "Escriba el nuevo número de vuelo. \n";
                    $numero_nuevo = trim(fgets(STDIN));
                    $objViaje -> setnumero_vuelo ($numero_nuevo);
                break;
                case 5:  //modificar la categoría del asiento.
                    echo "Escriba la nueva categoría del asiento. \n";
                    $asiento_nuevo = trim(fgets(STDIN));
                    $objViaje -> setcategoria_asiento ($asiento_nuevo);
                break;
                case 6:  //modificar la aerolínea.
                    echo "Escriba la nueva aerolínea. \n";
                    $aerolinea_nueva = trim(fgets(STDIN));
                    $objViaje -> setaerolinea ($aerolinea_nueva);
                break;
                case 7:  //modificar la cantidad de escalas.
                    echo "Escriba la nueva cantidad de escalas. \n";
                    $escalas_nuevo = trim(fgets(STDIN));
                    $objViaje -> setcantidad_escalas ($escalas_nuevo);
                break;
                case 8:
                break;
            }
        } else {
            echo "El número ingresado no está dentro del rango de opciones, por favor, vuelva a intentar.\n";
        }
    } while ($opcion_modificarViaje <> 4);
    echo "Datos del VIAJE modificados correctamente.\n";
}


/**
 * función modificarTerrestre
 * modifica los datos del objeto viaje de la clase Terrestre.
 * @param object $objViaje
 */
function modificarTerrestre ($objViaje){
    do{
        echo "**** MODIFICAR VIAJE ****\n
        1) Modificar código del viaje \n
        2) Modificar destino del viaje \n
        3) Modificar el máximo de pasajeros del viaje \n
        4) Modificar el tipo de asiento \n
        5) Volver atrás.\n";
        $opcion_modificarViaje = trim(fgets(STDIN));
        if ($opcion_modificarViaje <= 4 && $opcion_modificarViaje >= 1){
            switch ($opcion_modificarViaje ){
                case 1: //modificar código del viaje.
                    echo "Escriba el nuevo código.\n";
                    $codigo_nuevo = trim(fgets(STDIN));
                    $objViaje -> setcodigo ($codigo_nuevo);
                break;
                case 2: //modificar destino del viaje.
                    echo "Escriba el nuevo destino. \n";
                    $destino_nuevo = trim(fgets(STDIN));
                    $objViaje -> setdestino ($destino_nuevo);
                break; 
                case 3:  //modificar el máximo de pasajeros.
                    echo "Escriba el nuevo máximo de pasajeros. \n";
                    $maximoPasajeros_nuevo = trim(fgets(STDIN));
                    if ($maximoPasajeros_nuevo = count($objViaje -> getpasajeros())){
                        $objViaje -> setmaxPasajeros ($maximoPasajeros_nuevo);
                    } else {
                        echo "El número ingresado es igual al máximo actual";
                    }
                break;
                case 4: //modificar el tipo de asiento.
                    echo "Escriba el nuevo tipo de asiento. \n";
                    $asiento_nuevo = trim(fgets(STDIN));
                    $objViaje -> setcomodidad_asiento ($asiento_nuevo);

                break;
                case 5:
                break;
            }
        } else {
            echo "El número ingresado no está dentro del rango de opciones, por favor, vuelva a intentar.\n";
        }
    } while ($opcion_modificarViaje <> 4);
    echo "Datos del VIAJE modificados correctamente.\n";
}

 /**
 * función modificarResponsable
 * modifica los atributos del objeto responsable
 * @param object $objViaje
 */
function modificarResponsable ($objViaje){
    
    do {
        echo "**** MODIFICAR RESPONSABLE DEL VIAJE ****\n
        1) Modificar el número de empleado.\n
        2) Modificar el número de licencia.\n
        3) Modificar el nombre del responsable del viaje \n
        4) Modificar el apellido del responsable del viaje \n
        5) Volver atrás\n";
        $opcion_modificarResponsable = trim(fgets(STDIN));
        if ($opcion_modificarResponsable <= 5 && $opcion_modificarResponsable >= 1){
            switch  ($opcion_modificarResponsable){
                case 1: // modificar número de empleado.
                    echo "Ingrese el nuevo número de empleado.\n";
                    $new_numEmpleado = trim(fgets(STDIN));
                    $objViaje -> modificarNumero_empleadoResponsable ($new_numEmpleado);
                break;
                case 2: //modificar número de licencia.
                    echo "Ingrese el nuevo número de licencia.\n";
                    $new_numLicencia = trim(fgets(STDIN));
                    $objViaje -> modificarNumero_licenciaResponsable ($new_numLicencia);
                break;
                case 3: //modificar nombre del responsable.
                    echo "Ingrese el nuevo nombre.\n";
                    $new_nombreResponsable = trim(fgets(STDIN));
                    $objViaje -> modificarNombre_Responsable ($new_nombreResponsable);
                break;
                case 4: // modificar apellido del responsable. 
                    echo "Ingrese el nuevo apellido.\n";
                    $new_apellidoResponsable = trim(fgets(STDIN));
                    $objViaje -> modificarApellido_Responsable ($new_apellidoResponsable);
                break;
                case 5:
                break;
            }
        } else {
            echo "El número ingresado no está dentro del rango de opciones, por favor vuelva a intentar.\n";
        }
    } while ($opcion_modificarResponsable <> 5);
    echo "Cambios en el responsable del viaje realizados exitosamente.\n";
}


/**
 * función modificar_borrarPasajeros
 * permite modificar o borrar objetos pasajero dentro del arreglo pasajeros
 * no logré hacer funcionar la opción para borrar pasajeros
 * @param object $objViaje
 */
function modificar_borrarPasajeros ($objViaje){
    do {
        echo "**** MODIFICAR PASAJEROS ****\n
    Ingrese el número de documento del pasajero que desea modificar o ingrese 1 si desea volver atrás.\n";
    $numeroIngresado = trim(fgets(STDIN));
 
    if ($numeroIngresado <> 1){
        $idPasajero = buscarPasajero($objViaje, $numeroIngresado);
        if ($idPasajero <> -1){
            echo "** PASAJERO ENCONTRADO **\n
            1) Modificar datos \n
            2) Eliminar pasajero \n";
            $opcion = trim(fgets(STDIN));
            if ($opcion <= 2 && $opcion >=1){
                switch ($opcion){
                    case 1:
                        modificar_unPasajero($objViaje, $idPasajero);
                    break;
                    case 2:
                        $objViaje -> eliminarPasajeros ($idPasajero);
                    break;
                }
            } else {
              echo "El número ingresado no está dentro del rango de opciones, por favor inténtelo de nuevo.\n";
            }
        } else {
            echo "El pasajero ingresado no existe, por favor inténtelo de nuevo. \n";
        }
    }
    }while ($numeroIngresado <> 1 && $objViaje -> hayPasajeros());
    //Se verifica si ya no quedan pasajeros por borrar, y se imprime un aviso de que ya no quedan pasajeros
    if (!$objViaje -> hayPasajeros()){
        echo "No hay pasajeros registrados en este viaje.\n";
    }
}

/**
 * función buscarPasajero
 * busca un objeto pasajero dentro del arreglo pasajeros a partir del atributo dni
 * @param object $objViaje
 * @param int $dni
 * @return int
 */
function buscarPasajero ($objViaje, $dni){
    $obj_arregloPasajeros = $objViaje -> getpasajeros();
    $idPasajero = -1;
    for ($i = 0 ; $i < count($obj_arregloPasajeros); $i++) {
        if ($obj_arregloPasajeros [$i] -> getatDNI() == $dni){
            $idPasajero = $i;
        } 
    } 
    return $idPasajero;
}

/**
 * función modificar_unPasajero
 * permite modificar todos los atributos de un objeto pasajero
 * @param object $objViaje
 * @param int $idPasajero
 */
function modificar_unPasajero ($objViaje, $idPasajero){
    do {
        echo "* MODIFICAR PASAJERO *\n
        1) Modificar nombre \n
        2) Modificar apellido \n
        3) Modificar número de documento \n
        4) Modificar número de teléfono \n
        5) Volver atrás \n";
        $opcion_modificarPasajero = trim(fgets(STDIN));
        if ($opcion_modificarPasajero <= 5 && $opcion_modificarPasajero >=1){
            switch ($opcion_modificarPasajero){
                case 1: //modificar nombre
                    echo "Ingrese el nombre nuevo.\n";
                    $nuevo_nombrePasajero = trim(fgets(STDIN));
                    $objViaje -> modificarNombrePasajero ($idPasajero, $nuevo_nombrePasajero);
                break;
                case 2://modificar apellido
                    echo "Ingrese el apellido nuevo.\n";
                    $nuevo_apellidoPasajero = trim(fgets(STDIN));
                    $objViaje -> modificarApellidoPasajero ($idPasajero, $nuevo_apellidoPasajero);
                break;
                case 3: //modificar número de documento
                    echo "Ingrese el número de documento nuevo.\n";
                    $nuevo_dniPasajero = trim(fgets(STDIN));
                    $objViaje -> modificarDNIPasajero ($idPasajero, $nuevo_dniPasajero);
                break;
                case 4: //modificar número de teléfono
                    echo "Ingrese el número de teléfono nuevo.\n";
                    $nuevo_telefonoPasajero = trim(fgets(STDIN));
                    $objViaje -> modificarTelefonoPasajero ($idPasajero, $nuevo_telefonoPasajero);
                break;
                case 5:
                break;
            }
        } else {
            echo "El número ingresado no está dentro del rango de opciones, por favor inténtelo de nuevo. \n";
        }
    
    } while ($opcion_modificarPasajero <> 5);
}



// PROGRAMA PRINCIPAL
do {
    echo "******* MENU PRINCIPAL *******\n
    1) Cargar datos de un viaje.\n
    2) Modificar datos del viaje. \n
    3) Ver datos del viaje. \n
    4) Vender un pasaje. \n
    5) Salir. \n";
    $opcionMenu = trim(fgets(STDIN));
    if ($opcionMenu >= 1 && $opcionMenu <= 5){
        switch ($opcionMenu){
            case 1:
                $objViaje = cargarDatos();
            break;
            case 2:
                modificarDatos($objViaje);
            break;
            case 3:
                echo $objViaje -> __toString();
            break;
            case 4:
                $objPasajero =  generarPasajero ();
                $importe = $objViaje -> venderPasaje ($objPasajero);
                echo "El importe del pasaje para este viaje es de: ". $importe. "\n";
            break;
            case 5:
            break;
        }
    }else {
        echo "El número ingresado no está dentro del rango de opciones, por favor inténtelo de nuevo.\n";
    }
} while ($opcionMenu <> 5);
echo "¡Hasta pronto!";
