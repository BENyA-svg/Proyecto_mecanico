<?php
include '../conexionbd.php';
include '../lang.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('title_users'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="usuarios.css">
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
    <div class="container">
        <div class="tabla">


            <!-- a explicar en la presentacion -->
        <?php  
  $sel = "SELECT * FROM usuario";    
    
  $res = $con->query($sel);
  if ($res->num_rows > 0) {
  // Usar el mismo formato que la tabla de servicios pendientes
  echo '<div class="container py-5">';
  echo '<h2 class="text-center mb-4">' . t('users') . '</h2>';
  echo '<div class="table-responsive">';
  echo '<table class="table table-striped table-hover">';
  echo '<thead class="table-dark"><tr><th scope="col">' . t('id') . '</th><th scope="col">' . t('name') . '</th><th scope="col">' . t('last_name') . '</th><th scope="col">' . t('email') . '</th><th scope="col">' . t('phone') . '</th><th scope="col">' . t('role') . '</th><th scope="col">' . t('actions') . '</th></tr></thead>';
  echo '<tbody>';
    while($fila = $res->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($fila["ci"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["apellido"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["correo"]) . "</td>";
      echo "<td>" . htmlspecialchars($fila["telefono"]) . "</td>";
      $sel2 = "SELECT correo, 'cliente' AS cargo
      FROM clientes
      WHERE correo = '" . $fila["correo"] . "'
      UNION
      SELECT correo, 'centros' AS cargo
      FROM centros
      WHERE correo = '" . $fila["correo"] . "' 
      UNION
      SELECT correo, 'ventas' AS cargo
      FROM ventas
      WHERE correo = '".$fila["correo"]."'
      LIMIT 1;";
      $res2 = $con->query($sel2);
      if ($res2->num_rows > 0) {
        $fila2 = $res2->fetch_assoc();
        $cargo = $fila2["cargo"];
        echo "<td>" . htmlspecialchars($cargo) . "</td>";
      } else {
        $cargo = 'Desconocido';
        echo "<td>Desconocido</td>";
      }
      // Columna de acciones: botón que rellena el formulario de abajo
      $correo_js = addslashes($fila["correo"]);
      $cargo_js = addslashes($cargo);
      echo '<td><button type="button" class="btn btn-sm btn-primary" onclick="editarUsuario(\'' . $correo_js . '\', \'' . $cargo_js . '\')">' . t('edit') . '</button></td>';
      echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  }

?>
    <!-- a explicar en la presentacion -->


        </div>
    </div>
     <form action="" method="post">
    <label for="usuario"><?php echo t('user_email'); ?>:</label>
    <input type="text" name="usuario" id="usuario" required>

    <label for="perfil"><?php echo t('new_profile'); ?>:</label>
    <select name="perfil" id="perfil" required>
        <option value="admin"><?php echo t('admin'); ?></option>
        <option value="cliente"><?php echo t('client'); ?></option>
        <option value="centro"><?php echo t('center'); ?></option>
    </select>

    <button name="accion"  type="submit"><?php echo t('update_role'); ?></button>
</form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $perfil = $_POST['perfil'];
      
             if (isset($_POST['accion'])&& $_POST['perfil'] == 'admin') {
           $sql1 = "INSERT INTO ventas(correo) VALUES ('$usuario')";
        $sql2 = "DELETE FROM clientes WHERE correo ='$usuario'";
        }elseif (isset($_POST['accion'])&& $_POST['perfil'] == 'centro') {
                $sql1 = "INSERT INTO centros(correo, correo_of) VALUES ('$usuario','$_SESSION[email]')";
        $sql2 = "DELETE FROM clientes WHERE correo ='$usuario'";
        }elseif (isset($_POST['accion'])&& $_POST['perfil'] == 'cliente') {
            $sql1 = "INSERT INTO clientes( correo, correo_of) VALUES ( '$usuario','$_SESSION[email]')";
        }
           if ($con->query($sql1) === TRUE) {
        if (isset($sql2)) {
            $con->query($sql2);
        }
        echo "<div class='alert alert-primary'>" . t('role_updated_successfully') . "</div>";
    }
        } 
          
          ?>
      <script>
      function editarUsuario(email, cargo) {
        var usuarioInput = document.getElementById('usuario');
        var perfilSelect = document.getElementById('perfil');
        if (usuarioInput) usuarioInput.value = email;
        if (perfilSelect && cargo) {
          var buscado = cargo.toLowerCase();
          for (var i = 0; i < perfilSelect.options.length; i++) {
            if (perfilSelect.options[i].value.toLowerCase() === buscado) {
              perfilSelect.selectedIndex = i;
              break;
            }
          }
        }
        // desplazar hasta el formulario
        var form = document.querySelector('form[action=""]');
        if (form) form.scrollIntoView({behavior: 'smooth', block: 'center'});
      }
      </script>
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>


