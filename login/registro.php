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
    <title><?php echo t('login_title'); ?></title>
       <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registro.css">
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
              <button class="btn btn-outline-light" onclick="window.location.href='?lang=<?php echo ($lang == 'es' ? 'en' : 'es'); ?>'"><?php echo ($lang == 'es' ? 'EN' : 'ES'); ?></button>
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

    <form action="../inicio2.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
            if ($_GET['error'] == 1) echo t('login_error_incorrect');
            if ($_GET['error'] == 2) echo t('login_error_missing');

        ?>
    </div>
<?php endif; ?>
                <label for="email"><?php echo t('login_email'); ?></label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo t('login_placeholder_email'); ?>" name="email">

                <label for="password"><?php echo t('login_password'); ?></label>
                <input type="password" class="form-control" id="password" placeholder="<?php echo t('login_placeholder_password'); ?>" name="contraseña">
                <br>
               <p><?php echo t('login_no_account'); ?>
                <a href="../register/registrarse.php?lang=<?php echo $lang; ?>"><?php echo t('login_register'); ?></a></p>
                <button name="submit" type="submit" class="btn btn-primary"><?php echo t('login_submit'); ?></button>

            </div>
        </div>
    </form>
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>