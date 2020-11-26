<?php
/******************************************
* Cristhian Cantero / Braian Centurion - FAI-3073 / FAI-3001
* https://github.com/CristhianCantero/TPFinal2020_Cantero_Centurion
* https://github.com/BraianCenturion2001/TPFinal2020_Cantero_Centurion.git
******************************************/

/**
* Genera un arreglo de palabras para jugar
* @return array
*/
function cargarPalabras(){
    // array $coleccionPalabras
    $coleccionPalabras = array();
    $coleccionPalabras[0]= array("palabra"=> "perro" , "pista" => "animal doméstico", "puntosPalabra"=>5);
    $coleccionPalabras[1]= array("palabra"=> "tomate" , "pista" => "fruta de color rojo", "puntosPalabra"=> 6);
    $coleccionPalabras[2]= array("palabra"=> "electroencefalografista" , "pista" => "persona especializada en electroencefalografía", "puntosPalabra"=> 23);
    $coleccionPalabras[3]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=> 4);
    $coleccionPalabras[4]= array("palabra"=> "higado" , "pista" => "órgano triangular", "puntosPalabra"=> 6);
 
  return $coleccionPalabras; 
}

/**
* Genera un arreglo de los juegos ya realizados
* @return array
*/
function cargarJuegos(){
    // array $coleccionJuegos
	$coleccionJuegos = array();
    $coleccionJuegos[0] = array("puntos"=> 5, "indicePalabra" => 3);
    $coleccionJuegos[1] = array("puntos"=> 0, "indicePalabra" => 4);//no descubrio la palabra
    $coleccionJuegos[2] = array("puntos"=> 0, "indicePalabra" => 0);//no descubrio la palabra
    $coleccionJuegos[3] = array("puntos"=> 8, "indicePalabra" => 1);
    $coleccionJuegos[4] = array("puntos"=> 25, "indicePalabra" => 2);

    return $coleccionJuegos;
}

/**
* A partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
* @param string $palabra
* @return array
*/
function dividirPalabraEnLetras($palabra){    
    // $coleccionLetras = array("letra" => , "descubierta" => false);
    // int $i
    // array $coleccionLetras
    $coleccionLetras = array();
    for($i=0; $i<strlen($palabra); $i++){
        $coleccionLetras[$i]["letra"] = $palabra[$i];
        $coleccionLetras[$i]["descubierta"] = false;
    }
    return($coleccionLetras);
}

/**
* Muestra y obtiene una opcion de menú ***válida***
* @return int
*/
function seleccionarOpcion(){
    // int $opcion
    // boolean $esOpcion
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
    // int $i, $cantPal
    // boolean $existe
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
    // int $contPalabras, $i
    // boolean $existeLetra
    $contPalabras = count($coleccionLetras);
    $existeLetra = false;
    $i=0;
    do{
        if($coleccionLetras[$i]["letra"] == $letra){
            $existeLetra = true;
        }
        $i++;
    }while(($i<$contPalabras) && (!$existeLetra));
    return($existeLetra);
}

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/
function agregarPalabras($coleccionPalabras){

    do{
        echo "Ingrese una palabra: ";
        $palabraSolicitada = strtolower(trim(fgets(STDIN)));

        $existePalabra = existePalabra($coleccionPalabras, $palabraSolicitada);
        $indiceUltimaPalabra = count($coleccionPalabras);
        if($existePalabra){
            echo "La palabra ya existe en el listado." . "\n";
            echo "Ingrese otra palabra." . "\n";
        }else{
            $coleccionPalabras[$indiceUltimaPalabra]["palabra"] = $palabraSolicitada;
            echo "Ingrese pista: ";
            $pistaPalabra = strtolower(trim(fgets(STDIN)));
            $coleccionPalabras[$indiceUltimaPalabra]["pista"] = $pistaPalabra;
            echo "Ingrese puntos: ";
            $puntajePalabra = trim(fgets(STDIN));
            $coleccionPalabras[$indiceUltimaPalabra]["puntosPalabra"] = $puntajePalabra;
        }
    }while($existePalabra);

    return($coleccionPalabras);
}

