<?php
/******************************************
* Completar:
* Cristhian Cantero / Braian Centurion - FAI-3073 / FAI-3001
******************************************/

/**
* genera un arreglo de palabras para jugar
* @return array
*/
function cargarPalabras(){
  $coleccionPalabras = array();
  $coleccionPalabras[0]= array("palabra"=> "perro" , "pista" => "animal doméstico", "puntosPalabra"=>5);
  $coleccionPalabras[1]= array("palabra"=> "tomate" , "pista" => "fruta de color rojo", "puntosPalabra"=> 6);
  $coleccionPalabras[2]= array("palabra"=> "electroencefalografista" , "pista" => "persona especializada en electroencefalografía", "puntosPalabra"=> 23);
  $coleccionPalabras[3]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=> 4);
  $coleccionPalabras[4]= array("palabra"=> "higado" , "pista" => "órgano triangular", "puntosPalabra"=> 6);
 
  return $coleccionPalabras; 
}

/**
* genera un arreglo de los juegos ya realizados
* @return array
*/
function cargarJuegos(){
	$coleccionJuegos = array();
    $coleccionJuegos[0] = array("puntos"=> 5, "indicePalabra" => 3);
    $coleccionJuegos[1] = array("puntos"=> 25, " indicePalabra " => 2);
    $coleccionJuegos[2] = array("puntos"=> 0, " indicePalabra " => 0);//no descubrio la palabra
    $coleccionJuegos[3] = array("puntos"=> 8, " indicePalabra " => 1);
    $coleccionJuegos[4] = array("puntos"=> 0, " indicePalabra " => 4);//no descubrio la palabra

    return $coleccionJuegos;
}

/**
* a partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
* @param string $palabra
* @return array
*/
function dividirPalabraEnLetras($palabra){    
    // $coleccionLetras = array("letra" => , "descubierta" => false);
    $coleccionLetras = array();
    for($i=0; $i<strlen($palabra); $i++){
        $coleccionLetras[$i]["letra"] = $palabra[$i];
        $coleccionLetras[$i]["descubierta"] = false;
    }
    return($coleccionLetras);
}

/**
* muestra y obtiene una opcion de menú ***válida***
* @return int
*/
function seleccionarOpcion(){
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Jugar con una palabra aleatoria"; 
    echo "\n ( 2 ) Jugar con una palabra elegida";
    echo "\n ( 3 ) Agregar una palabra al listado";
    echo "\n ( 4 ) Mostrar la información completa de un número de juego";
    echo "\n ( 5 ) Mostrar la información completa del primer juego con más puntaje";
    echo "\n ( 6 ) Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario";
    echo "\n ( 7 ) Mostrar la lista de palabras ordenada por orden alfabetico";
    echo "\n ( 8 ) Salir del juego";
    
    echo "\n Ingresar una opcion: ";
    $opcion = trim(fgets(STDIN));
    $esOpcion = ($opcion>0 && $opcion<9);
    while(!$esOpcion){
        echo "Esa opcion no existe ingrese otra \n";
        echo "Ingresar una opcion: ";
        $opcion = trim(fgets(STDIN));
        $esOpcion = ($opcion>0 && $opcion<9);
    }
    echo "--------------------------------------------------------------\n";
    return $opcion;
}

/**
* Determina si una palabra existe en el arreglo de palabras
* @param array $coleccionPalabras
* @param string $palabra
* @return boolean
*/
function existePalabra($coleccionPalabras,$palabra){
    $i=0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while($i<$cantPal && !$existe){
        $existe = $coleccionPalabras[$i]["palabra"] == $palabra;
        $i++;
    }
    
    return $existe;
}


/**
* Determina si una letra existe en el arreglo de letras
* @param array $coleccionLetras
* @param string $letra
* @return boolean
*/
function existeLetra($coleccionLetras, $letra){
    $contPalabras = count($coleccionLetras);
    $existeLetra = false;
    $i=0;
    do{
        if($coleccionLetras[$i]["letra"] == $letra){
            $existeLetra = true;
        }
        $i++;
    }while($i<$contPalabras);
    return($existeLetra);
}

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/
/*>>> Completar la interfaz y cuerpo de la función. Debe respetar la documentación <<<*/


/**
* Obtener indice aleatorio
* /*>>> Completar documentacion <<<*/

function indiceAleatorioEntre($min,$max){
    $i = rand($min,$max); // /*>>> documente qué hace la función rand según el manual php.net en internet <<<*/
    return $i;
}

/**
* solicitar un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max){ 
    do{
        echo "Seleccione un valor entre $min y $max: ";
        $i = trim(fgets(STDIN));
    }while(!($i>=$min && $i<=$max));
    
    return $i;
}

/**
* Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
* @param array $coleccionLetras
* @return boolean
*/
function palabraDescubierta($coleccionLetras){
    $cantidadLetras = count($coleccionLetras);
    $descubierta = true;
    for ($i=0; $i<$cantidadLetras; $i++){
        if($coleccionLetras[$i]["descubierta"] == false){
            $descubierta = false;
        }
    }
    return($descubierta);
}

/**
* /*>>> Completar documentacion <<<*/
function solicitarLetra(){
    $letraCorrecta = false;
    do{
        echo "Ingrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if(strlen($letra)!=1){
            echo "Debe ingresar 1 letra!\n";
        }else{
            $letraCorrecta = true;
        }
    }while(!$letraCorrecta);
    
    return $letra;
}

