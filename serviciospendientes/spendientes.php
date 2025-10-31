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
    <title><?php echo t('title_servicios_pendientes'); ?></title>

     <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="servicependiente.css">
    
    
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
              <a href="?lang=<?php echo $lang == 'es' ? 'en' : 'es'; ?>" class="btn btn-outline-light me-3"><?php echo $lang == 'es' ? 'EN' : 'ES'; ?></a>
            </li>
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
  </div>  <div class="auto-btn-container">
            <a href="#" class="btn-abrir-popup"><i class="fa-solid fa-circle-plus"></i></a>
        </div>
        <div class="overlay" id="overlay">
        <div class="popup" id="popup">
     <form action="" method="post" >
        <div class="container mt-5">
            <div class="form-container">
             
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
             <!-- busca auto a partir de usuario -->
                                <label for="myUsuario"><?php echo t('usuario_label'); ?></label>
                                <input class="form-control" list="usuarios" id="myUsuario" name="myUsuario" placeholder="<?php echo t('selecciona_usuario'); ?>" />
                                <datalist id="usuarios">
                                    <?php
                                    $selectusr = "SELECT correo FROM clientes";
                                    $result = $con->query($selectusr);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['correo'] . '"></option>';
                                    }
                                    ?>
                                </datalist>
                                <input type="submit" value="<?php echo t('buscar_autos'); ?>" class="btn btn-primary mt-2" onclick="fetchAutos(); return false;">
                                </form>
                                
                                <!-- muestra autos del usuario seleccionado -->
                                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['myUsuario'])) { 
                                    echo "<form action='' method='post'>";

                                        $selectauto = "SELECT marca, modelo, año, n_chasis FROM auto where correo='" . $_POST['myUsuario'] . "';";
                                        $result = $con->query($selectauto);
                                ?>
                                <br>
                                <label for="autoUsuario"><?php echo t('auto_label'); ?></label>
                                <select class="form-control" id="autoUsuario" name="autoUsuario">
                                    <option value=""><?php echo t('selecciona_auto'); ?></option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['n_chasis'] . '">' . $row['marca'] . ' ' . $row['modelo'] . ' (' . $row['año'] . ')</option>';
                                    }
                                    ?>
                                </select>
                <label for="fecha"><?php echo t('fecha_preferida'); ?>:</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
                 <label for="myservice"><?php echo t('servicio'); ?>:</label>
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
                <?php
                   echo   "<input type='hidden' name='myUsuario' value='".$_POST['myUsuario']."'>";
                ?>
                <button type="submit" name="solicitar" class="btn btn-primary"><?php echo t('solicitar'); ?></button>
            </div>
        </div>
        <?php } ?>
           <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['solicitar'])) { 
               $usuario = $_POST['myUsuario'];
               $auto = $_POST['autoUsuario'];
               $fecha = $_POST['fecha'];
               $service = $_POST['myservice'];

            $insertar = "INSERT INTO reciben (n_chasis, id_service, fecha, estado) values (
                (SELECT n_chasis FROM auto WHERE n_chasis = '$auto'),
                (SELECT id_service FROM servicios WHERE nombre = '$service'),
                '$fecha',
                '1'
            )";
            $insertrealizan="INSERT INTO realizan (correo_elec, n_chasis, id_service) values ('".$_SESSION['email']."', '$auto', (SELECT id_service FROM servicios WHERE nombre = '$service'))";
            
               if ($con->query($insertar) === TRUE && $con->query($insertrealizan) === TRUE) {
                   echo "<p class='text-success'>" . t('servicio_solicitado_exito') . "</p>";
               } else {
                   echo "<p class='text-danger'>" . t('error_solicitar_servicio') . " " . $con->error . "</p>";
               }
                
           } ?>
    </form>
       </div>
    </div>
    </div>
    </div>
    <div class="container">
        <div class="service">
      
          <?php

   $sel = "SELECT a.*, s.*, r.fecha, r.estado FROM auto a
    JOIN reciben r ON a.n_chasis = r.n_chasis
    JOIN servicios s ON s.id_service = r.id_service
    JOIN realizan re ON re.n_chasis = r.n_chasis AND re.id_service = r.id_service
    WHERE re.correo_elec = '".$_SESSION['email']."'
    ";
    ?>
    <div class="d-flex gap-2 mb-3">
            <form action="" method="post">
                <input type="hidden" name="todo" value="todos">
                <button type="submit" class="btn btn-primary"><?php echo t('mostrar_todos'); ?></button>
            </form><br>
            <form action="" method="post">
                <input type="hidden" name="todo" value="recargar">
                <button type="submit" class="btn btn-primary"><?php echo t('recargar_pagina'); ?></button>
            </form>
          </div>  
        <?php
