<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
</head>

<body>
    <?php
    $serverName = "tiusr21pl.cuc-carrera-ti.ac.cr\MSSQLSERVER2019";
    $connectionOptions = array(
        "Database" => "julianrm",
        "Uid" => "julian",
        "PWD" => "julian#123456"
    );

    try {
        $conn = new PDO("sqlsrv:Server=$serverName;Database={$connectionOptions['Database']}", $connectionOptions['Uid'], $connectionOptions['PWD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios";
        $stmt = $conn->query($sql);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
    ?>

    <div class="navbar-fixed">
        <nav class="grey darken-4">
            <div class="nav-wrapper">
                &nbsp;&nbsp;<a href="index.php" class="brand-logo">CRUD</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <br>
    <br>
    
    <br>
    <br>
    <div class="container">
    <a href="Agregar.php?id=<?= $row['Cedula'] ?>" class="btn btn-primary">Agregar</a>
    <br>
    <br>
        <table class="table table-bordered" id="tablaDatos">
            <thead>
                <tr>
                    <th class="text-center">Cedula</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Primer Apellido</th>
                    <th class="text-center">Segundo Apellido</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="tbodys">
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td class="text-center"><?= $row['Cedula'] ?></td>
                        <td class="text-center"><?= $row['Nombre'] ?></td>
                        <td class="text-center"><?= $row['PApellido'] ?></td>
                        <td class="text-center"><?= $row['SApellido'] ?></td>
                        <td class="text-center"><?= $row['Email'] ?></td>
                        <td class="text-center"><?= $row['Telefono'] ?></td>
                        <td class="text-center">
                            <a href="Editar.php?id=<?= $row['Cedula'] ?>" class="btn btn-primary">Editar</a>
                            <a href="Eliminar.php?id=<?= $row['Cedula'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Navegation Menu
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);

            // Slider
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems, {
                indicators: false,
                height: 500,
                duration: 500,
                interval: 3000
            });
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems);
        });
    </script>
</body>
</html>
