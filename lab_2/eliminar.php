<?php
<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";

// Crear conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario a eliminar desde la URL y convertirlo a entero
$id = (int) $_GET['id'];

// Consulta SQL para eliminar el usuario con el ID recibido
$sql = "DELETE FROM usuarios WHERE id=$id";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    // Si la eliminación fue exitosa, mostrar mensaje y enlace de regreso
    echo "Registro eliminado.<br>";
    echo "<a href='mostrar_datos.php'>Volver a la lista</a>";
} else {
    // Si hubo error al eliminar, mostrar mensaje de error
    echo "Error al eliminar: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>