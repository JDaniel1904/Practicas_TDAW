<?php
<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";

// Crear conexión con la base de datos usando MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT id, nombre, email, edad FROM usuarios";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar título y encabezado de la tabla
    echo "<h1>Usuarios Registrados</h1>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th></tr>";

    // Recorrer cada fila de resultados y mostrar los datos
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["edad"] . "</td>";
        // Enlaces para editar y eliminar el usuario
        echo "<td>
                <a href='editar.php?id=" . $row["id"] . "'>✏️ Editar</a> | 
                <a href='eliminar.php?id=" . $row["id"] . "' onclick=\"return confirm('¿Seguro que quieres eliminar este registro?')\">🗑 Eliminar</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Si no hay usuarios registrados
    echo "No hay usuarios registrados.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>