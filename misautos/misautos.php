<?php
include ('../conexionbd.php');
include ('../lang.php');
session_start();

// Procesar la actualización de la matrícula si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_matricula'])) {
    if (isset($_POST['n_chasis']) && isset($_POST['matricula'])) {
        $n_chasis = $con->real_escape_string($_POST['n_chasis']);
        $matricula = $con->real_escape_string($_POST['matricula']);

        // Preparamos y ejecutamos la consulta para actualizar la matrícula
        $update_sql = "UPDATE auto SET matricula = '$matricula' WHERE n_chasis = '$n_chasis' AND correo = '" . $_SESSION['email'] . "'";

        if ($con->query($update_sql)) {
            // Opcional: puedes mostrar un mensaje de éxito
            $mensaje_exito = "Matrícula actualizada correctamente.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('title_mis_autos'); ?></title>

      <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vehiculos.css?v=1.1"> 
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
              <a class="nav-link text-white" href="../inicio1.php?lang=<?php echo $lang; ?>"><?php echo t('nav_inicio'); ?></a>
            </li>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../serviciospendientes/spendientes.php?lang=<?php echo $lang; ?>"><?php echo t('nav_servicios_pendientes'); ?></a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../solservicio/servicios.php?lang=<?php echo $lang; ?>"><?php echo t('nav_servicios'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../misautos/misautos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_mis_autos'); ?></a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../aautos/aautos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_agregar_vehiculo'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../insumos/insumos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_insumos'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../allusr/usuarios.php?lang=<?php echo $lang; ?>"><?php echo t('nav_usuarios'); ?></a>
              </li>
              <li class="nav-item">
                 <a class="nav-link text-white" href="../addservicios/svadd.php?lang=<?php echo $lang; ?>"><?php echo t('nav_agregar_servicios'); ?></a>
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
                  <a class="dropdown-item" href="../login/registro.php?lang=<?php echo $lang; ?>"><?php echo t('nav_iniciar_sesion'); ?></a>
                <?php else: ?>
                      <a class="dropdown-item" href="../Infousr/infousr.php?lang=<?php echo $lang; ?>"><?php echo t('mi_perfil'); ?></a>
                    <hr class="dropdown-divider">
                  <form action="../inicio2.php" method="post" class="d-inline">
                    <input type="hidden" name="cerrar" value="1">
                    <button class="dropdown-item" type="submit"><?php echo t('nav_cerrar_sesion'); ?></button>
                  </form>
                <?php endif; ?>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
    
    <div class="container mt-5">
        <h3 class="form-title"><?php echo t('mis_vehiculos'); ?></h3>
        <div class="form-container">
          <?php if (isset($_SESSION['email'])): // Comprobar si el usuario SÍ ha iniciado sesión
            
            // Mostrar mensaje de éxito si existe
            if (isset($mensaje_exito)) {
                echo "<div class='alert alert-success'>$mensaje_exito</div>";
            }
 
            $sel = "SELECT * FROM auto WHERE correo='" . $_SESSION['email'] . "';";    
            $res = $con->query($sel);
            if ($res->num_rows > 0) {
                while($fila = $res->fetch_assoc()) {
                    // Determinar la clase CSS basada en el estado de la garantía
                    $garantia_class = ($fila['estado_g'] == 'Activo') ? 'active-warranty' : 'inactive-warranty';
            ?>
            <div class="card mb-3 <?php echo $garantia_class; ?>">
                <div class="card-body d-flex align-items-center">
                    <div class="card-img-container">
                        <?php echo "<td><img src='data:image/jpeg;base64," . base64_encode($fila["imagen"]) . "' class='card-img' alt='Imagen del auto'></td>"; ?>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <?php
                            echo "<h5 class=\"card-title\">" . htmlspecialchars($fila['marca'] . ' ' . $fila['modelo'] . ' ' . $fila['año']) . "</h5>";
                            echo "<p class=\"card-text\">" .
                                ' <br><strong>' . t('numero_chasis') . ':</strong> ' . $fila['n_chasis'].
                                ' <br><strong>' . t('numero_motor') . ':</strong>' . $fila['n_motor'] .
                                ' <br><strong>' . t('estado_garantia') . ':</strong>' . $fila['estado_g'] .
                                ' <br><strong>' . t('fecha_compra') . ':</strong>' . $fila['fecha_compra'] . "</p>";
                        ?>
                        <form action="misautos.php?lang=<?php echo $lang; ?>" method="post" class="d-flex align-items-center gap-2 mt-2">
                            <input type="hidden" name="n_chasis" value="<?php echo htmlspecialchars($fila['n_chasis']); ?>">
                            <label for="matricula-<?php echo htmlspecialchars($fila['n_chasis']); ?>" class="form-label mb-0"><strong><?php echo t('matricula'); ?>:</strong></label>
                            <input type="text" class="form-control" id="matricula-<?php echo htmlspecialchars($fila['n_chasis']); ?>" name="matricula" value="<?php echo htmlspecialchars($fila['matricula']); ?>" style="width: 150px;">
                            <button type="submit" name="actualizar_matricula" class="btn btn-primary btn-sm">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>" . t('no_vehiculos') . "</p>";
            }
          endif; ?>
        </div>
    </div>

  <footer class="bg-dark text-white text-center py-3 mt-4">
          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
