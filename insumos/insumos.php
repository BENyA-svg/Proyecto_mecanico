<?php
include ('../conexionbd.php');
include ('../lang.php');
session_start();
// Manejo PRG: si se solicita expandir via GET, cargar datos en sesión y redirigir para evitar reenvío al recargar
if (isset($_GET['expandir'])) {
  $id = $con->real_escape_string($_GET['expandir']);
  $resX = $con->query("SELECT * FROM insumos WHERE id_insumos = '$id' LIMIT 1");
  if ($resX && $rowX = $resX->fetch_assoc()) {
    $_SESSION['insumo_edit'] = $rowX;
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('title_supplies'); ?></title>

      <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="insumos.css">
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
                  <a class="dropdown-item" href="../login/registro.php?lang=<?php echo $lang; ?>"><?php echo t('nav_iniciar_sesion'); ?></a>
                <?php else: ?>
                      <a class="dropdown-item" href="../Infousr/infousr.php">Mi perfil</a>
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

    <!-- Formulario para agregar insumo -->
        <div class="insumo-btn-container">
        <a href="#" class="btn-añadir-insumo"><i class="fa-solid fa-circle-plus"></i></a>
    </div>

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2><?php echo t('supply_information'); ?></h2>
            <div class="container mt-4">
        <h4><?php echo t('add_supply'); ?></h4>
        <form method="post" action="" enctype="multipart/form-data">

            <div class="mb-2">
                <label for="precio"><?php echo t('price'); ?>:</label>
                <input type="number" class="form-control" name="precio" required>
            </div>
            <div class="mb-2">
                <label for="tipo"><?php echo t('type'); ?>:</label>
                <input type="text" class="form-control" name="tipo" required>
            </div>

            <div class="mb-2">
                <label for="cantidad"><?php echo t('quantity'); ?>:</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            <div class="mb-2">
                <label for="fecha_pedido"><?php echo t('order_date'); ?>:</label>
                <input type="date" class="form-control" name="fecha_pedido" required>
            </div>
            <div class="mb-2">
                <label for="imagen"><?php echo t('image'); ?>:</label>
          <input type="file" name="foto" id="foto">
            </div>
              <a href="#" id="agregar-servicio" class="agregar-servicio"><i class="fa-solid fa-plus"></i></a>
            <input type="hidden" name="accion" value="agregar">
            <button type="submit" class="btn btn-success"><?php echo t('add_supply_button'); ?></button>
        </form>
                </div>
                </div> 
               
        </div>
    </div>
    <script src="popup.js"></script>
        

<?php
$sel = "SELECT * FROM insumos";

$res = $con->query($sel);
if ($res->num_rows > 0) {
echo '<div class="cards-container">';
    while($fila = $res->fetch_assoc()) {
        echo "<div class=\"border-container\">";
        echo "<div class=\"card\">";
  echo "<img src='data:image/jpeg;base64," . base64_encode($fila["imagen"]) . "' class='card-img img-fluid' alt='Imagen del auto'>";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">".$fila["tipo"]."</h5>";
        echo "<p class=\"card-text\">" . t('price') . ": $".$fila["precio"]."</p>";
        echo "<p class=\"card-text\">" . t('quantity') . ": ".$fila["cantidad_pedida"]."</p>";
  echo "<p class=\"card-text\"></p>";
  // Botón que abre modal para ver/editar insumo (usamos GET + PRG para evitar reenvío al recargar)
  echo '<form method="get" class="d-inline">';
  echo '<input type="hidden" name="expandir" value="' . htmlspecialchars($fila["id_insumos"]) . '">';
  echo '<button type="submit" class="btn btn-primary btn-editar btn-sm">' . t('edit') . '</button>';
  echo '</form>';
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
echo '</div>';
}
?>

<!-- Modal para mostrar detalles del insumo -->
<div class="modal fade" id="insumoModal" tabindex="-1" aria-labelledby="insumoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insumoModalLabel"><?php echo t('supply_details'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
    <?php
    // Mostrar formulario de edición si hay datos cargados en sesión (PRG)
    $showModal = false;
    if (isset($_SESSION['insumo_edit'])) {
      $row = $_SESSION['insumo_edit'];
      $showModal = true;
      // limpia la sesión para que al recargar no vuelva a aparecer
      unset($_SESSION['insumo_edit']);
      // Formulario para editar
      ?>
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="accion" value="actualizar">
          <input type="hidden" name="id_insumos" value="<?php echo htmlspecialchars($row['id_insumos']); ?>">
          <div class="mb-2">
            <label for="tipo_edit"><?php echo t('type'); ?>:</label>
            <input type="text" class="form-control" id="tipo_edit" name="tipo" value="<?php echo htmlspecialchars($row['tipo']); ?>" required>
          </div>
          <div class="mb-2">
            <label for="precio_edit"><?php echo t('price'); ?>:</label>
            <input type="number" step="0.01" class="form-control" id="precio_edit" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
          </div>
          <div class="mb-2">
            <label for="cantidad_actual"><?php echo t('current_quantity'); ?>:</label>
            <input type="number" class="form-control" id="cantidad_actual" name="cantidad_actual" value="<?php echo htmlspecialchars($row['cantidad_pedida']); ?>" readonly>
          </div>
          <div class="mb-2">
            <label for="agregar_cantidad"><?php echo t('add_quantity'); ?>:</label>
            <input type="number" class="form-control" id="agregar_cantidad" name="agregar_cantidad" value="0" min="0">
          </div>
          <div class="mb-2">
            <label for="fecha_edit"><?php echo t('order_date'); ?>:</label>
            <input type="date" class="form-control" id="fecha_edit" name="fecha_pedido" value="<?php echo htmlspecialchars($row['fecha_pedido']); ?>" required>
          </div>
          <div class="mb-2">
            <label for="imagen_edit"><?php echo t('image'); ?> (<?php echo t('leave_empty'); ?>):</label>
            <input type="file" class="form-control" id="imagen_edit" name="foto">
          </div>
          <div class="mb-2">
            <label for="correo_of_edit"><?php echo t('offered_by'); ?>:</label>
            <input type="email" class="form-control" id="correo_of_edit" name="correo_of" value="<?php echo htmlspecialchars($row['correo_of'] ?? ''); ?>">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success"><?php echo t('save_changes'); ?></button>
          </div>
        </form>
        <?php
      } else {
        echo "<p>Detalles no disponibles.</p>";
      }
    
    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo t('close'); ?></button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  <?php if(isset($showModal) && $showModal): ?>
    var modal = new bootstrap.Modal(document.getElementById('insumoModal'));
    modal.show();
  <?php endif; ?>
});
</script>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $numeroSeguro = random_int(1, 100);
      $imagen = $_FILES['foto']['name'];
   $imgData = file_get_contents($_FILES['foto']['tmp_name']);
    $imgData = $con->real_escape_string($imgData);
    $sql = "INSERT INTO insumos (id_insumos, precio, tipo, correo_of, cantidad_pedida, fecha_pedido, imagen) 
    VALUES ('$numeroSeguro', '$precio', '$tipo', '".$_SESSION['email']."', '$cantidad', '$fecha_pedido', '$imgData')";
    if ($con->query($sql) === TRUE) {
        echo '<div class="alert alert-success">' . t('supply_added_successfully') . '</div>';
        echo '<script>window.location = window.location.pathname;</script>';
        exit();
    } else {
        echo '<div class="alert alert-danger">' . t('error_adding_supply') . ' ' . $con->error . '</div>';
    }
}
  }
  
