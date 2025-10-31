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
    <title><?php echo t('title_add_services'); ?></title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="svadd.css">

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
                    <button class="dropdown-item" type="submit"><?php echo t('cerrar_sesion'); ?></button>
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
        <div class="auto-btn-container">
            <a href="#" class="btn-añadir-auto"><i class="fa-solid fa-circle-plus"></i></a>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2><?php echo t('service_information'); ?></h2>
                <div class="container mt-4">
                    <h4><?php echo t('add_service'); ?></h4>
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="nombre"><?php echo t('service_name'); ?></label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>

                        <div class="mb-2">
                            <label for="requisitos"><?php echo t('requirements'); ?></label>
                            <textarea class="form-control" name="requisitos" id="requisitos" rows="3" required></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="descripcion"><?php echo t('description'); ?></label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="4" required></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="costos"><?php echo t('costs'); ?></label>
                            <input type="number" class="form-control" name="costos" id="costos" step="0.01" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-success"><?php echo t('add_service_button'); ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup para Agregar Etapa -->
        <div class="overlay" id="overlay-etapa">
            <div class="popup" id="popup-etapa">
                <a href="#" id="btn-cerrar-popup-etapa" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2><?php echo t('add_stage'); ?></h2>
                <div class="container mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="id_servicio" id="id_servicio_etapa">
                        <div class="mb-2">
                            <label for="nombre_etapa"><?php echo t('stage_name'); ?></label>
                            <input type="text" class="form-control" name="nombre_etapa" id="nombre_etapa" required>
                        </div>
                        <div class="mb-2">
                            <label for="duracion"><?php echo t('duration'); ?></label>
                            <input type="text" class="form-control" name="duracion" id="duracion" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo t('add_stage_button'); ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup para Agregar Insumo -->
        <div class="overlay" id="overlay-insumo">
            <div class="popup" id="popup-insumo">
                <a href="#" id="btn-cerrar-popup-insumo" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2><?php echo t('add_supply'); ?></h2>
                <div class="container mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="id_servicio" id="id_servicio_insumo">
                        <div class="mb-2">
                            <?php 
                            $selinsumo="SELECT tipo, id_insumos FROM insumos;";
                            $seletapa="SELECT nombre_etapa AS nombre_etapa, id_etapa FROM etapa;";
                            ?>
                            <label for="nombre_insumo"><?php echo t('supply_name'); ?></label>
                              <input class="form-control" list="insumos_list" id="nombre_insumo" name="nombre_insumo" placeholder="<?php echo t('selecciona_insumo'); ?>" />
                                <datalist id="insumos_list">
                            <?php
                            $resi = $con->query($selinsumo);
                            if ($resi->num_rows > 0) {
                            while($filai = $resi->fetch_assoc()) {
                           echo "<option value='" . $filai["tipo"] . "'>";
                            }
}   
                             ?>
                          </datalist>
                        </div>
                       <div class="mb-2">
                            <label for="nombre_e"><?php echo t('stage_name'); ?></label>
                              <input class="form-control" list="etapas_list" id="nombre_e" name="nombre_e" placeholder="<?php echo t('selecciona_etapa'); ?>" />
                                <datalist id="etapas_list">
                                </datalist>
                        </div>
                        <div class="mb-2">
                            <label for="cantidad"><?php echo t('quantity'); ?></label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo t('add_supply_button'); ?></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup para Expandir Servicio -->
        <div class="overlay" id="overlay-expandir">
            <div class="popup" id="popup-expandir">
                <a href="#" id="btn-cerrar-popup-expandir" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2><?php echo t('service_details'); ?></h2>
                <input type="hidden" name="id_servicio_expandir" id="id_servicio_expandir">
                <div id="etapas-container" class="container mt-4"></div>
                <div id="insumos-container" class="container mt-2"></div>
            </div>
        </div>


            <br>
     <?php  
    $sel = "SELECT * FROM servicios";    
    
