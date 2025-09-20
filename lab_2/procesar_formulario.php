<?php
<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";

// Crear la conexión usando MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    // Si hay error, mostrar mensaje y detener ejecución
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario y evitar inyección SQL
$nombre = $conn->real_escape_string($_POST['nombre']); // Escapa caracteres especiales
$email = $conn->real_escape_string($_POST['email']);
$edad = (int) $_POST['edad']; // Convierte la edad a entero

// Validaciones de los datos recibidos
if (empty($nombre) || empty($email) || empty($edad)) {
    // Si algún campo está vacío, mostrar mensaje y detener ejecución
    die("Todos los campos son obligatorios. <br><a href='formulario.html'>Volver</a>");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Si el email no es válido, mostrar mensaje y detener ejecución
    die("El correo no es válido. <br><a href='formulario.html'>Volver</a>");
}

if ($edad <= 0) {
    // Si la edad no es positiva, mostrar mensaje y detener ejecución
    die("La edad debe ser un número positivo. <br><a href='formulario.html'>Volver</a>");
}

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('$nombre', '$email', $edad)";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    // Si el registro fue exitoso, mostrar enlaces de navegación
    echo "Registro exitoso.<br>";
    echo "<a href='formulario.html'>Registrar otro usuario</a><br>";
    echo "<a href='mostrar_datos.php'>Ver usuarios registrados</a>";
} else {
    // Si hubo error al insertar, mostrar mensaje de error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>