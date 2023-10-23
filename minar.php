<?php
    // Incluye las clases
    include "Block.php";
    include "Blockchain.php";

    // Inicia la sesión o reanuda la sesión existente
    session_start();


    // Crea una instancia de la cadena de bloques si no existe en la sesión
    if (!isset($_SESSION['blockchain'])) {
        $_SESSION['blockchain'] = new Blockchain();
    }

    if (!isset($_SESSION['Coin'])) {
        $_SESSION['Coin']=0.0;
    }
    if (!isset($_SESSION['Money'])) {
        $_SESSION['Money']=0.0;
    }

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

$blockchain = $_SESSION['blockchain'];
$money = 0.0;

$difficulty=0;

// Función para agregar un bloque de muestra y obtener la cadena
function mostrar_variable() {
    global $blockchain,$difficulty,$money;
    $data = "Transacción " . random_int(0, 99999)." El usuario: ".$_SESSION['username']." Ha obtenido: $".$_SESSION['Money']." QPAZACoins";
    $ind = random_int(0, 99999);
    $blockchain->addBlock(new Block($ind, date("Y-m-d H:i:s"), $data));
    $difficulty = $blockchain->getdifficulty();
    dineroGanado();
    // Verifica la validez de la cadena
    $chainValid = $blockchain->isChainValid();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'mostrar_variable') {
    list($chainHtml, $chainValid) = mostrar_variable();
    $_SESSION['blockchain'] = $blockchain; // Actualiza la sesión con la cadena de bloques modificada
    $_SESSION['Coin'] = $_SESSION['Coin'] + $money;
    $_SESSION['Money'] = $money;
    echo '<script>alert("Se ha ganado: $ ' . $_SESSION['Money'] . ' QPAZACoins");</script>';
}

function dineroGanado(){
    global $difficulty,$money;
    $val = random_int(0,3);

    //echo "difficulty: $difficulty<br>";
    //echo "val: $val<br>";

    if($difficulty === 3){
        if ($val === 0  || $val ===2){
            $money =  $money + 0.001;
        }
        if ($val === 1  || $val ===3){
            $money =  $money + 0.0013;
        }
    }
    if($difficulty === 4){
        if ($val === 0){
            $money = $money + 0.0015;
        }
        if ($val === 2){
            $money = $money + 0.0017;
        }
        if ($val === 1  || $val ===3){
            $money = $money + 0.0019;
        }
    }

    if($difficulty === 5){
        if ($val === 0){
            $money = $money + 0.0020;
        }
        if ($val === 1){
            $money = $money + 0.0022;
        }
        if ($val === 2){
            $money = $money + 0.0023;
        }
        if ($val === 3){
            $money = $money + 0.0025;
        }
    }
    //echo "money: $money<br>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Index.php con bootstrap</title>
    <!-- Incluye bootstrap desde un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>
    <ul class="nav bg-dark">
        <li class="nav-item">
            <a class="nav-link text-white" href="menu.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="minar.php">Minar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="verRegistro.php">Detalle Transacciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
        </li>
    </ul>
</div>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center">
            <div class="my-5">
                <h1>Es hora de trabajar!</h1>
                <!-- Crea un formulario para llamar a la función mostrar_variable() -->
                <form method="post">
                    <input type="hidden" name="action" value="mostrar_variable">
                    <button type="submit" class="btn btn-warning">Minar!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Incluye jQuery y bootstrap desde un CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
