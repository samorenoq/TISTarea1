<?php

include 'db_connection.php';
    $errores = ['nombre'=>'','apellido'=>''];

    //Revisar que haya habido un submit
    if (isset($_POST['submit']))
    {   
        //Revisar que los campos no estén vacíos
        if (empty($_POST['nombre']))
        {
            $errores['nombre'] = "Nombre no puede estar vacío";
        }

        if (empty($_POST['apellido']))
        {
            $errores['apellido'] = "Apellido no puede estar vacío";
        }

        //Redirigir a home si no hay errores
        if (!array_filter($errores))
        {
            $nombres = mysqli_real_escape_string($conn, $_POST['nombre']);
            $apellidos = mysqli_real_escape_string($conn, $_POST['apellido']);

            $query = "INSERT INTO persona(nombres, apellidos) VALUES('$nombres', '$apellidos')";

            //Guardar a DB
            if (!mysqli_query($conn, $query))
            {
                echo 'Query error: ' . mysqli_error($conn);
            }

            header('Location: index.php');
        }
    }

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
    <form action="index.php" method="POST">
        <label for="">Nombres:</label>
        <input type="text" name="nombre" value="">
        <div class="red-text"><?php echo htmlspecialchars($errores['nombre']) ?></div>

        <br>
        
        <label for="">Apellidos:</label>
        <input type="text" name="apellido" value="">
        <div class="red-text"><?php echo htmlspecialchars($errores['apellido']) ?></div>

        <br>

        <div class="center">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <br>

    <h4>Nombres registrados</h4>
    <ul>
        <?php foreach ($nombres_apellidos as $x): ?>
            <li><?php echo htmlspecialchars($x) ?></li>
        <?php endforeach; ?>
    </ul>
    
</body>
</html>