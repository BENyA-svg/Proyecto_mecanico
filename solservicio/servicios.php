<?php
include ('../conexionbd.php');
include ('../lang.php');
session_start();
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('title_servicios'); ?></title>

     <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="servicios.css">
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
                <a class="nav-link text-white" href="../aautos/aautos.php">Agregar vehículo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../insumos/insumos.php">Insumos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../allusr/usuarios.php">Usuarios</a>
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
    
    <form action="#" method="post" >
        <div class="container mt-5">
            <div class="form-container">


                                <label for="auto"><?php echo t('auto_label'); ?></label>
                                <input class="form-control" list="autos" id="auto" name="auto" placeholder="<?php echo t('selecciona_auto'); ?>" />
                                <datalist id="autos">
                                    <?php
                                    $selectauto = "SELECT marca, modelo, año FROM auto  where correo='" . $_SESSION['email'] . "' AND estado_g= 'activo' ;";
                                    $result = $con->query($selectauto);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['marca'] . ' ' . $row['modelo'] . ' ' . $row['año'] . '"></option>';
                                    }
                                    ?>
                                </datalist>    
                             

                <label for="fecha"><?php echo t('fecha_preferida'); ?></label>
                <input type="date" class="form-control" name="fecha" id="fecha">
                 <label for="myservice"><?php echo t('service_label'); ?></label>
                        <input class="form-control" list="servicios" id="myservice" name="myservice" placeholder="<?php echo t('selecciona_servicio'); ?>" />
                        <datalist id="servicios">
                        <?php
                            $selectservice = "SELECT * FROM servicios";
                        $result = $con->query($selectservice);
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['nombre'] .'"></option>';
                                    }
                                    ?>
                                </datalist>
                <br>
                <label for="centro"><?php echo t('centro_label'); ?></label>
                <input class="form-control" list="centros" id="centro" name="centro" placeholder="<?php echo t('selecciona_centro'); ?>" />
                <datalist id="centros">
                    <?php
                    $selectcentro = "SELECT DISTINCT nom_centro FROM centros 
                                     WHERE nom_centro IS NOT NULL AND TRIM(nom_centro) <> ''
                                     ORDER BY nom_centro";
                    $result = $con->query($selectcentro);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['nom_centro'] .'"></option>';
                    }
                    ?>
                </datalist>
                <br>
                <button type="submit" name="solicitar" class="btn btn-primary"><?php echo t('solicitar_button'); ?></button>
                <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['solicitar'])) {
                $auto = "Select n_chasis from auto where concat(marca, ' ', modelo, ' ', año) = '".$_POST['auto']."'";
                $result = $con->query($auto);
                $row = $result->fetch_assoc();
                $fecha = $_POST['fecha'];
                $service ="Select id_service from servicios where nombre = '".$_POST['myservice']."'";
                $result = $con->query($service);
                $rowService = $result->fetch_assoc();
                $insertService = "INSERT INTO reciben (n_chasis, fecha, id_service, estado) VALUES ('".$row['n_chasis']."', '$fecha', '".$rowService['id_service']."', '1')";
                if ($con->query($insertService) === TRUE) {
                    echo "<p class='text-success'>" . t('servicio_solicitado_exito') . "</p>";
                    $correo_elec = "Select correo from centros where nom_centro = '".$_POST['centro']."'";
                    $result = $con->query($correo_elec);
                    $rowCorreo = $result->fetch_assoc();
                    $insertrealizan = "INSERT INTO realizan (n_chasis, id_service, correo_elec) VALUES ('".$row['n_chasis']."', '".$rowService['id_service']."', '".$rowCorreo['correo']."')";
                    if ($con->query($insertrealizan) === TRUE) {
                        echo "<p class='text-success'>" . t('centro_asignado_exito') . "</p>";
                    } else {
                        echo "<p class='text-danger'>" . t('error_asignar_centro') . " " . $con->error . "</p>";
                    }
                } else {
                    echo "<p class='text-danger'>" . t('error_solicitar_servicio') . " " . $con->error . "</p>";
                }

            }
            ?>
            </div>
        </div>
    </form>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
  <footer class="bg-dark text-white text-center py-3 mt-4">
          <p><?php echo t('footer_copyright'); ?></p>
        </footer>

    </body>
    </html>