/**
 * Obtener indice aleatorio
 * @param int $min
 * @param int $max
 * @return int
*/
function indiceAleatorioEntre($min,$max){
    // int $i
    $i = rand($min,$max); //Segun el manual de php la funcion 'rand' va a devoler un entero pseudoaleatorio entre los valor min y max que hayamos establecido
    return $i;
}

/**
* solicitar un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max){
    // int $i
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
    // int $cantidadLetras, $i
    // boolean $descubierta
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
 * Solicitar una letra para adivinar la palabra
 * @return string
*/
function solicitarLetra(){
    // boolean $letraCorrecta
    // string $letra
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
    // int $cantidadLetras
    // array $coleccionLetras
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
    // string $pal, $letrita
    // int $cantidadLetras, $i
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
    // string $pal, $letra, $palabraADescubrir
    // array $coleccionLetras
    // int $puntaje, $intentosRealizados, $auxIntentos
    // boolean $palabraFueDescubierta, $existe
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
        echo " +-----+ " . "\n";
        echo " |     O" . "\n";
        echo " |    /|\ " . "\n";
        echo " |    / \ " . "\n";
        echo " |" . "\n";
        echo " |" . "\n";
        echo "---" . "\n";
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
    // array $coleccionJuegos
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
    echo "  Palabra: " . $coleccionPalabras[$indicePalabra]["palabra"] . "\n";
    echo "  Pista: " . $coleccionPalabras[$indicePalabra]["pista"] . "\n";
    echo "  Puntos palabra: " . $coleccionPalabras[$indicePalabra]["puntosPalabra"] . "\n";
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
    echo "Puntos ganados: ".$coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo "Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}

function encontrarMayorPuntaje($coleccionJuegos){
    $valoralto = 0; //Variable que almacenará el mayor puntaje
    $indicealto = 0; //Variable que almacenará el índice del mayor puntaje dentro del arreglo de juegos
    $cantJuegos = count($coleccionJuegos) - 1; //La cantidad de puntajes que hay dentro del arreglo
    for ($i = 0; $i <= $cantJuegos; $i++){
    if ($coleccionJuegos[$i]["puntos"] > $valoralto){
        $valoralto = $coleccionJuegos[$i]["puntos"];
        $indicealto = $i;
    }
    }

    return $indicealto;
}

/**
 * Busca el primer juego con un mayor puntaje al ingresado por el usuario
 * @param array $coleccionJuegos
 * @param int $puntajeABuscar
 * @return int
*/
function encontrarJuegoPuntaje($coleccionJuegos, $puntajeABuscar){
    // int $cantJuegos, $i, $indice
    // boolean $juegoMayorEncontrado
    $cantJuegos = count($coleccionJuegos);
    $juegoMayorEncontrado = false;
    $i = 0;
    do{
        if($coleccionJuegos[$i]["puntos"] > $puntajeABuscar){
            $indice = $i;
            $juegoMayorEncontrado = true;
        }
        $i++;
    }while(($i<$cantJuegos) && ($juegoMayorEncontrado == false));
    if(!$juegoMayorEncontrado){
        $indice = -1;
    }
    return($indice);
}

/**
 * Ordenar la coleccion de palabras alfabeticamente
 * @param array $colePalabras
*/
function mostrarListaOrdenada($colePalabras){
    // int $opcion
    echo "Elegir ordenar alfabeticamente de la A-Z (1) o Z-A (2): ";
    $opcion = trim(fgets(STDIN));
    if($opcion == 1){
        asort($colePalabras);
        echo "Palabras ordenadas alfabeticamente de la A-Z: " . "\n";
    }elseif($opcion == 2){
        arsort($colePalabras);
        echo "Palabras ordenadas alfabeticamente de la Z-A: " . "\n";
    }
    echo "Forma bonita: ";
    foreach ($colePalabras as $palabra) {
        echo "\n";
        echo "  Palabra: " . $palabra["palabra"] . "\n";
        echo "  Pista: " . $palabra["pista"] . "\n";
        echo "  Puntos palabra: " . $palabra["puntosPalabra"] . "\n";
    }
    echo "Forma con funcion print_r: " . "\n";
    print_r($colePalabras); //La función print_r se encarga de mostrar toda la información dentro de una variable, en este caso imprimirá todos los valores dentro del arreglo
}

/******************************************/
/************** PROGRAMA PRINCIAL *********/
/******************************************/
define("CANT_INTENTOS", 6); //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.
$cantInt = 6;
$coleJuegos = cargarJuegos(); //Trae el array de la coleccionJuegos
$colePalabras = cargarPalabras(); //Trae el array de la coleccionPalabras
do{
    $opcion = seleccionarOpcion(); //Solicita una opcion valida al usuario para jugar
    switch ($opcion) {
        case 1: //Jugar con una palabra aleatoria
            $cantPalabras = count($colePalabras) - 1; //Obtenemos la cantidad de palabras en el arreglo
            $indiceAleatorio = indiceAleatorioEntre(0, $cantPalabras); //Obtenemos un índice aleatorio entre 0 y la cantidad de palabras en el arreglo
            $puntajeObtenido = jugar($colePalabras, $indiceAleatorio, $cantInt); //Jugas y guarda el puntaje
            $coleJuegos = agregarJuego($coleJuegos,$puntajeObtenido,$indiceAleatorio); //Agregas el puntaje obtenido en el juego al array coleccionJuegos
        break;
        case 2: //Jugar con una palabra elegida
            $cantPalabras = count($colePalabras) - 1;
            $indiceElegido = solicitarIndiceEntre(0, $cantPalabras); //Solicita un indice al usuario entre 0 y $cantPalabras
            $puntajeObtenido = jugar($colePalabras, $indiceElegido, $cantInt); ////Jugas y guarda el puntaje
            $coleJuegos = agregarJuego($coleJuegos,$puntajeObtenido,$indiceElegido); //Agregas el puntaje obtenido en el juego al array coleccionJuegos
        break;
        case 3: //Agregar una palabra al listado
            $colePalabras = agregarPalabras($colePalabras);
        break;
        case 4: //Mostrar la información completa de un número de juego
            $cantJuegos = count($coleJuegos) - 1;
            $indiceElegidoJuego = solicitarIndiceEntre(0, $cantJuegos); //Solicitar indice para mostrar un juego en especifico
            mostrarJuego($coleJuegos, $colePalabras, $indiceElegidoJuego); //Mostrar juego indicado por el usuario
        break;
        case 5: //Mostrar la información completa del primer juego con más puntaje
            $indicealto = encontrarMayorPuntaje($coleJuegos);
            mostrarJuego($coleJuegos, $colePalabras, $indicealto); //Llamamos a la función para mostrar el juego con mayor puntaje
        break;
        case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
            echo "Ingrese puntaje para encontrar el primer juego que supere dicho puntaje: ";
            $puntajeUsuario = trim(fgets(STDIN)); //Puntaje base para buscar el juego

            $indiceEncontrado = encontrarJuegoPuntaje($coleJuegos, $puntajeUsuario); //Buscar el indice del juego con un puntaje mayor al indicado por el usuario
            if($indiceEncontrado <> -1){ //Si el indice encontrado es distinto que -1 se muestra el juego sino se le señala al usuario que no hay un juego con un puntaje mayor al indicado
                mostrarJuego($coleJuegos, $colePalabras, $indiceEncontrado);
            }else{
                echo "No hay ningun juego que supere al puntaje ingresado" . "\n";
            }
        break;
        case 7: //Mostrar la lista de palabras ordenada por orden alfabetico
            mostrarListaOrdenada($colePalabras); //Llamado a la funcion que va a mostrar la lista de palabras ordenadas por orden alfabetico
            break;
        }
}while($opcion != 8);

/**
 * La función switch cumple una condición parecida al if.
 * Asi sería con un if
 * if ($i == 0) {
 *    echo "i es igual a 0";
 * } elseif ($i == 1) {
 *    echo "i es igual a 1";
 * } elseif ($i == 2) {
 *    echo "i es igual a 2";
 * }
 * 
 * Y asi sería lo mismo pero haciendo uso de la funcion switch
 *switch ($i) {
 *    case 0:
 *        echo "i es igual a 0";
 *        break;
 *    case 1:
 *        echo "i es igual a 1";
 *        break;
 *    case 2:
 *        echo "i es igual a 2";
 *        break;
 *}
 */