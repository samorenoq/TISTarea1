<?php 

    include 'db_connection.php';

    //Obtener datos de la BD
    $query = 'SELECT * FROM persona ORDER BY apellidos';
    $resultado = mysqli_query($conn, $query);
    $personas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    $nombres_apellidos = [];

    foreach($personas as $persona)
    {
        $nombres_apellidos[] = $persona['nombres'] . ' ' .  $persona['apellidos'];
    }

    mysqli_free_result($resultado);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 1</title>
</head>
<body>

    <h2>Tarea 1 - Tópicos Especiales en Ingeniería de Software</h4>
    
    <a href="agregar.php">Agregar nombre</a>

    <h4>Nombres registrados</h4>
    <ul>
        <?php foreach ($nombres_apellidos as $x): ?>
            <li><?php echo htmlspecialchars($x) ?></li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>