$res = $con->query($sel);
if ($res->num_rows > 0) { ?>
    <div class="container py-5">
        <h2 class="text-center mb-4"><?php echo t('registered_services'); ?></h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th><?php echo t('name'); ?></th>
                        <th><?php echo t('requirements'); ?></th>
                        <th><?php echo t('description'); ?></th>
                        <th><?php echo t('costs'); ?></th>
                        <th><?php echo t('actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = $res->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["requisitos"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["descripcion"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["costos"]); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm me-2 btn-agregar-etapa" data-id="<?php echo $fila['id_service']; ?>"><?php echo t('add_stage_button'); ?></button>
                                <button type="button" class="btn btn-secondary btn-sm btn-agregar-insumo" data-id="<?php echo $fila['id_service']; ?>"><?php echo t('add_supply_button'); ?></button>
                                <button type="button" class="btn btn-info btn-sm btn-expandir" data-id="<?php echo $fila['id_service']; ?>"><?php echo t('expandir'); ?></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } else {
    echo "<p class='text-center'>" . t('no_resultados') . "</p>";
} ?>
            </div>
        </div>
                <?php
// Procesamiento del formulario de "Agregar Servicio"
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $requisitos = $_POST['requisitos'];
        $descripcion = $_POST['descripcion'];
        $costos = $_POST['costos'];
        $id_servicio = random_int(1, 10000);
        // Validación mínima
        if (empty($nombre) || empty($requisitos) || empty($descripcion) || empty($costos)) {
            echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios correctamente.</div>';
        } else {
            $sql = "INSERT INTO servicios (nombre, requisitos, descripcion, costos, id_service) VALUES ('$nombre', '$requisitos', '$descripcion', '$costos', '$id_servicio')";
            $res = $con->query($sql);
            if ($res == TRUE) {
                echo '<div class="alert alert-success">' . t('service_added_successfully') . '</div>';
            } else {
                echo '<div class="alert alert-danger">' . t('error_adding_service') . ' ' . $con->error . '</div>';
            }
        }
    } elseif (isset($_POST['nombre_etapa'])) {
        $id_etapa = random_int(1, 10000);
        $nombre_etapa = $_POST['nombre_etapa'];
        $duracion_etapa = $_POST['duracion'];
        $etapa_num="SELECT COUNT(*) AS etapa_num from tienen_etapa_service WHERE id_service='".$_POST['id_servicio']."';";
        $result = $con->query($etapa_num);
        if ($result && $row = $result->fetch_assoc()) {
            $etapanueva = $row['etapa_num'] + 1;
        } else {
            $etapanueva = 1;
        }
        // Validación
        if (empty($nombre_etapa) || empty($duracion_etapa)) {
            echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios para la etapa.</div>';
        } else {
            $con->begin_transaction();
            try {
                $con->query("INSERT INTO etapa (id_etapa, nombre, orden, duracion) VALUES ('$id_etapa', '$nombre_etapa', ".$etapanueva.", '$duracion_etapa')");
                $con->query("INSERT INTO tienen_etapa_service (id_service, id_etapa) VALUES ('".$_POST['id_servicio']."', '$id_etapa')");
                $con->commit();
                echo t('stage_added_successfully');
            } catch (Exception $e) {
                // Si hay algún error, revertimos todo
                $con->rollback();
                echo t('error_adding_stage') . ' ' . $e->getMessage();
            }
        }
    } elseif (isset($_POST['nombre_insumo'])) {
        $id_servicio = $_POST['id_servicio'];
        $nombre_insumo = $_POST['nombre_insumo'];
        $cantidad = $_POST['cantidad'];
        $nombre_etapa = $_POST['nombre_e'];
        // Validación
        if (empty($nombre_insumo) || empty($cantidad) || empty($nombre_etapa)) {
            echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios para el insumo.</div>';
        } else {
            $sql = "INSERT INTO necesitan (id_insumo, id_etapa, cantidad) VALUES ((select id_insumos from insumos where tipo = '$nombre_insumo'), (SELECT e.id_etapa
FROM etapa e
JOIN tienen_etapa_service tes ON e.id_etapa = tes.id_etapa
WHERE e.nombre = '$nombre_etapa'
  AND tes.id_service = '$id_servicio'), $cantidad);";
            $res = $con->query($sql);
            if ($res == TRUE) {
                echo '<div class="alert alert-success">' . t('supply_added_successfully') . '</div>';
            } else {
                echo '<div class="alert alert-danger">' . t('error_adding_supply') . ' ' . $con->error . '</div>';
            }
        }
    }
}
?>



    <br>         
              
            </form>

        </div>
    </div>
    <br>
       <footer class="bg-dark text-white text-center py-3 mt-4">
         
          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>
        

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var translations = {
            'etapa_label': '<?php echo t('etapa_label'); ?>',
            'insumo_label': '<?php echo t('insumo_label'); ?>',
            'cantidad_label': '<?php echo t('cantidad_label'); ?>',
            'no_etapas': '<?php echo t('no_etapas'); ?>',
            'no_insumos': '<?php echo t('no_insumos'); ?>',
            'service_details': '<?php echo t('service_details'); ?>',
            'stages_of_service': '<?php echo t('stages_of_service'); ?>',
            'supplies_per_stage': '<?php echo t('supplies_per_stage'); ?>'
        };
    </script>
    <script src="popup.js"></script>
</body>
</html>

<?php
