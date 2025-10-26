<?php
include ('../conexionbd.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 1</title>
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
                     <a class="dropdown-item" href="#">Mi perfil</a>
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
    <div class="container mt-5">
        <div class="auto-btn-container">
            <a href="#" class="btn-añadir-auto"><i class="fa-solid fa-circle-plus"></i></a>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2>Información del servicio:</h2>
                <div class="container mt-4">
                    <h4>Agregar Servicio</h4>
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="nombre">Nombre del servicio:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>

                        <div class="mb-2">
                            <label for="requisitos">Requisitos:</label>
                            <textarea class="form-control" name="requisitos" id="requisitos" rows="3" required></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="4" required></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="costos">Costos:</label>
                            <input type="number" class="form-control" name="costos" id="costos" step="0.01" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-success">Agregar Servicio</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup para Agregar Etapa -->
        <div class="overlay" id="overlay-etapa">
            <div class="popup" id="popup-etapa">
                <a href="#" id="btn-cerrar-popup-etapa" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2>Agregar Etapa</h2>
                <div class="container mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="id_servicio" id="id_servicio_etapa">
                        <div class="mb-2">
                            <label for="nombre_etapa">Nombre de la etapa:</label>
                            <input type="text" class="form-control" name="nombre_etapa" id="nombre_etapa" required>
                        </div>
                        <div class="mb-2">
                            <label for="duracion">Duración:</label>
                            <input type="text" class="form-control" name="duracion" id="duracion" required>
                        </div>
                        <div class="mb-2">
                            <label for="tipo_etapa">Tipo:</label>
                            <input type="text" class="form-control" name="tipo_etapa" id="tipo_etapa" required>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Etapa</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup para Agregar Insumo -->
        <div class="overlay" id="overlay-insumo">
            <div class="popup" id="popup-insumo">
                <a href="#" id="btn-cerrar-popup-insumo" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h2>Agregar Insumo</h2>
                <div class="container mt-4">
                    <form action="" method="post">
                        <input type="hidden" name="id_servicio" id="id_servicio_insumo">
                        <div class="mb-2">
                            <label for="nombre_insumo">Nombre del insumo:</label>
                            <input type="text" class="form-control" name="nombre_insumo" id="nombre_insumo" required>
                        </div>
                        <div class="mb-2">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Insumo</button>
                    </form>
                </div>
            </div>
        </div>


            <br>
     <?php  
    $sel = "SELECT * FROM servicios";    
    
$res = $con->query($sel);
if ($res->num_rows > 0) { ?>
    <div class="container py-5">
        <h2 class="text-center mb-4">Servicios registrados</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Requisitos</th>
                        <th>Descripción</th>
                        <th>Costos</th>
                        <th>Acciones</th>
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
                                <button class="btn btn-primary btn-sm me-2 btn-agregar-etapa" data-id="<?php echo $fila['id_service']; ?>">Agregar Etapa</button>
                                <button class="btn btn-secondary btn-sm btn-agregar-insumo" data-id="<?php echo $fila['id_service']; ?>">Agregar Insumo</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } else {
    echo "<p class='text-center'>No se encontraron resultados.</p>";
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
            $sql = "INSERT INTO servicios (nombre, requisitos, descripcion, costos, id_servicio) VALUES ('$nombre', '$requisitos', '$descripcion', '$costos', '$id_servicio')";
            $res = $con->query($sql);
            if ($res == TRUE) {
                echo '<div class="alert alert-success">Servicio agregado exitosamente.</div>';
            } else {
                echo '<div class="alert alert-danger">Error al agregar el servicio: ' . $con->error . '</div>';
            }
        }
    } elseif (isset($_POST['nombre_etapa'])) {
        $id_etapa = random_int(1, 10000);
        $nombre_etapa = $_POST['nombre_etapa'];
        $tipo_etapa = $_POST['tipo_etapa'];
        $duracion_etapa = $_POST['duracion'];

        // Validación
        if (empty($nombre_etapa) || empty($tipo_etapa)) {
            echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios para la etapa.</div>';
        } else {
            $con->begin_transaction();
            try {
                $con->query("INSERT INTO etapa (id_etapa, nombre, tipo, duracion) VALUES ('$id_etapa', '$nombre_etapa', '$tipo_etapa', '$duracion_etapa')");
                $con->query("INSERT INTO tienen_etapa_service (id_service, id_etapa) VALUES ('".$_POST['id_servicio']."', '$id_etapa')");
                $con->commit();
                echo "Transacción completada con éxito";
            } catch (Exception $e) {
                // Si hay algún error, revertimos todo
                $con->rollback();
                echo "Error en la transacción: " . $e->getMessage();
            }
        }
    } elseif (isset($_POST['nombre_insumo'])) {
        $id_servicio = $_POST['id_servicio'];
        $nombre_insumo = $_POST['nombre_insumo'];
        $cantidad = $_POST['cantidad'];
        // Validación
        if (empty($nombre_insumo) || empty($cantidad)) {
            echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios para el insumo.</div>';
        } else {
            $sql = "INSERT INTO insumos (id_servicio, nombre, cantidad) VALUES ('$id_servicio', '$nombre_insumo', '$cantidad')";
            $res = $con->query($sql);
            if ($res == TRUE) {
                echo '<div class="alert alert-success">Insumo agregado exitosamente.</div>';
            } else {
                echo '<div class="alert alert-danger">Error al agregar el insumo: ' . $con->error . '</div>';
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

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="popup.js"></script>
</body>
</html>

<?php
