<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "concesionario";

// Conexión a la base de datos
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $color = $_POST['color'];

    // Escapar los valores para prevenir inyección SQL
    $placa = mysqli_real_escape_string($enlace, $placa);
    $modelo = mysqli_real_escape_string($enlace, $modelo);
    $marca = mysqli_real_escape_string($enlace, $marca);
    $color = mysqli_real_escape_string($enlace, $color);

    // Preparar la consulta SQL
    $sql = "INSERT INTO autos (placa, modelo, marca, color) VALUES ('$placa', '$modelo', '$marca', '$color')";

    // Ejecutar la consulta y verificar
    if (mysqli_query($enlace, $sql)) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . mysqli_error($enlace);
    }
}

// Cerrar conexión
mysqli_close($enlace);
?>
