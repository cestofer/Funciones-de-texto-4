<?php

function obtenerIniciales(string $nombre): string {
    $nombreLimpio = trim($nombre);
    if (strlen($nombreLimpio) < 3) {
        return strtoupper($nombreLimpio);
    }
    return strtoupper(substr($nombreLimpio, 0, 3));
}

function obtenerAnio(string $fecha): string {
    $fechaLimpia = trim($fecha);
    if (strlen($fechaLimpia) < 4) {
        return "";
    }
    return substr($fechaLimpia, 2, 2);
}

function obtenerMesDia(string $fecha): string {
    $fechaLimpia = trim($fecha);
    if (strlen($fechaLimpia) < 10) {
        return "";
    }
    $mes = substr($fechaLimpia, 5, 2);
    $dia = substr($fechaLimpia, 8, 2);
    return $mes . $dia;
}

function generarClave(string $nombre, string $fecha): string {
    $iniciales = obtenerIniciales($nombre);
    $anio = obtenerAnio($fecha);
    $mesDia = obtenerMesDia($fecha);

    return $iniciales . $anio . $mesDia;
}


if (php_sapi_name() === 'cli') {
    echo "Nombre completo del estudiante: ";
    $nombre = trim(fgets(STDIN));

    echo "Fecha de nacimiento (AAAA-MM-DD): ";
    $fecha = trim(fgets(STDIN));

    echo "Clave generada: " . generarClave($nombre, $fecha) . PHP_EOL;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1 - Generador de clave</title>
    </head>
    <body>
        <h2>Generador de clave de identificación</h2>
        <form method="POST" action="">
            <label>Nombre completo del estudiante:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>Fecha de nacimiento (AAAA-MM-DD):</label><br>
            <input type="text" name="fecha" placeholder="AAAA-MM-DD" required><br><br>

            <button type="submit">Generar clave</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            echo "<h3>Resultado: " . generarClave($nombre, $fecha) . "</h3>";
        }
        ?>
    </body>
    </html>
    <?php
}