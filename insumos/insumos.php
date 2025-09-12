<?php
include ('../conexionbd.php');
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuancitoMotores - Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet">
   <script src="https://kit.fontawesome.com/16aa28c921.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="insumos.css">
</head>
<body>
    <div class="header-section">
        <h2>JuancitoMotores</h2>
        
        <?php if (isset($_SESSION['perfil'])): ?>
            <h2>Perfil <?php echo $_SESSION['perfil']; ?></h2>
        <?php endif; ?>
        
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> | 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="../aautos/aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos.php" class="text-white">Insumos</a> |
            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="../inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="btn btn-link text-white p-0" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Formulario para agregar insumo -->
    <div class="container mt-4">
        <h4>Agregar Insumo</h4>
        <form method="post" action="">
            
            <div class="mb-2">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" required>
            </div>
            <div class="mb-2">
                <label for="tipo">Tipo:</label>
                <input type="text" class="form-control" name="tipo" required>
            </div>
            
            <div class="mb-2">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            <div class="mb-2">
                <label for="fecha_pedido">Fecha pedido:</label>
                <input type="date" class="form-control" name="fecha_pedido" required>
            </div>
            <input type="hidden" name="accion" value="agregar">
            <button type="submit" class="btn btn-success">Agregar Insumo</button>
        </form>
    </div>

    <div class="border-container">
        <div class="card">
            <img src="imagenes\aceite.png" class="card-img-top" alt="Aceite">
            <div class="card-body">
                <h5 class="card-title">Aceite</h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary btn-editar"
                data-nombre="Aceite"
                data-tipo="Lubricante"
                data-cantidad="10"
                data-precio="500">Editar</a>
            </div>
        </div>

        <div class="card">
            <img src="imagenes\aceite.png" class="card-img-top" alt="Aceite">
            <div class="card-body">
                <h5 class="card-title">Aceite</h5>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary btn-editar"
                data-nombre="Aceite"
                data-tipo="Lubricante"
                data-cantidad="10"
                data-precio="500">Editar</a>
            </div>
        </div>
    </div> <!-- Cierra el div con class="border-container" --> 

    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2>Informacion del insumo:</h2>
            
                    <a href="#" id="agregar-servicio" class="agregar-servicio"><i class="fa-solid fa-plus"></i></a>
                </div>
                <button class="btn btn-primary" id="btn-confirmar">Agregar insumo</button>
            </form>
        </div>
    </div>
    <script src="popup.js"></script>
        

<?php
$sel = "SELECT * FROM insumos";

$res = $con->query($sel);
if ($res->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID Insumo</th><th>Precio</th><th>Tipo</th><th>CI</th><th>Correo</th><th>Cantidad</th><th>Fecha pedido</th></tr>";
    while($fila = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["id_insumos"] . "</td>";
        echo "<td>" . $fila["precio"] . "</td>";
        echo "<td>" . $fila["tipo"] . "</td>";
        echo "<td>" . $fila["ci_of"] . "</td>";
        echo "<td>" . $fila["correo_of"] . "</td>";
        echo "<td>" . $fila["cantidad_pedida"] . "</td>";
        echo "<td>" . $fila["fecha_pedido"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidad_pedida = $_POST['cantidad_pedida'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $numeroSeguro = random_int(1, 100);
    $sql = "INSERT INTO insumos (id_insumos, precio, tipo, ci_of, correo_of, cantidad_pedida, fecha_pedido) 
    VALUES ('$numeroSeguro', '$precio', '$tipo', '".$_SESSION['ci']."', '".$_SESSION['email']."', '$cantidad_pedida', '$fecha_pedido')";
    if ($con->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Insumo agregado correctamente.</div>';
        echo '<script>window.location = window.location.pathname;</script>';
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al agregar insumo: ' . $con->error . '</div>';
    }
}
  }
?>

         
</body>
</html>