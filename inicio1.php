    <?php
    include 'conexionbd.php';
    include 'lang.php';
    session_start();
    ?>

    <!DOCTYPE html>
    <html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo t('title'); ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

      <link rel="stylesheet" href="inicio.css">
    </head>
     <body>

  <div class="header-section text-center text-white py-3">
    <div class="logo-container mb-2">
      <img src="imagenes-inicio/logo.png" alt="Logo" style="height: 80px;">
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
              <a class="nav-link text-white" href="inicio1.php?lang=<?php echo $lang; ?>"><?php echo t('nav_inicio'); ?></a>
            </li>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="serviciospendientes/spendientes.php?lang=<?php echo $lang; ?>"><?php echo t('nav_servicios_pendientes'); ?></a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="solservicio/servicios.php?lang=<?php echo $lang; ?>"><?php echo t('nav_servicios'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="misautos/misautos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_mis_autos'); ?></a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="aautos/aautos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_agregar_vehiculo'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="insumos/insumos.php?lang=<?php echo $lang; ?>"><?php echo t('nav_insumos'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="allusr/usuarios.php?lang=<?php echo $lang; ?>"><?php echo t('nav_usuarios'); ?></a>
              </li>
               <li class="nav-item">
                <a class="nav-link text-white" href="addservicios/svadd.php?lang=<?php echo $lang; ?>"><?php echo t('nav_agregar_servicios'); ?></a>
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
                  <a class="dropdown-item" href="login/registro.php?lang=<?php echo $lang; ?>"><?php echo t('nav_iniciar_sesion'); ?></a>
                <?php else: ?>
                    <a class="dropdown-item" href="infousr/infousr.php?lang=<?php echo $lang; ?>"><?php echo t('nav_mi_perfil'); ?></a>
                    <hr class="dropdown-divider">
                  <form action="inicio2.php" method="post" class="d-inline">
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



        <div class="container-fluid p-0">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">


                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner rounded shadow">
                    <div class="carousel-item active">
                        <img src="carruselinicio/imagen1.jpg" class="d-block w-100" alt="Auto deportivo en exhibición">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo t('carousel_vehiculos_nuevos'); ?></h5>
                            <p><?php echo t('carousel_desc_vehiculos'); ?></p>
                        </div>
                    </div>


                    <div class="carousel-item">
                        <img src="carruselinicio/imagen2.jpg" class="d-block w-100" alt="Taller mecánico profesional">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo t('carousel_servicio_tecnico'); ?></h5>
                            <p><?php echo t('carousel_desc_taller'); ?></p>
                        </div>
                    </div>

                <div class="carousel-item">
                        <img src="carruselinicio/imagen3.jpg" class="d-block w-100" alt="Vehículo familiar">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo t('carousel_seminuevos'); ?></h5>
                            <p><?php echo t('carousel_desc_seminuevos'); ?></p>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
        <div class="brand-row">
           <div class="logo-marca"> <img src="imagenes-inicio/chevrolet.png" alt="Chevrolet"></div>
            <div class="logo-marca"><img src="imagenes-inicio/fiat.png" alt="Fiat"></div>
            <div class="logo-marca"><img src="imagenes-inicio/nissan.png" alt="Nissan"></div>
            <div class="logo-marca"><img src="imagenes-inicio/mitsubishi.png" alt="Mitsubishi"></div>
            <div class="logo-marca"><img src="imagenes-inicio/toyota.png" alt="toyota"></div>
        </div>
        <div class="background">
            <section class="benefits-strip">
              <h2><?php echo t('benefits_title'); ?></h2>
              <div class="benefit">
                <img src="imagenes-inicio/original.png" alt="Vehículos certificados">
                <p><?php echo t('benefits_certificados'); ?></p>
              </div>
              <div class="benefit">
                <img src="imagenes-inicio/rayo.png" alt="Tramitación rápida">
                <p><?php echo t('benefits_rapida'); ?></p>
              </div>
              <div class="benefit">
                <img src="imagenes-inicio/auto 2d.png" alt="Las mejores marcas">
                <p><?php echo t('benefits_marcas'); ?></p>
              </div>
            </section>
        </div>
        <footer class="bg-dark text-white text-center py-3 mt-4">
           <h2 class="h2"><?php echo t('footer_visitanos'); ?></h2>
           <h1 class="h1"><?php echo t('footer_auto_nuevo'); ?></h1><br><br>
           <p class="contacto"><?php echo t('footer_contactanos'); ?></p>
           <div class="d-flex justify-content-between align-items-center flex-wrap px-3">
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/sobre.png"></div>
               <p class="logo-footer p">wolfcrewcontact@gmail.com</p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/telefono.png"></div>
               <p class="logo-footer p">+598 099 456 220</p>
             </div>
             <div class="d-flex align-items-center">
               <div class="logo-footer me-2"><img src="imagenes-inicio/pinubicacion.png"></div>
               <p class="logo-footer p">Con.José Pedro Varela 2737</p>
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