/**
* Descubre todas las letras de la colección de letras iguales a la letra ingresada.
* Devuelve la coleccionLetras modificada, con las letras descubiertas
* @param array $coleccionLetras
* @param string $letra
* @return array colección de letras modificada.
*/
function destaparLetra($coleccionLetras, $letra){
    
    $cantidadLetras = count($coleccionLetras);
   
    for ($i=0; $i<$cantidadLetras; $i++){
        if($coleccionLetras[$i]["letra"] == $letra){
            $coleccionLetras[$i]["descubierta"] = true;
        }
    }
    
    return $coleccionLetras;
}
/**
* obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas. Ejemplo: he**t*t*s
* @param array $coleccionLetras
* @return string  Ejemplo: "he**t*t*s"
*/
function stringLetrasDescubiertas($coleccionLetras){
    $pal = "";
    $cantidadLetras = count($coleccionLetras);
   
    for ($i=0; $i<$cantidadLetras; $i++){
        $letrita = $coleccionLetras[$i]["letra"];

        if($coleccionLetras[$i]["descubierta"] == false){
            $letrita = "*";
            $pal = $pal . $letrita;
        } else {
            $pal = $pal . $letrita;
        }
    }
    
    return $pal;
}


/**
* Desarrolla el juego y retorna el puntaje obtenido
* Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
* Si no descubre la palabra el puntaje es 0.
* @param array $coleccionPalabras
* @param int $indicePalabra
* @param int $cantIntentos
* @return int puntaje obtenido
*/
function jugar($coleccionPalabras, $indicePalabra, $cantIntentos){
    $pal = $coleccionPalabras[$indicePalabra]["palabra"]; //trae la palabra elegida por el usuario en forma de string
    $coleccionLetras = dividirPalabraEnLetras($pal); //hace el llamado a la funcion dividirPalabraEnLetras() en la que divide el string en un array de letras
    
    $puntaje = 0;
    $intentosRealizados = 0;
    $auxIntentos = $cantIntentos;

    echo "Pista: " . $coleccionPalabras[$indicePalabra]["pista"] . "\n";

    $palabraFueDescubierta = false;

    while(($intentosRealizados<$cantIntentos) && ($palabraFueDescubierta == false)){

        $letra = solicitarLetra();
        $existe = existeLetra($coleccionLetras, $letra);

        if($existe){
            echo "La letra '" . $letra . "' PERTENECE a la palabra." . "\n";
            $coleccionLetras = destaparLetra($coleccionLetras, $letra);
            $palabraADescubrir = stringLetrasDescubiertas($coleccionLetras);
            echo "Palabra a descubrir: " . $palabraADescubrir . "\n";
        }else{
            echo "La letra no existe" . "\n";
            $intentosRealizados++;
            $auxIntentos--;
            echo "La letra '" . $letra . "' NO pertenece a la palabra. ";
            echo "Intentos restantes: " . $auxIntentos . "\n";
            $coleccionLetras = destaparLetra($coleccionLetras, $letra);
            $palabraADescubrir = stringLetrasDescubiertas($coleccionLetras);
        }
        $palabraFueDescubierta = palabraDescubierta($coleccionLetras);
    }
    
    if($palabraFueDescubierta){
        //obtener puntaje:
        $puntaje = $coleccionPalabras[$indicePalabra]["puntosPalabra"] + $auxIntentos;
        echo "\n¡¡¡¡¡¡GANASTE ".$puntaje." puntos!!!!!!\n";
    }else{
        echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";
    }
    
    return $puntaje;
}

/**
* Agrega un nuevo juego al arreglo de juegos
* @param array $coleccionJuegos
* @param int $puntos
* @param int $indicePalabra
* @return array coleccion de juegos modificada
*/
function agregarJuego($coleccionJuegos,$puntos,$indicePalabra){
    $coleccionJuegos[] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);    
    return $coleccionJuegos;
}

/**
* Muestra los datos completos de un registro en la colección de palabras
* @param array $coleccionPalabras
* @param int $indicePalabra
*/
function mostrarPalabra($coleccionPalabras,$indicePalabra){
    //$coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
    
    /*>>> Completar el cuerpo de la función, respetando lo indicado en la documentacion <<<*/
    echo "Pista: " . $coleccionPalabras[$indicePalabra]["pista"] . "\n";
    echo "--------------------------------------------------------------\n";
}


/**
* Muestra los datos completos de un juego
* @param array $coleccionJuegos
* @param array $coleccionPalabras
* @param int $indiceJuego
*/
function mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego){
    //array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego ".$indiceJuego." >->->\n";
    echo "  Puntos ganados: ".$coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo "  Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}


/*>>> Implementar las funciones necesarias para la opcion 5 del menú <<<*/

/*>>> Implementar las funciones necesarias para la opcion 6 del menú <<<*/

/*>>> Implementar las funciones necesarias para la opcion 7 del menú <<<*/




/******************************************/
/************** PROGRAMA PRINCIAL *********/
/******************************************/
define("CANT_INTENTOS", 6); //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.
$cantInt = 6;
do{
    $opcion = seleccionarOpcion();
    switch ($opcion) {
    case 1: //Jugar con una palabra aleatoria
        
        break;
    case 2: //Jugar con una palabra elegida
        $colePalabras = cargarPalabras();
        $cantPalabras = count($colePalabras) - 1;
        $indiceElegido = solicitarIndiceEntre(0, $cantPalabras);
        // mostrarPalabra($colePalabras, $indiceElegido);

        jugar($colePalabras, $indiceElegido, $cantInt);
        break;
    case 3: //Agregar una palabra al listado

        break;
    case 4: //Mostrar la información completa de un número de juego

        break;
    case 5: //Mostrar la información completa del primer juego con más puntaje

        break;
    case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario

        break;
    case 7: //Mostrar la lista de palabras ordenada por orden alfabetico

        break;
    }
}while($opcion != 8);

