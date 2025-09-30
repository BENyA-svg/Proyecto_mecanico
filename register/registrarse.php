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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="registrarse.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> | 
        </nav>
    </div> 

    <form action="procesar_registro.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                <?php if (isset($_GET['creado'])): ?>
    <div class="alert alert-success">
        Usuario registrado exitosamente, avance a <a href="../login/registro.php">iniciar sesión</a>.
    </div>
<?php endif; ?>
                <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
            if ($_GET['error'] == 1) echo "Error al registrar usuario. Intenta nuevamente.";
            if ($_GET['error'] == 2) echo "Faltan datos obligatorios para el registro.";
            if ($_GET['error'] == 3) echo "El correo o la cédula ya están registrados.";
        ?>
    </div>
<?php endif; ?>
                <label for="exampleInputEmail1">Nombre</label>
                <input type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diego" name="Usuario">

                <label for="exampleInputEmail1">Apellido</label>
                <input type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Peña" name="apellido">

                <label for="exampleInputEmail1">Cedula</label>
                <input type="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="12345678" name="cedula">

                <label for="exampleInputEmail1">Correo electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ejemplo@gmail.com" name="email">
   
                <label for="exampleInputEmail1">Telefono</label>
                <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="012495115" name="telefono">
    
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="contraseña" name=contraseña>  
                <br>
                <p>¿has olvidado tu contraseña? 
                <a href="registro.php">Cambiar constraseña</a></p>
                <p>¿Ya tienes cuenta? 
                <a href="registro.php">Inicio sesion</a></p>
                <button type="submit" class="btn btn-primary">Confirmale a Juancito</button>

            </div>
        </div>
    </form>
</body>
</html>
