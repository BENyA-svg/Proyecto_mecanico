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
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> | 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>  
                <a href="servicios.php" class="text-white">Servicios</a> 
            <?php endif; ?>
        </nav>
    </div> 

    <form action="../inicio2.php" method="post">
        <div class="container mt-5">
            <div class="form-container">
                
                <label for="email">Correo electronico</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="ejemplo@gmail.com" name="email">

                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="contraseña" name="contraseña">
                <br>
                <select name="perfil" >
                <option value="" disabled selected>Selecciona un perfil</option>
                    <option value="admin">Admin</option>
                    <option value="centro">Centro</option>
                    <option value="cliente">Cliente</option>
                </select>

                <p>¿No tienes cuenta? 
                <a href="registrarse.php">registrarse</a></p>
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>

            </div>
        </div>
    </form>
</body>
