<?php
include 'conexionbd.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['ci'])) {
    header("Location: login/registro.php");
    exit();
}

// Obtener datos actuales del usuario
$ci = $_SESSION['ci'];
$sql = "SELECT * FROM usuario WHERE ci = '$ci'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario - JuancitoMotores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="inicio.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="inicio1.php" class="text-white">Inicio</a> |
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>
                <a href="solservicio/servicios.php" class="text-white">Servicios</a> |
                <a href="misautos/misautos.php" class="text-white">Mis autos</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>
                <a href="aautos/aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos/insumos.php" class="text-white">Insumos</a> |
                <a href="allusr/usuarios.php" class="text-white">Usuarios</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>
                <a href="serviciospendientes/spendientes.php" class="text-white">Servicios pendientes</a>
            <?php endif; ?>
        </nav>
    </div>

    <form action="procesar_actualizacion.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php
                        if ($_GET['error'] == 1) echo "Error al actualizar usuario. Intenta nuevamente.";
                        if ($_GET['error'] == 2) echo "Faltan datos obligatorios.";
                        if ($_GET['error'] == 3) echo "El correo ya está registrado por otro usuario.";
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        Usuario actualizado exitosamente.
                    </div>
                <?php endif; ?>

                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Diego" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" placeholder="Peña" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>

                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="ejemplo@gmail.com" name="email" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" placeholder="012495115" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>

                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" placeholder="Nueva contraseña" name="contraseña" required>

                <br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</body>
</html>
