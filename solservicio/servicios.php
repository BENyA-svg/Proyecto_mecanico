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
   
    <link rel="stylesheet" href="servicios.css">
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
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>   
                <a href="servicios.php" class="text-white">Servicios</a> |
                <a href="../misautos/misautos.php" class="text-white">Mis autos</a> | 
            <?php endif; ?>
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehículo</a> |
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
    
    <form action="#" method="post" >
        <div class="container mt-5">
            <div class="form-container">


                                <label for="auto">Auto:</label>
                                <input class="form-control" list="autos" id="auto" name="auto" placeholder="Selecciona un auto" />
                                <datalist id="autos">
                                    <?php
                                    $selectauto = "SELECT marca, modelo, año FROM auto";
                                    $result = $con->query($selectauto);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['marca'] . ' ' . $row['modelo'] . ' ' . $row['año'] . '"></option>';
                                    }
                                    ?>
                                </datalist>    
                             

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
                <button type="submit" name="solicitar" class="btn btn-primary">Solicitar</button>
                <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['solicitar'])) {
                $auto = "Select n_chasis from auto where concat(marca, ' ', modelo, ' ', año) = '".$_POST['auto']."'";
                $result = $con->query($auto);
                $row = $result->fetch_assoc();
                $fecha = $_POST['fecha'];
                $service ="Select id_service from servicios where nombre = '".$_POST['myservice']."'";
                $result = $con->query($service);
                $rowService = $result->fetch_assoc();
                $insertService = "INSERT INTO reciben (n_chasis, fecha, id_service, estado) VALUES ('".$row['n_chasis']."', '$fecha', '".$rowService['id_service']."', 'activo')";
                if ($con->query($insertService) === TRUE) {
                    echo "<p class='text-success'>Servicio solicitado con éxito.</p>";
                } else {
                    echo "<p class='text-danger'>Error al solicitar el servicio: " . $con->error . "</p>";
                }

            }
            ?>
            </div>
        </div>
    </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
