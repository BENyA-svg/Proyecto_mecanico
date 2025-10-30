<?php
include ('../conexionbd.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Inicio</title>

     <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
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
              <a class="nav-link text-white" href="../inicio1.php">Inicio</a>
            </li>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../serviciospendientes/spendientes.php">Servicios pendientes</a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="../solservicio/servicios.php">Servicios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="../misautos/misautos.php">Mis autos</a>
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
                 <a class="dropdown-item" href="../Infousr/infousr.php">Mi perfil</a>
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
                                <label for="myUsuario">Usuario:</label>
                                <input class="form-control" list="usuarios" id="myUsuario" name="myUsuario" placeholder="Selecciona un usuario" />
                                <datalist id="usuarios">
                                    <?php
                                    $selectusr = "SELECT correo FROM clientes";
                                    $result = $con->query($selectusr);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['correo'] . '"></option>';
                                    }
                                    ?>
                                </datalist>
                                <input type="submit" value="Buscar autos" class="btn btn-primary mt-2" onclick="fetchAutos(); return false;">
                                </form>
                                
                                <!-- muestra autos del usuario seleccionado -->
                                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['myUsuario'])) { 
                                    echo "<form action='' method='post'>";

                                        $selectauto = "SELECT marca, modelo, año, n_chasis FROM auto where correo='" . $_POST['myUsuario'] . "';";
                                        $result = $con->query($selectauto);
                                ?>
                                <br>
                                <label for="autoUsuario">Auto:</label>
                                <select class="form-control" id="autoUsuario" name="autoUsuario">
                                    <option value="">Selecciona un auto</option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['n_chasis'] . '">' . $row['marca'] . ' ' . $row['modelo'] . ' (' . $row['año'] . ')</option>';
                                    }
                                    ?>
                                </select>
                <label for="fecha">Fecha preferida:</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
                 <label for="myservice">Service:</label>
                        <input class="form-control" list="servicios" id="myservice" name="myservice" placeholder="Selecciona un servicio" />
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
                <button type="submit" name="solicitar" class="btn btn-primary">Solicitar</button>
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
                'pendiente'
            )";
               if ($con->query($insertar) === TRUE) {
                   echo "<p class='text-success'>Servicio solicitado con éxito.</p>";
               } else {
                   echo "<p class='text-danger'>Error al solicitar el servicio: " . $con->error . "</p>";
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
    join realizan re on re.n_chasis = a.n_chasis
    WHERE re.correo_elec = '".$_SESSION['email']."'
    ";
    ?>
    <div class="d-flex gap-2 mb-3">
     <form action="" method="post">
                <input type="hidden" name="todo" value="todos">
                <button type="submit" class="btn btn-primary">Mostrar todos</button>
            </form><br>
            <form action="" method="post">
                <input type="hidden" name="todo" value="recargar">
                <button type="submit" class="btn btn-primary">Recargar Pagina</button>
            </form>
          </div>  
        <?php
if (!isset($_POST['todo'])) {
    $sel .= " AND estado = 'pendiente'";
 
} 
if(isset($_POST['todo']) && $_POST['todo'] == 'recargar'){
    echo "<meta http-equiv='refresh' content='0'>";
}
$sel .= " AND estado != 'cancelado' AND estado != 'eliminado'";
$sel .= " ORDER BY fecha ASC";
    $res = $con->query($sel);
    
    if ($res->num_rows > 0) { ?>
      <div class="container py-5">
        <h2 class="text-center mb-4">Servicios Pendientes</h2>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Auto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Descripción</th>
                <th scope="col">Chasis</th>
                <th scope="col">Costo</th>
                <th scope="col">Acciones</th>
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
    <input type="hidden" name="accion" value="expandir">
    <input type="hidden" name="n_chasis" value="<?php echo $fila['n_chasis']; ?>">
    <input type="hidden" name="id_service" value="<?php echo $fila['id_service']; ?>">
    <input type="hidden" name="fecha" value="<?php echo $fila['fecha']; ?>">
    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#serviceModal">
        <i class="fas fa-edit"></i> Expandir
    </button>
</form>
         <form method="post" style="display:inline;">
    <input type="hidden" name="accion" value="eliminar">
    <input type="hidden" name="n_chasis" value="<?php echo $fila['n_chasis']; ?>">
    <input type="hidden" name="id_service" value="<?php echo $fila['id_service']; ?>">
    <input type="hidden" name="fecha" value="<?php echo $fila['fecha']; ?>">
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> Eliminar
    </button>
</form>
                   <form method="post" style="display:inline;">
        <input type="hidden" name="accion" value="cancelar">
            <input type="hidden" name="n_chasis" value="<?php echo $fila['n_chasis']; ?>">
    <input type="hidden" name="id_service" value="<?php echo $fila['id_service']; ?>">
    <input type="hidden" name="fecha" value="<?php echo $fila['fecha']; ?>">
        <button type="submit" class="btn btn-warning btn-sm">
            <i class="fa-solid fa-xmark"></i> Cancelar
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
           echo "<p class='text-success'>Servicio eliminado con éxito.</p>";
       } else {
           echo "<p class='text-danger'>Error al eliminar el servicio: " . $con->error . "</p>";
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
               $cambiarmembresia= "UPDATE auto SET estado = 'inactivo' WHERE n_chasis = '$n_chasis'";
       if ($con->query($cancelar) === TRUE && $con->query($cambiarmembresia) === TRUE) {
           echo "<p class='text-success'>Servicio cancelado con éxito.</p>";
       } else {
           echo "<p class='text-danger'>Error al cancelar el servicio: " . $con->error . "</p>";
       }
   }

}
  ?>
           <!-- Modal para mostrar información del service -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel">Detalles del Servicio</h5>
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
    s.*, 
    r.fecha, 
    r.estado, 
    u.nombre, 
    u.apellido,
    e.id_etapa,
    e.nombre AS nombre_etapa,
    i.id_insumos,
    i.tipo AS nombre_insumo,
    n.cantidad
