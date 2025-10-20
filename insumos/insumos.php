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

    <!-- Formulario para agregar insumo -->
        <div class="insumo-btn-container">
        <a href="#" class="btn-añadir-insumo"><i class="fa-solid fa-circle-plus"></i></a>
    </div>

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2>Informacion del insumo:</h2>
            <div class="container mt-4">
        <h4>Agregar Insumo</h4>
        <form method="post" action="" enctype="multipart/form-data">
            
            <div class="mb-2">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" required>
            </div>
            <div class="mb-2">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" name="tipo" required>
            </div>
            
            <div class="mb-2">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            <div class="mb-2">
                <label for="fecha_pedido">Fecha pedido:</label>
                <input type="date" class="form-control" name="fecha_pedido" required>
            </div>
            <div class="mb-2">
                <label for="imagen">Imagen:</label>
          <input type="file" name="foto" id="foto">
            </div>
              <a href="#" id="agregar-servicio" class="agregar-servicio"><i class="fa-solid fa-plus"></i></a>
            <input type="hidden" name="accion" value="agregar">
            <button type="submit" class="btn btn-success">Agregar Insumo</button>
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
        echo "<img src='data:image/jpeg;base64," . base64_encode($fila["imagen"]) . "' class='card-img' alt='Imagen del auto'>";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">".$fila["tipo"]."</h5>";
        echo "<p class=\"card-text\">Precio: $".$fila["precio"]."</p>";
        echo "<p class=\"card-text\">Cantidad: ".$fila["cantidad_pedida"]."</p>";
        echo "<p class=\"card-text\"></p>";
        echo "<a href=\"#\" class=\"btn btn-primary btn-editar\"\">Editar</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
echo '</div>';
}
?>
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
        echo '<div class="alert alert-success">Insumo agregado correctamente.</div>';
        echo '<script>window.location = window.location.pathname;</script>';
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al agregar insumo: ' . $con->error . '</div>';
    }
}
  }
?>

         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
</body>
</html>