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
    <link rel="stylesheet" href="aautos.css">

</head>
<body>
    

    <div class="header-section">
        <h2>JuancitoMotores</h2>
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="../inicio1.php" class="text-white">Inicio</a> |
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'cliente'): ?>   
                <a href="servicios.php" class="text-white">Servicios</a>
                <a href="#" class="text-white">Mis autos</a> | 
            <?php endif; ?> 
            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'ventas'): ?>   
                <a href="aautos.php" class="text-white">Agregar vehiculo</a> |
                <a href="../insumos/insumos.php" class="text-white">Insumos</a> |
                <a href= "allusr/usuarios.php" class="text-white">Usuarios</a> |
            <?php endif; ?>
            <?php if (!isset($_SESSION['email'])): ?>
                <a class="text-white" href="registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="../inicio2.php" method="post" class="d-inline"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="text-white" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>
    <div class="container mt-5">
                <div class="form-container">
                     <form action="" method="post">
                       
                                <label for="myUsuario">Usuario:</label>
                                <input list="usuarios" id="myUsuario" name="myUsuario" placeholder="Selecciona un usuario" />
                                <datalist id="usuarios">
                                    <?php
                                    $selectUsuarios = "SELECT correo FROM usuario";
                                    $result = $con->query($selectUsuarios);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['correo'] . '"></option>';
                                    }
                                    ?>
                                </datalist><br><br>

               
                    <label for="num_chasis">Número de chasis:</label>
                    <input  type="text" name="num_chasis" id="num_chasis" required> <br> <br>
              

               
                    <label for="num_motor">Número de motor:</label>
                    <input  type="text" name="num_motor" id="num_motor" required> <br> <br>
             

                
                    <label for="marca">Marca:</label>
                    <input  type="text" name="marca" id="marca" required> <br> <br>
              

                
                    <label for="modelo">Modelo:</label>
                    <input  type="text" name="modelo" id="modelo" required> <br> <br>
               

             
                    <label for="año">Año:</label>
                    <input  type="number" name="año" id="año" min="1886" max="2100" required> <br> <br>
                

                    <label for="fecha_compra">Fecha de compra:</label>
                    <input  type="date" name="fecha_compra" id="fecha_compra" required> <br> <br>
                    <button type="submit">Enviar</button>
                </div>

    

                
            </form>
            </div>
            <br>
     <?php  
    $sel = "SELECT * FROM auto";    
    
$res = $con->query($sel);
if ($res->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Correo</th><th>numero de chasis</th><th>numero de motor</th><th>matricula</th><th>Marca</th><th>Modelo</th><th>Año</th><th>Fecha de compra</th><th>Estado de garantia</th><th>Persona que lo registro</th></tr>";
    while($fila = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["correo"] . "</td>";
        echo "<td>" . $fila["n_chasis"] . "</td>";
        echo "<td>" . $fila["n_motor"] . "</td>";
        echo "<td>" . $fila["matricula"] . "</td>";
        echo "<td>" . $fila["marca"] . "</td>";
        echo "<td>" . $fila["modelo"] . "</td>";
        echo "<td>" . $fila["año"] . "</td>";
        echo "<td>" . $fila["fecha_compra"] . "</td>";
        echo "<td>" . $fila["estado_g"] . "</td>";
        echo "<td>" . $fila["correo_of"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}
?>
            </div>
        </div>
                <?php
// Procesamiento del formulario de "Agregar autos"
if ($_SERVER["REQUEST_METHOD"] == 'POST') { 
    $num_chasis =$_POST['num_chasis'];
    $num_motor = $_POST['num_motor'];
    $marca = ($_POST['marca']);
    $modelo = $_POST['modelo'];
    $año = $_POST['año'];
    $correo = $_POST['myUsuario'];
    $fecha_compra = $_POST['fecha_compra'];

  
    // Validación mínima
    if (empty($num_chasis) || empty($num_motor) || empty($marca) || empty($modelo) || empty($año) || empty($correo) || empty($fecha_compra)) {
        echo '<div class="alert alert-danger">Por favor completa todos los campos obligatorios correctamente.</div>';
    } else {
        $sql = "INSERT INTO auto (n_chasis, n_motor, marca, modelo, año, correo, fecha_compra, correo_of) VALUES ('".$num_chasis."', '".$num_motor."', '".$marca."', '".$modelo."', '".$año."', '".$correo."', '".$fecha_compra."','".$_SESSION['email']."')";
        if ($res = $con->query($sql) == TRUE) {
           echo '<div class="alert alert-success">Vehículo agregado exitosamente.</div>';
            }
             else {
                echo '<div class="alert alert-danger">Error al agregar el vehículo:</div>';
            }
        }
    }
?>    



    <br>         
              
            </form>

        </div>
    </div>
    <br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