FROM auto a
JOIN reciben r ON a.n_chasis = r.n_chasis
JOIN servicios s ON s.id_service = r.id_service
JOIN usuario u ON a.correo = u.correo
-- Relación entre servicio y etapa
JOIN tienen_etapa_service tes ON s.id_service = tes.id_service
JOIN etapa e ON e.id_etapa = tes.id_etapa
-- Relación entre etapa e insumos
JOIN necesitan n ON e.id_etapa = n.id_etapa
JOIN insumos i ON n.id_insumo = i.id_insumos
WHERE 
    a.n_chasis = '$n_chasis' 
    AND s.id_service = '$id_service' 
    AND r.fecha = '$fecha'
    AND e.tipo = 1;";
            
            $result = $con->query($query);
            
            if ($row = $result->fetch_assoc()) {
                echo "<p><strong>Cliente:</strong> " . htmlspecialchars($row['nombre'] . " " . $row['apellido']) . "</p>";
                echo "<p><strong>Vehículo:</strong> " . htmlspecialchars($row['marca'] . " " . $row['modelo'] . " (" . $row['año'] . ")") . "</p>";
                echo "<p><strong>Número de Chasis:</strong> " . htmlspecialchars($row['n_chasis']) . "</p>";
                echo "<p><strong>Servicio:</strong> " . htmlspecialchars($row['nombre']) . "</p>";
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($row['descripcion']) . "</p>";
                echo "<p><strong>Fecha programada:</strong> " . htmlspecialchars($row['fecha']) . "</p>";
                echo "<p><strong>Estado:</strong> " . htmlspecialchars($row['estado']) . "</p>";
                echo "<p><strong>Costo:</strong> $" . htmlspecialchars($row['costos']) . "</p>";
                echo "<h5>Etapas e Insumos:</h5>";
                echo "<ul>";
                do {
                    echo "<li><strong>Etapa:</strong> " . htmlspecialchars($row['nombre_etapa']) . " - <strong>Insumo:</strong> " . htmlspecialchars($row['nombre_insumo']) . " - <strong>Cantidad:</strong> " . htmlspecialchars($row['cantidad']) . "</li>";
                } while ($row = $result->fetch_assoc());
            }
            
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

    </div>
    </div>

  <footer class="bg-dark text-white text-center py-3 mt-4">

          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>


              <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
    </body>
    </html>
