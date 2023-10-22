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

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$blockchain = $_SESSION['blockchain'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Copiar Mensaje al Portapapeles desde un Input</title>
    <!-- Agrega el enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Bienvenido, <?php echo $_SESSION['username']; ?>!</h2>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="menu.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="minar.php">Minar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="verRegistro.php">Detalle Transacciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
        </li>
    </ul>
</div>

<div class="container mt-5">
    <h1 class="text-center">Copiar Mensaje al Portapapeles desde un Input</h1>

    <?php
    // Mensaje que deseas copiar al portapapeles
    $mensaje = "Este es el mensaje que quiero copiar.";
    ?>

    <!-- Utiliza las clases de Bootstrap para mejorar el diseño -->
    <div class="input-group mb-3">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Transacción</th>
                <th scope="col">Hash</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($blockchain->getChain() as $block) {
                    if($block->index!=0){
                        echo "<tr><td>".$block->data."</td><td>".$block->hash."</td> </tr>";
                    }
                }
            ?>

            </tbody>
        </table>

</div>

<!-- Agrega los archivos JavaScript de Bootstrap al final del documento -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
