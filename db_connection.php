<?php 

    $conn = mysqli_connect('localhost', 'tis_user','','tis_tarea1');

    if (!$conn)
    {
        echo "Error de conexión: " . mysqli_connect_error();
    }

?>