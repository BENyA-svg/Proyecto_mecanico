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
    <link rel="stylesheet" href="aautos.css">

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
                <div class="form-container">
                     <form action="" method="post">
                       
                                <label for="myUsuario">Usuario:</label>
                                <input list="usuarios" id="myUsuario" name="myUsuario" placeholder="Selecciona un usuario" />
                                <datalist id="usuarios">
                                    <?php
                                    $selectUsuarios = "SELECT correo FROM usuario";
                                    $result = $con->query($selectUsuarios);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['correo'] . '"></option>';
                                    }
                                    ?>
                                </datalist><br><br>

               
                    <label for="num_chasis">Número de chasis:</label>
                    <input  type="text" name="num_chasis" id="num_chasis" required> <br> <br>
              

               
                    <label for="num_motor">Número de motor:</label>
                    <input  type="text" name="num_motor" id="num_motor" required> <br> <br>
             

                
                    <label for="marca">Marca:</label>
                    <input  type="text" name="marca" id="marca" required> <br> <br>
              

                
                    <label for="modelo">Modelo:</label>
                    <input  type="text" name="modelo" id="modelo" required> <br> <br>
               

             
                    <label for="año">Año:</label>
                    <input  type="number" name="año" id="año" min="1886" max="2100" required> <br> <br>
                

                    <label for="fecha_compra">Fecha de compra:</label>
                    <input  type="date" name="fecha_compra" id="fecha_compra" required> <br> <br>
                    <button type="submit">Enviar</button>
                </div>

    

                
            </form>
            </div>
            <br>
     <?php  
    $sel = "SELECT * FROM auto";    
    
$res = $con->query($sel);
if ($res->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Correo</th><th>numero de chasis</th><th>numero de motor</th><th>matricula</th><th>Marca</th><th>Modelo</th><th>Año</th><th>Fecha de compra</th><th>Estado de garantia</th><th>Persona que lo registro</th></tr>";
    while($fila = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["correo"] . "</td>";
        echo "<td>" . $fila["n_chasis"] . "</td>";
        echo "<td>" . $fila["n_motor"] . "</td>";
        echo "<td>" . $fila["matricula"] . "</td>";
        echo "<td>" . $fila["marca"] . "</td>";
        echo "<td>" . $fila["modelo"] . "</td>";
        echo "<td>" . $fila["año"] . "</td>";
        echo "<td>" . $fila["fecha_compra"] . "</td>";
        echo "<td>" . $fila["estado_g"] . "</td>";
        echo "<td>" . $fila["correo_of"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}
?>
            </div>
        </div>
                <?php
// Procesamiento del formulario de "Agregar autos"
if ($_SERVER["REQUEST_METHOD"] == 'POST') { 
    $num_chasis =$_POST['num_chasis'];
    $num_motor = $_POST['num_motor'];
    $marca = ($_POST['marca']);
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $correo = $_POST['myUsuario'];
    $fecha_compra = $_POST['fecha_compra'];

  
    // Validación mínima
    if (empty($num_chasis) || empty($num_motor) || empty($marca) || empty($modelo) || empty($año) || empty($correo) || empty($fecha_compra)) {
        echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios correctamente.</div>';
    } else {
        $sql = "INSERT INTO auto (n_chasis, n_motor, marca, modelo, año, correo, fecha_compra, correo_of) VALUES ('".$num_chasis."', '".$num_motor."', '".$marca."', '".$modelo."', '".$año."', '".$correo."', '".$fecha_compra."','".$_SESSION['email']."')";
        if ($res = $con->query($sql) == TRUE) {
           echo '<div class="alert alert-success">Vehículo agregado exitosamente.</div>';
            }
             else {
                echo '<div class="alert alert-danger">Error al agregar el vehículo:</div>';
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

</body>
</html>

<?php
