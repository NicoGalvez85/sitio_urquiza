<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Buscar Usuario</title>
</head>
<body>
<?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje" class="alert alert-warning text-center">
                <h2>' . $_GET['mensaje'] . '</h2></div>';
        }
        ?>
    <h1>Modificar Usuario</h1>
    <form action="update.php" method="post">
        <label for="cuil">CUIL:</label>
        <input type="text" name="cuil" required>
        <input type="submit" value="Buscar">
    </form>
</body>
</html>