// Procesar actualización de insumo desde el modal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
  $id_insumo = $con->real_escape_string($_POST['id_insumos']);
  $tipo = $con->real_escape_string($_POST['tipo']);
  $precio = $con->real_escape_string($_POST['precio']);
  // Se calcula la nueva cantidad sumando la existente y la cantidad a agregar
  $agregar = isset($_POST['agregar_cantidad']) ? intval($_POST['agregar_cantidad']) : 0;
  // Obtener cantidad actual desde la base
  $res_q = $con->query("SELECT cantidad_pedida FROM insumos WHERE id_insumos = '$id_insumo' LIMIT 1");
  $current_qty = 0;
  if ($res_q && $rq = $res_q->fetch_assoc()) {
    $current_qty = intval($rq['cantidad_pedida']);
  }
  $new_qty = $current_qty + $agregar;
  $fecha_pedido = $con->real_escape_string($_POST['fecha_pedido']);
  $correo_of = isset($_POST['correo_of']) ? $con->real_escape_string($_POST['correo_of']) : null;

  $update_fields = [];
  $update_fields[] = "tipo = '$tipo'";
  $update_fields[] = "precio = '$precio'";
  $update_fields[] = "cantidad_pedida = '$new_qty'";
  $update_fields[] = "fecha_pedido = '$fecha_pedido'";
  if ($correo_of !== null) {
    $update_fields[] = "correo_of = '$correo_of'";
  }

  // Si se subió una nueva imagen, procesarla
  if (isset($_FILES['foto']) && isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name'] != '') {
    $imgData = file_get_contents($_FILES['foto']['tmp_name']);
    $imgData = $con->real_escape_string($imgData);
    $update_fields[] = "imagen = '$imgData'";
  }

  if (!empty($update_fields)) {
    $sql_up = "UPDATE insumos SET " . implode(', ', $update_fields) . " WHERE id_insumos = '$id_insumo'";
    if ($con->query($sql_up) === TRUE) {
      echo "<div class='alert alert-success'>" . t('supply_updated_successfully') . "</div>";
      // Recargar para ver cambios y evitar reenvío del formulario
      echo "<script>setTimeout(function(){ window.location = window.location.pathname; }, 700);</script>";
      exit();
    } else {
      echo "<div class='alert alert-danger'>" . t('error_updating_supply') . " " . $con->error . "</div>";
    }
  }
}
?>

        <footer class="bg-dark text-white text-center py-3 mt-4">
           <h2 class="h2"><?php echo t('footer_visitanos'); ?></h2>
           <h1 class="h1"><?php echo t('footer_auto_nuevo'); ?></h1><br><br>
           <p class="contacto"><?php echo t('footer_contactanos'); ?> </p>
           <div class="d-flex justify-content-between align-items-center flex-wrap px-3">
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="../imagenes-inicio/sobre.png"></div>
               <p class="logo-footer p"><?php echo t('footer_email'); ?></p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="../imagenes-inicio/telefono.png"></div>
               <p class="logo-footer p"><?php echo t('footer_telefono'); ?></p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="../imagenes-inicio/pinubicacion.png"></div>
               <p class="logo-footer p"><?php echo t('footer_direccion'); ?></p>
             </div>
           </div>

           <div class="map-container">
<iframe src="https://www.google.com/maps/d/u/1/embed?mid=1_SIFaqqS37wGh6hIDiAiaXgrsSMJnGA&ehbc=2E312F" width="640" height="480"></iframe>
          </div>
          <p><?php echo t('footer_copyright'); ?></p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
