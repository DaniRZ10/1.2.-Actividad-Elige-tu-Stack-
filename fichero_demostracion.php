<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Demostración PHP - Arquitecturas Web</title>
</head>
<body>
    <h1>Demostración de generación dinámica con PHP</h1>
    <p>Esta página se genera de nuevo en el servidor cada vez que se recarga, a diferencia de un HTML estático.</p>

    <?php
        $fechaActual = date('d/m/Y');
        $horaActual = date('H:i:s');
    ?>

    <p>Fecha actual del servidor: <?php echo htmlspecialchars($fechaActual); ?></p>
    <p>Hora actual del servidor: <?php echo htmlspecialchars($horaActual); ?></p>
</body>
</html>