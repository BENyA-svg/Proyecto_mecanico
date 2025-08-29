

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="formulario.css">
</head>


    <div class="header-section">
        <h2>JuancitoMotores</h2>
       
        <p>Tu mejor opción para vehículos y servicios automotrices.</p>
        <nav>
            <a href="inicio1.php" class="text-white">Inicio</a> | 
            <a href="servicios.php" class="text-white">Servicios</a> | 
         <?php if (isset($_COOKIE['perfil'])): ?>   
          <?php if ($_COOKIE['perfil'] == 'admin'): ?>   
            <a href="aautos.php" class="text-white">Agregar vehiculo</a> | 
            <?php endif; ?>
            <?php endif; ?> 
            <?php if (!isset($_COOKIE['email'])): ?>
                <a class="text-white" href="registro.php">Iniciar sesión</a>
            <?php else: ?>
                <form action="inicio2.php" method="post"> 
                    <input type="hidden" name="cerrar" value="1">
                    <button class="text-white" type="submit">Cerrar sesión</button>
                </form>
            <?php endif; ?>
        </nav>
    </div>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li><a class="navbar-brand" href="inicio1.php">JuancitoMotores</a></li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li>
                        <form action="inicio2.php" method="post">
                            <input type="hidden" name="color" value="1">
                            <button class="btn btn-outline-success" type="submit">color</button>
                        </form>
                    </li>
                    <?php if (!isset($_COOKIE['email'])): ?>
                        <a class="text-white" href="registro.php">Iniciar sesión</a>
                    <?php else: ?>
                        <form action="inicio2.php" method="post">
                            <input type="hidden" name="cerrar" value="1">
                            <button class="btn btn-outline-danger" type="submit">Cerrar sesión</button>
                        </form>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <br>
    </nav>
    
    <div class="container mt-5">
        <div class="form-container">
            <h3 class="form-title">Formulario de Registro</h3>
            <form action="procesar_registro.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <select class="form-control" name="marca" id="marca">
                        <option value="toyota">Toyota</option>
                        <option value="ford">Ford</option>
                        <option value="chevrolet">Chevrolet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" name="modelo" id="modelo" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha preferida:</label>
                    <input type="datetime-local" class="form-control" name="fecha" id="fecha">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
