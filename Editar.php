<?php
$serverName = "tiusr21pl.cuc-carrera-ti.ac.cr\\MSSQLSERVER2019";
$connectionOptions = array(
    "Database" => "julianrm",
    "Uid" => "julian",
    "PWD" => "julian#123456"
);

$Cedula = "";
$Nombre = "";
$PApellido = "";
$SApellido = "";
$Email = "";
$Telefono = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: crud100/index.php");
        exit;
    }
    $id = $_GET['id'];

    try {
        $conn = new PDO("sqlsrv:Server=$serverName;Database={$connectionOptions['Database']}", $connectionOptions['Uid'], $connectionOptions['PWD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE cedula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            header("location: crud_julianrm/index.php");
            exit;
        }

        $Cedula = $row["Cedula"];
        $Nombre = $row["Nombre"];
        $PApellido = $row["PApellido"];
        $SApellido = $row["SApellido"];
        $Email = $row["Email"];
        $Telefono = $row["Telefono"];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $Cedula = $_POST["cedula"];
    $Nombre = $_POST["nombre"];
    $PApellido = $_POST["Papellido"];
    $SApellido = $_POST["Sapellido"];
    $Email = $_POST["email"];
    $Telefono = $_POST["telefono"];

    try {
        $conn = new PDO("sqlsrv:Server=$serverName;Database={$connectionOptions['Database']}", $connectionOptions['Uid'], $connectionOptions['PWD']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE usuarios SET Nombre=?, PApellido=?, SApellido=?, Email=?, Telefono=? WHERE Cedula=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$Nombre, $PApellido, $SApellido, $Email, $Telefono, $Cedula]);

            header("Location: index.php");
            exit();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CRUD</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
</head>

<body>

    <div class="navbar-fixed">
        <nav class="grey darken-4">
            <div class="nav-wrapper">
                &nbsp;&nbsp;<a href="index.php" class="brand-logo">CRUD</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    
                </ul>
            </div>
        </nav>
    </div>

    <div class="section container">
        <div class="row">
            <form class="col s12" method="post">
                <div class="row card panel">
                    <div class="input-field col s6">
                        <input type="number" name="cedula" id="id" readonly value="<?php echo $Cedula; ?>">
                        <label for="id">Cedula</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="nombre" id="nombre" class="validate" required value="<?php echo $Nombre; ?>">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="Papellido" id="Papellido" class="validate" required value="<?php echo $PApellido; ?>">
                        <label for="Papellido">Primer Apellido</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="Sapellido" id="Sapellido" class="validate" required value="<?php echo $SApellido; ?>">
                        <label for="Sapellido">Segundo Apellido</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="email" id="email" class="validate" required value="<?php echo $Email;?>">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="telefono" id="telefono" class="validate" required value="<?php echo $Telefono; ?>">
                        <label for="telefono">Telefono</label>
                    </div>
                    <br>
                    <br>
                    <br>
                    &nbsp;&nbsp;<button class="btn" type="submit">Guardar</button>
                    <br>
                    <br>
                </div>
            </form>
        </div>
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

