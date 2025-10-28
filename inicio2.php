<?php
session_start();
include 'conexionbd.php';
include 'lang.php';
if (isset($_POST['cerrar'])) {
    $current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
    session_unset();
    session_destroy();
    header("Location: inicio1.php?lang=" . $current_lang);
    exit();
}

if (empty($_POST['email']) || empty($_POST['contraseña'])) {
   header("Location: ./login/registro.php?error=2&lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
   exit();
}

if (isset($_REQUEST['email']) && isset($_REQUEST['contraseña'])) {
    $email = $_REQUEST['email'];
    $contraseña = $_REQUEST['contraseña'];
    $sql ="SELECT * FROM usuario WHERE correo = '".$email."' AND contraseña = '".$contraseña."'";
    $res = $con->query($sql);
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['ci'] = $row["ci"];
        $_SESSION['nombre'] = $row["nombre"];
        $_SESSION['apellido'] = $row["apellido"];
        $_SESSION['email'] = $row["correo"];

        // Consulta para definir el perfil/cargo automáticamente
        $sel2 = "SELECT correo, 'cliente' AS cargo
            FROM clientes
            WHERE correo = '" . $row["correo"] . "'
            UNION
            SELECT correo, 'centro' AS cargo
            FROM centros
            WHERE correo = '" . $row["correo"] . "' 
            UNION
            SELECT correo, 'ventas' AS cargo
            FROM ventas
            WHERE correo = '".$row["correo"]."'
            LIMIT 1;";
        $res2 = $con->query($sel2);

        if ($res2 && $res2->num_rows > 0) {
            $cargoRow = $res2->fetch_assoc();
            $_SESSION['perfil'] = $cargoRow['cargo'];
        } else {
            $_SESSION['perfil'] = 'usuario'; // Valor por defecto si no se encuentra
        }

        // Ensure language is set in session after login
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'es';
        }

    } else {
        header("Location: ./login/registro.php?error=1&lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
        exit();
    }
} else {
   exit();
}

header("Location: inicio1.php?lang=" . (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'));
?>
  <footer class="bg-dark text-white text-center py-3 mt-4">
           <h2 class="h2">¡Vení a visitarnos!</h2>
           <h1 class="h1">Y salí manejando tu auto como nuevo</h1><br><br>
           <p class="contacto">Contactanos </p>
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
          <p>&copy; 2024 JuancitoMotores. Todos los derechos reservados.</p>
        </footer>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
