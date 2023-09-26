<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Global Way</title>
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

        $id = $_GET['id'];
        $sql = "DELETE FROM Usuarios WHERE Cedula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        header("Location: index.php"); // Redirige a la página MantUsuarios.php después de eliminar el registro
        exit();
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
    ?>
</body>
</html>
