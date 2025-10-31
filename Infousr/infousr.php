<?php
include '../conexionbd.php';
include '../lang.php';
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
    <title><?php echo t('title_profile'); ?></title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

      <link rel="stylesheet" href="infousr.css">
</head>
<body>
 <div class="header-section text-center text-white py-3">
    <div class="logo-container mb-2">
      <img src="../imagenes-inicio/logo.png" alt="Logo" style="height: 80px;">
    </div>

    <!-- Navbar horizontal -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces y perfil -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav d-flex flex-row align-items-center gap-3">
            <li class="nav-item">
              <a class="nav-link text-white" href="../inicio1.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Inicio</a>
            </li>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../serviciospendientes/spendientes.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Servicios pendientes</a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../solservicio/servicios.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Servicios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../misautos/misautos.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Mis autos</a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../aautos/aautos.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Agregar vehículo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../insumos/insumos.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Insumos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../allusr/usuarios.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Usuarios</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link text-white" href="../addservicios/svadd.php">Agregar servicios</a>
              </li>
            <?php endif; ?>

            <!-- Dropdown de perfil -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                <?php if (!isset($_SESSION['email'])): ?>
                  <a class="dropdown-item" href="../login/registro.php">Iniciar sesión</a>
                <?php else: ?>
                     <a class="dropdown-item" href="../Infousr/infousr.php<?php echo isset($_GET['lang']) ? '?lang=' . $_GET['lang'] : ''; ?>">Mi perfil</a>
                    <hr class="dropdown-divider">
                  <form action="../inicio2.php" method="post" class="d-inline">
                    <input type="hidden" name="cerrar" value="1">
                    <button class="dropdown-item" type="submit">Cerrar sesión</button>
                  </form>
                <?php endif; ?>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

    <form action="procesar-act.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                <h2><?php echo t('update_user'); ?></h2>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php
                        if ($_GET['error'] == 1) echo t('error_updating_user');
                        if ($_GET['error'] == 2) echo t('missing_required_data');
                        if ($_GET['error'] == 3) echo t('email_already_registered');
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo t('user_updated_successfully'); ?>
                    </div>
                <?php endif; ?>

                <label for="nombre"><?php echo t('name'); ?></label>
                <input type="text" class="form-control" id="nombre" placeholder="Diego" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

                <label for="apellido"><?php echo t('last_name'); ?></label>
                <input type="text" class="form-control" id="apellido" placeholder="Peña" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>

                <label for="email"><?php echo t('email'); ?></label>
                <input type="email" class="form-control" id="email" placeholder="ejemplo@gmail.com" name="email" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>

                <label for="telefono"><?php echo t('phone'); ?></label>
                <input type="tel" class="form-control" id="telefono" placeholder="012495115" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required>

                <label for="contraseña"><?php echo t('password'); ?></label>
                <input type="password" class="form-control" id="contraseña" placeholder="Nueva contraseña" name="contraseña" >

              
                <?php
                if($_SESSION['perfil']=='cliente'){
                    $selcliente="SELECT * FROM clientes WHERE correo='$_SESSION[email]'";
                    $rescliente=$con->query($selcliente);
                    if($rescliente->num_rows>0){
                        $dataCliente = $rescliente->fetch_assoc(); // Obtener los datos como array asociativo
                ?>
                        <label for="direccion"><?php echo t('address'); ?></label>
                        <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion"
                               value="<?php echo isset($dataCliente['direccion']) ? htmlspecialchars($dataCliente['direccion']) : ''; ?>">
                               <label for="nacimiento"><?php echo t('birth_date'); ?></label>
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento"
                               value="<?php echo isset($dataCliente['fecha_nacimiento']) ? htmlspecialchars($dataCliente['fecha_nacimiento']) : ''; ?>">
                <?php
                    }
                }elseif($_SESSION['perfil']=='centro'){
                    $selcentro="SELECT * FROM centros WHERE correo='$_SESSION[email]'";
                    $rescentro=$con->query($selcentro);
                    if($rescentro->num_rows>0){
                        $dataCentro = $rescentro->fetch_assoc(); // Obtener los datos como array asociativo
                ?>
                        <label for="n_centro"><?php echo t('center_name'); ?></label>
                        <input type="text" class="form-control" id="n_centro" placeholder="Nombre del centro" name="n_centro"
                               value="<?php echo isset($dataCentro['nom_centro']) ? htmlspecialchars($dataCentro['nom_centro']) : ''; ?>">
                        <label for="ubicacion_c"><?php echo t('center_location'); ?></label>
                        <input type="text" class="form-control" id="ubicacion_c" placeholder="Ubicacion del centro" name="ubicacion_c"
                               value="<?php echo isset($dataCentro['ubicacion']) ? htmlspecialchars($dataCentro['ubicacion']) : ''; ?>">
                <?php
                    }
                }
                ?>
                <br>
                <button type="submit" class="btn btn-primary"><?php echo t('update'); ?></button>
            </div>
        </div>
    </form>
      <footer class="bg-dark text-white text-center py-3 mt-4">
          <p><?php echo t('footer_copyright'); ?></p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
