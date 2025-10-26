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
  <footer class="bg-dark text-white text-center py-3 mt-4">
           <h2 class="h2">¡Vení a visitarnos!</h2>
           <h1 class="h1">Y salí manejando tu auto como nuevo</h1><br><br>
           <p class="contacto">Contactanos </p>
           <div class="d-flex justify-content-between align-items-center flex-wrap px-3">
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/sobre.png"></div>
               <p class="logo-footer p">wolfcrewcontact@gmail.com</p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/telefono.png"></div>
               <p class="logo-footer p">+598 099 456 220</p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/pinubicacion.png"></div>
               <p class="logo-footer p">Con.José Pedro Varela 2737</p>
             </div>
           </div>

           <div class="map-container">
<iframe src="https://www.google.com/maps/d/u/1/embed?mid=1_SIFaqqS37wGh6hIDiAiaXgrsSMJnGA&ehbc=2E312F" width="640" height="480"></iframe>
          </div>
          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