if (!isset($_POST['todo'])) {
    $sel .= " AND estado REGEXP '^[0-9]+$'";
 
}
if(isset($_POST['todo']) && $_POST['todo'] == 'recargar'){
    echo "<meta http-equiv='refresh' content='0'>";
}
$sel .= " AND estado != 'cancelado' AND estado != 'eliminado'";
$sel .= " ORDER BY fecha ASC";
    $res = $con->query($sel);
    
    if ($res->num_rows > 0) { ?>
      <div class="container py-5">
        <h2 class="text-center mb-4"><?php echo t('servicios_pendientes'); ?></h2>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col"><?php echo t('table_auto'); ?></th>
                <th scope="col"><?php echo t('table_fecha'); ?></th>
                <th scope="col"><?php echo t('table_estado'); ?></th>
                <th scope="col"><?php echo t('table_descripcion'); ?></th>
                <th scope="col"><?php echo t('table_chasis'); ?></th>
                <th scope="col"><?php echo t('table_costo'); ?></th>
                <th scope="col"><?php echo t('table_acciones'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php while($fila = $res->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo htmlspecialchars($fila["marca"] . " " . $fila["modelo"] . " " . $fila["año"]); ?></td>
                  <td><?php echo htmlspecialchars($fila["fecha"]); ?></td>
                  <td><?php echo htmlspecialchars($fila["estado"]); ?></td>
                  <td><?php echo htmlspecialchars($fila["descripcion"]); ?></td>
                  <td><?php echo htmlspecialchars($fila["n_chasis"]); ?></td>
                  <td>$<?php echo htmlspecialchars($fila["costos"]); ?></td>
                  <td>
  
 <form method="post" style="display:inline;">
    <input type="hidden" name="accion" value="eliminar">
    <input type="hidden" name="n_chasis" value="<?php echo $fila['n_chasis']; ?>">
    <input type="hidden" name="id_service" value="<?php echo $fila['id_service']; ?>">
    <input type="hidden" name="fecha" value="<?php echo $fila['fecha']; ?>">
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> <?php echo t('eliminar'); ?>
    </button>
</form>
                   <form method="post" style="display:inline;">
        <input type="hidden" name="accion" value="cancelar">
            <input type="hidden" name="n_chasis" value="<?php echo $fila['n_chasis']; ?>">
    <input type="hidden" name="id_service" value="<?php echo $fila['id_service']; ?>">
    <input type="hidden" name="fecha" value="<?php echo $fila['fecha']; ?>">
        <button type="submit" class="btn btn-warning btn-sm">
            <i class="fa-solid fa-xmark"></i> <?php echo t('cancelar'); ?>
        </button>
    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
   
    <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    $n_chasis = $_POST['n_chasis'];
        $id_service = $_POST['id_service'];
        $fecha = $_POST['fecha'];

    if ($_POST['accion'] == 'eliminar') {
     $n_chasis = $_POST['n_chasis'];
        $id_service = $_POST['id_service'];
        $fecha = $_POST['fecha'];
       $eliminar = "UPDATE reciben 
             SET estado = 'eliminado' 
             WHERE n_chasis = '$n_chasis' 
               AND id_service = '$id_service' 
               AND fecha = '$fecha';";
       if ($con->query($eliminar) === TRUE) {
           echo "<p class='text-success'>" . t('servicio_eliminado_exito') . "</p>";
       } else {
           echo "<p class='text-danger'>" . t('error_eliminar_servicio') . " " . $con->error . "</p>";
       }
  }elseif ($_POST['accion'] == 'cancelar') {
       $n_chasis = $_POST['n_chasis'];
       $id_service = $_POST['id_service'];
        $fecha = $_POST['fecha'];
       $cancelar = "UPDATE reciben 
             SET estado = 'cancelado' 
             WHERE n_chasis = '$n_chasis' 
               AND id_service = '$id_service' 
               AND fecha = '$fecha';";
               $cambiarmembresia= "UPDATE auto SET estado_g = 'inactivo' WHERE n_chasis = '$n_chasis'";
       if ($con->query($cancelar) === TRUE && $con->query($cambiarmembresia) === TRUE) {
           echo "<p class='text-success'>" . t('servicio_cancelado_exito') . "</p>";
       } else {
           echo "<p class='text-danger'>" . t('error_cancelar_servicio') . " " . $con->error . "</p>";
       }
   }

}
  ?>
           <!-- Modal para mostrar información del service -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel"><?php echo t('detalles_del_servicio'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'expandir') {
            $n_chasis = $_POST['n_chasis'];
            $id_service = $_POST['id_service'];
            $fecha = $_POST['fecha'];
            
            $query = "SELECT 
    a.*, 
    s.nombre AS nombre_service,
    s.*, 
    r.fecha, 
    r.estado, 
    u.nombre, 
    u.apellido,
    e.id_etapa,
    e.nombre AS nombre_etapa
FROM auto a
JOIN reciben r ON a.n_chasis = r.n_chasis
JOIN servicios s ON s.id_service = r.id_service
JOIN usuario u ON a.correo = u.correo
JOIN tienen_etapa_service tes ON s.id_service = tes.id_service
JOIN etapa e ON tes.id_etapa = e.id_etapa
WHERE a.n_chasis = '$n_chasis'
AND s.id_service = '$id_service'
AND r.fecha = '$fecha'
AND e.orden = r.estado;
   ";
            
            $result = $con->query($query);
            
            if ($row = $result->fetch_assoc()) {
                echo "<p><strong>Cliente:</strong> " . htmlspecialchars($row['nombre'] . " " . $row['apellido']) . "</p>";
                echo "<p><strong>Vehículo:</strong> " . htmlspecialchars($row['marca'] . " " . $row['modelo'] . " (" . $row['año'] . ")") . "</p>";
                echo "<p><strong>Número de Chasis:</strong> " . htmlspecialchars($row['n_chasis']) . "</p>";
                echo "<p><strong>Servicio:</strong> " . htmlspecialchars($row['nombre_service']) . "</p>";
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($row['descripcion']) . "</p>";
                echo "<p><strong>Fecha programada:</strong> " . htmlspecialchars($row['fecha']) . "</p>";
                echo "<p><strong>Estado:</strong> " . htmlspecialchars($row['estado']) . "</p>";
                echo "<p><strong>Costo:</strong> $" . htmlspecialchars($row['costos']) . "</p>";
                echo "<h5>Etapas e Insumos:</h5>";
                echo "<ul>";
                $selinsumos = "SELECT i.*, n.cantidad
FROM insumos i
JOIN necesitan n ON n.id_insumo = i.id_insumos
JOIN etapa e ON e.id_etapa = n.id_etapa
WHERE e.id_etapa = ".$row['id_etapa'].";"
;
                $resinsumos = $con->query($selinsumos);
                if ($resinsumos->num_rows > 0) {
                    echo "<h6>" . htmlspecialchars($row['nombre_etapa']) . "</h6>";
                     while ($rowinsumos = $resinsumos->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($rowinsumos['tipo']) . " - Cantidad: " . htmlspecialchars($rowinsumos['cantidad']) . "</li>";
                }
                }else{
                  echo "esta etapa no requiere insumos";
                }
                echo "</ul>";
            }
            
        }
        ?>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          <input type="hidden" name="accion" value="avanzar_etapa">
          <input type="hidden" name="n_chasis" value="<?php echo $n_chasis; ?>">
          <input type="hidden" name="id_service" value="<?php echo $id_service; ?>">
          <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
          <button type="submit" class="btn btn-primary">Avanzar etapa</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo t('cerrar'); ?></button>
      </div>
    </div>
  </div>
</div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'avanzar_etapa'){
    $n_chasis = $_POST['n_chasis'];
    $id_service = $_POST['id_service'];
    $fecha = $_POST['fecha'];

    $con->begin_transaction();
    try {

        $etapaactual = "SELECT estado FROM reciben WHERE n_chasis = '$n_chasis' AND id_service = '$id_service' AND fecha = '$fecha'";
        $resetapa = $con->query($etapaactual);

        if ($row = $resetapa->fetch_assoc()) {
            $estado_actual = $row['estado'];
            $nuevaetapa = $estado_actual + 1;
  

            // Obtener el id_etapa actual
            $current_etapa_query = "SELECT e.id_etapa FROM etapa e
                                    JOIN tienen_etapa_service tes ON e.id_etapa = tes.id_etapa
                                    WHERE tes.id_service = '$id_service' AND e.orden = '$estado_actual'";
            $current_etapa_result = $con->query($current_etapa_query);

            if ($current_etapa_row = $current_etapa_result->fetch_assoc()) {
                $current_id_etapa = $current_etapa_row['id_etapa'];

                // Restar insumos
                $restarinsumos = "SELECT i.*, n.cantidad
                                  FROM insumos i
                                  JOIN necesitan n ON n.id_insumo = i.id_insumos
                                  WHERE n.id_etapa = '$current_id_etapa'";
                $resinsumos = $con->query($restarinsumos);

                while ($ins = $resinsumos->fetch_assoc()) {
                    $id_insumo = $ins['id_insumos'];
                    $cantidad_actual = $ins['cantidad_pedida'];
                    $cantidad_a_restar = $ins['cantidad'];

                    // Calcular la nueva cantidad pedida
                    $nueva_cantidad = $cantidad_actual - $cantidad_a_restar;

                    // Evitar que quede negativa
                    if ($nueva_cantidad < 0) {
                        throw new Exception("No hay suficiente stock del insumo ID $id_insumo (faltan " . abs($nueva_cantidad) . ").");
                    }

                    // Actualizar ese insumo puntual
                    $actualizainsumos = "UPDATE insumos SET cantidad_pedida = '$nueva_cantidad' WHERE id_insumos = '$id_insumo'";

                    if (!$con->query($actualizainsumos)) {
                        throw new Exception("Error actualizando insumo ID $id_insumo: " . $con->error);
                    }
                }
            } else {
                throw new Exception("No se encontró la etapa actual para el servicio.");
            }

            // Actualizar etapa
            $actualizaetapa = "UPDATE reciben SET estado = '$nuevaetapa' WHERE n_chasis = '$n_chasis' AND id_service = '$id_service' AND fecha = '$fecha'";
            if (!$con->query($actualizaetapa)) {
                throw new Exception("Error avanzando etapa: " . $con->error);
            }

            // Verificar si hay más etapas
            $verificaetapa = "SELECT e.orden FROM etapa e
                              JOIN tienen_etapa_service tes ON e.id_etapa = tes.id_etapa
                              WHERE tes.id_service = '$id_service' AND e.orden = '$nuevaetapa'";
            $reseetapa = $con->query($verificaetapa);

            if ($reseetapa->num_rows == 0) {
                $finaliza = "UPDATE reciben SET estado = 'completado' WHERE n_chasis = '$n_chasis' AND id_service = '$id_service' AND fecha = '$fecha'";
                if (!$con->query($finaliza)) {
                    throw new Exception("Error finalizando servicio: " . $con->error);
                }
                echo "<p class='text-success'>" . t('servicio_completado_exito') . "</p>";
            } else {
                echo "<p class='text-success'>" . t('etapa_avanzada_exito') . "</p>";
            }
        } else {
            throw new Exception("No se encontró registro en 'reciben' para el chasis $n_chasis.");
        }

        // ✅ Confirmar cambios si todo fue bien
        $con->commit();
    } catch (Exception $e) {
        // ❌ Revertir todos los cambios si hay algún error
        $con->rollback();
        echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
    }
}
?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="popup.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if(isset($_POST['accion']) && $_POST['accion'] == 'expandir'): ?>
        var modal = new bootstrap.Modal(document.getElementById('serviceModal'));
        modal.show();
    <?php endif; ?>
});
</script>

    </div>
    </div>

 <footer class="bg-dark text-white text-center py-3 mt-4">

          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>
    </body>
    </html>