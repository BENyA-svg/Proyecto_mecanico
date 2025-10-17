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
    <link rel="stylesheet" href="servicependiente.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
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
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'centro'): ?>  
                <a href="spendientes.php" class="text-white">Servicios pendientes</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>  
                <a href="servicios.php" class="text-white">Servicios</a> | 
                <a href="misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'admin'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehículo</a> |
                <a href="insumos.php" class="text-white">Insumos</a> |
                <a href= "usuarios.php" class="text-white">Usuarios</a> |

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
     <form action="" method="post" >
        <div class="container mt-5">
            <div class="form-container">
         
             <!-- busca auto a partir de usuario -->
                                <label for="myUsuario">Usuario:</label>
                                <input class="form-control" list="usuarios" id="myUsuario" name="myUsuario" placeholder="Selecciona un usuario" />
                                <datalist id="usuarios">
                                    <?php
                                    $selectusr = "SELECT correo FROM clientes";
                                    $result = $con->query($selectusr);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['correo'] . '"></option>';
                                    }
                                    ?>
                                </datalist>
                                <input type="submit" value="Buscar autos" class="btn btn-primary mt-2" onclick="fetchAutos(); return false;">
                                </form>
                                
                                <!-- muestra autos del usuario seleccionado -->
                                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['myUsuario'])) { 
                                    echo "<form action='' method='post'>";

                                        $selectauto = "SELECT marca, modelo, año, n_chasis FROM auto";
                                        $result = $con->query($selectauto);
                                ?>
                                <br>
                                <label for="autoUsuario">Auto:</label>
                                <select class="form-control" id="autoUsuario" name="autoUsuario">
                                    <option value="">Selecciona un auto</option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['n_chasis'] . '">' . $row['marca'] . ' ' . $row['modelo'] . ' (' . $row['año'] . ')</option>';
                                    }
                                    ?>
                                </select>
                <label for="fecha">Fecha preferida:</label>
                <input type="datetime-local" class="form-control" name="fecha" id="fecha">
                 <label for="myservice">Service:</label>
                        <input class="form-control" list="servicios" id="myservice" name="myservice" placeholder="Selecciona un servicio" />
                        <datalist id="servicios">
                        <?php
                            $selectservice = "SELECT * FROM servicios";
                        $result = $con->query($selectservice);
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['nombre'] .'"></option>';
                                    }
                                    ?>
                                </datalist>
                <br>
                <?php
                   echo   "<input type='hidden' name='myUsuario' value='".$_POST['myUsuario']."'>";
                ?>
                <button type="submit" name="solicitar" class="btn btn-primary">Solicitar</button>
            </div>
        </div>
        <?php } ?>
           <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['solicitar'])) { 
               $usuario = $_POST['myUsuario'];
               $auto = $_POST['autoUsuario'];
               $fecha = $_POST['fecha'];
               $service = $_POST['myservice'];

            $insertar = "INSERT INTO reciben (n_chasis, id_service, fecha, estado) values (
                (SELECT n_chasis FROM auto WHERE n_chasis = '$auto'),
                (SELECT id_service FROM servicios WHERE nombre = '$service'),
                '$fecha',
                'pendiente'
            )";
               if ($con->query($insertar) === TRUE) {
                   echo "<p class='text-success'>Servicio solicitado con éxito.</p>";
               } else {
                   echo "<p class='text-danger'>Error al solicitar el servicio: " . $con->error . "</p>";
               }
                
           } ?>
    </form>
    <h3 class="form-title">Servicios Pendientes</h3>
    <div class="container">
        <div class="service">
      
          <?php

   $sel = "SELECT a.*, s.*, r.fecha, r.estado FROM auto a 
    JOIN reciben r ON a.n_chasis = r.n_chasis 
    JOIN servicios s ON s.id_service = r.id_service
    ";
    ?>
     <form action="" method="post">
                <input type="hidden" name="todo" value="todos">
                <button type="submit" class="btn btn-primary">Mostrar todos</button>
            </form>
        <?php
if (!isset($_POST['todo'])) {
    $sel .= " WHERE estado = 'pendiente'";
 
} 
$sel .= " ORDER BY fecha ASC";
    $res = $con->query($sel);
    if ($res->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Vehiculo</th><th>Fecha</th><th>Estado</th><th>Descripcion</th><th>chasis</th><th>costos</th></tr>";
        while($fila = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["marca"] . " " . $fila["modelo"] . " " . $fila["año"] . "</td>";
            echo "<td>" . $fila["fecha"] . "</td>";
            echo "<td>" . $fila["estado"] . "</td>";
            echo "<td>" . $fila["descripcion"] . "</td>";
             echo "<td>" . $fila["n_chasis"] . "</td>";
                   echo "<td>$" . $fila["costos"] . "</td>";

             
            echo "</tr>";
    
    
        }
            echo "</table>";
    }
?>
        </div>
    </div>
    <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
            <h2>Detalles del Servicio</h2>
            <p id="popup-vehiculo"></p>
            <p id="popup-tipo"></p>
            <p id="popup-fecha"></p>
            <p id="popup-descripcion"></p>
            <p id="popup-estado"></p>
             <p id="popup-matricula"></p>
            <button class="btn btn-primary" id="btn-confirmar">Confirmar Servicio</button>
        </div>
    </div>
   
    <script src="popup.js"></script>
</body>
</html>