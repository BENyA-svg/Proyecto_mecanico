<?php
include '../conexionbd.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="usuarios.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        
        <?php if (isset($_SESSION['perfil'])): ?>
            <h2>Perfil <?php echo $_SESSION['perfil']; ?></h2>
        <?php endif; ?>
        
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        
        <nav>
            <a href="inicio1.php" class="text-white">Inicio</a> | 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>  
                <a href="serviciospendientes/spendientes.php" class="text-white">Servicios pendientes</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>  
                <a href="solservicio/servicios.php" class="text-white">Servicios</a> | 
                <a href="misautos/misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="aautos/aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos/insumos.php" class="text-white">Insumos</a> |
                <a href= "allusr/usuarios.php" class="text-white">Usuarios</a> |
             <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="login/registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="btn btn-link text-white p-0" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>
    <div class="container">
        <div class="tabla">
        <?php  
    $sel = "SELECT * FROM usuario";    
$res = $con->query($sel);
if ($res->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>CI</th><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Telefono</th></tr>";
    while($fila = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["ci"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["apellido"] . "</td>";
        echo "<td>" . $fila["correo"] . "</td>";
        echo "<td>" . $fila["telefono"] . "</td>";
         
        echo "</tr>";
    }
    echo "</table>";
}
?>
        </div>
    </div>
     <form action="" method="post">
    <label for="usuario">Usuario (email):</label>
    <input type="text" name="usuario" id="usuario" required>

    <label for="perfil">Nuevo perfil:</label>
    <select name="perfil" id="perfil" required>
        <option value="admin">Admin</option>
        <option value="cliente">Cliente</option>
        <option value="centro">Centro</option>
    </select>

    <button type="submit">Actualizar rango</button>
</form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $perfil = $_POST['perfil'];
            
          }  
          
          ?>
         
    </body>
</html>
