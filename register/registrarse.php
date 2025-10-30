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
    <title><?php echo t('register_title'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registrarse.css">
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
    <form action="procesar_registro.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                <?php if (isset($_GET['creado'])): ?>
    <div class="alert alert-success">
        <?php echo t('register_success'); ?> <a href="../login/registro.php?lang=<?php echo $lang; ?>"><?php echo t('register_login'); ?></a>.
    </div>
<?php endif; ?>
                <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
            if ($_GET['error'] == 1) echo t('register_error_general');
            if ($_GET['error'] == 2) echo t('register_error_missing');
            if ($_GET['error'] == 3) echo t('register_error_duplicate');
        ?>
    </div>
<?php endif; ?>
                <label for="exampleInputEmail1"><?php echo t('register_name'); ?></label>
                <input type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo t('register_placeholder_name'); ?>" name="Usuario">

                <label for="exampleInputEmail1"><?php echo t('register_lastname'); ?></label>
                <input type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo t('register_placeholder_lastname'); ?>" name="apellido">

                <label for="exampleInputEmail1"><?php echo t('register_email'); ?></label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo t('register_placeholder_email'); ?>" name="email">

                <label for="exampleInputEmail1"><?php echo t('register_phone'); ?></label>
                <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo t('register_placeholder_phone'); ?>" name="telefono">

                <label for="exampleInputPassword1"><?php echo t('register_password'); ?></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="<?php echo t('register_placeholder_password'); ?>" name=contraseña>
                <br>
                <p><?php echo t('register_have_account'); ?>
                <a href="../login/registro.php?lang=<?php echo $lang; ?>"><?php echo t('register_login'); ?></a></p>
                <button type="submit" class="btn btn-primary"><?php echo t('register_button'); ?></button>

            </div>
        </div>
    </form>

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


    </body>
    </html>


