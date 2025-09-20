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

// Si el formulario fue enviado por método POST (actualizar usuario)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id']; // Obtener el ID del usuario
    $nombre = $conn->real_escape_string($_POST['nombre']); // Escapar caracteres especiales
    $email = $conn->real_escape_string($_POST['email']);
    $edad = (int) $_POST['edad'];

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', edad=$edad WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Si la actualización fue exitosa
        echo "Registro actualizado.<br>";
        echo "<a href='mostrar_datos.php'>Volver a la lista</a>";
    } else {
        // Si hubo error al actualizar
        echo "Error al actualizar: " . $conn->error;
    }
} else {
    // Si la página se carga por primera vez (GET), obtener los datos del usuario
    $id = (int) $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <h1>Editar Usuario</h1>
    <!-- Formulario para editar usuario, los valores actuales se muestran en los campos -->
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        Edad: <input type="number" name="edad" value="<?php echo $row['edad']; ?>" required><br><br>
        <button type="submit">Actualizar</button>
    </form>
    <?php
}
// Cerrar la conexión a la base de datos
$conn->close();
?>