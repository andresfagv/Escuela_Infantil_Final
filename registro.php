<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['registro'])) {
        // Obtener los datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol']; // Nuevo campo para el rol

        // Generar un salt aleatorio
        $password_salt = bin2hex(random_bytes(16)); // Salt de 16 bytes en hexadecimal

        // Combinar el salt con la contraseña y hacer el hashing
        $password_hash = hash('sha256', $password . $password_salt);

        // Guardar el usuario en la base de datos
        #$servername = "localhost";
        #$username = "root";
        #$password = "adm1n";
        #$database = "escuela_infantil";

        $servername = "fdb1029.awardspace.net";
        $username = "4496204_mjfei";
        $password = "mjf12345.";
        $database = "4496204_mjfei";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar el usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO users (email, password_hash, password_salt, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $password_hash, $password_salt, $rol);
        $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $conn->close();

        echo "Usuario registrado exitosamente.";
    }elseif (isset($_POST['getpass'])) {
        // Establecer la conexión a la base de datos
        #$servername = "localhost";
        #$username = "root";
        #$password = "adm1n";
        #$dbname = "escuela_infantil";

        $servername = "fdb1029.awardspace.net";
        $username = "4496204_mjfei";
        $password = "mjf12345.";
        $database = "4496204_mjfei";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Obtener el salt y el hash de la contraseña asociados con el email
        $stmt = $conn->prepare("SELECT password_hash, password_salt FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($password_hash, $password_salt);
        $stmt->fetch();
    
        // Verificar si se encontró el email en la base de datos
        if ($password_hash && $password_salt) {
            // Generar el hash de la contraseña proporcionada
            $hashed_password = hash('sha256', $password . $password_salt);
    
            // Verificar si el hash generado coincide con el hash almacenado
            if ($hashed_password === $password_hash) {
                // La contraseña es correcta, iniciar sesión
                echo "Inicio de sesión exitoso";
                // Aquí redirige al usuario a su página de inicio o realiza alguna acción adicional
            } else {
                // La contraseña es incorrecta
                echo "Contraseña incorrecta";
            }
        } else {
            // El email no se encontró en la base de datos
            echo "El correo electrónico no está registrado";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="rol">Rol:</label><br>
        <select id="rol" name="rol" required>
            <option value="admin">Admin</option>
            <option value="educador">Educador</option>
            <option value="padre">Padre</option>
        </select><br><br>
        <input type="submit" value="Registrar" name='registro'>
    </form>


    <hr>
    <hr>


    <h2>Mostrar Contraseña</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar Sesión" name="getpass">
    </form>
</body>
</html>
