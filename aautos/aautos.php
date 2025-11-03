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
    <title><?php echo t('title_add_vehicles'); ?></title>
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
                <h2><?php echo t('vehicle_information'); ?></h2>
                <div class="container mt-4">
                    <h4><?php echo t('add_vehicle'); ?></h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="myUsuario"><?php echo t('user'); ?>:</label>
                            <input list="usuarios" class="form-control" id="myUsuario" name="myUsuario" placeholder="<?php echo t('selecciona_usuario'); ?>" />
                            <datalist id="usuarios">
                                <?php
                                $selectUsuarios = "SELECT correo FROM usuario";
                                $result = $con->query($selectUsuarios);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['correo'] . '"></option>';
                                }
                                ?>
                            </datalist>
                        </div>

                        <div class="mb-2">
                            <label for="num_chasis"><?php echo t('chassis_number'); ?>:</label>
                            <input type="text" class="form-control" name="num_chasis" id="num_chasis" required>
                        </div>

                        <div class="mb-2">
                            <label for="num_motor"><?php echo t('engine_number'); ?>:</label>
                            <input type="text" class="form-control" name="num_motor" id="num_motor" required>
                        </div>

                        <div class="mb-2">
                            <label for="marca"><?php echo t('brand'); ?>:</label>
                            <input type="text" class="form-control" name="marca" id="marca" required>
                        </div>

                        <div class="mb-2">
                            <label for="modelo"><?php echo t('model'); ?>:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" required>
                        </div>

                        <div class="mb-2">
                            <label for="año"><?php echo t('year'); ?>:</label>
                            <input type="number" class="form-control" name="año" id="año" min="1886" max="2100" required>
                        </div>

                        <div class="mb-2">
                            <label for="fecha_compra"><?php echo t('purchase_date'); ?>:</label>
                            <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required>
                        </div>


                        <div class="mb-2">
                            <label for="foto"><?php echo t('image'); ?>:</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>

                        <button type="submit" class="btn btn-success"><?php echo t('add_vehicle_button'); ?></button>
                    </form>
                </div>
            </div>
        </div>


            <br>
     <?php  
    $sel = "SELECT * FROM auto";    
    
$res = $con->query($sel);
if ($res->num_rows > 0) { ?>
    <div class="container py-5">
        <h2 class="text-center mb-4"><?php echo t('registered_vehicles'); ?></h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th><?php echo t('user'); ?></th>
                        <th><?php echo t('chassis_number'); ?></th>
                        <th><?php echo t('engine_number'); ?></th>
                        <th><?php echo t('license_plate'); ?></th>
                        <th><?php echo t('brand'); ?></th>
                        <th><?php echo t('model'); ?></th>
                        <th><?php echo t('year'); ?></th>
                        <th><?php echo t('purchase_date'); ?></th>
                        <th><?php echo t('warranty_status'); ?></th>
                        <th><?php echo t('registered_by'); ?></th>
                        <th><?php echo t('image'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = $res->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila["correo"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["n_chasis"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["n_motor"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["matricula"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["marca"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["modelo"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["año"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["fecha_compra"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["estado_g"]); ?></td>
                            <td><?php echo htmlspecialchars($fila["correo_of"]); ?></td>
                            <td><img src='data:image/jpeg;base64,<?php echo base64_encode($fila["imagen"]); ?>' width='100' class='img-fluid' alt='Imagen del auto'></td>
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
// Procesamiento del formulario de "Agregar autos"
if ($_SERVER["REQUEST_METHOD"] == 'POST') { 
    $num_chasis =$_POST['num_chasis'];
    $num_motor = $_POST['num_motor'];
    $marca = ($_POST['marca']);
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $correo = $_POST['myUsuario'];
    $fecha_compra = $_POST['fecha_compra'];
    $imagen = $_FILES['foto']['name'];
   $imgData = file_get_contents($_FILES['foto']['tmp_name']);
    $imgData = $con->real_escape_string($imgData);
    if (empty($num_chasis) || empty($num_motor) || empty($marca) || empty($modelo) || empty($año) || empty($correo) || empty($fecha_compra) || empty($imagen)) {
        echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios correctamente.</div>';
    } else {
        $sql = "INSERT INTO auto (n_chasis, n_motor, marca, modelo, año, correo, fecha_compra, correo_of, imagen, estado_g)
        VALUES ('".$num_chasis."', '".$num_motor."', '".$marca."', '".$modelo."', '".$año."', '".$correo."', '".$fecha_compra."','".$_SESSION['email']."', '".$imgData."', 'Activo')";
        $res = $con->query($sql);
        if ($res == TRUE) {
           echo '<div class="alert alert-success">' . t('vehicle_added_successfully') . '</div>';
            }
             else {
                echo '<div class="alert alert-danger">' . t('error_adding_vehicle') . '</div>';
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
    <script src="popup.js"></script>
</body>
</html>

