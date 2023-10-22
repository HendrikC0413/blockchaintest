<?php


    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
    }

    if (!isset($_SESSION['Coin'])) {
        $_SESSION['Coin']=0.0;
    }

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <div class="my-5">
                    <h3>Tus QPAZACoins son de:</h3>
                    <p><?php echo $_SESSION['Coin']; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
