<?php

function limpiarNombre(string $nombre): string {
    $sinExtremos = trim($nombre);
    if (strlen($sinExtremos) === 0) {
        return "";
    }
    return str_replace(" ", "", $sinExtremos);
}

function convertirMinusculas(string $texto): string {
    $textoLimpio = trim($texto);
    if (strlen($textoLimpio) === 0) {
        return "";
    }
    return strtolower($textoLimpio);
}

function obtenerInstitucion(string $institucion): string {
    $instLimpia = strtolower(trim($institucion));
    if (strlen($instLimpia) < 2) {
        return $instLimpia;
    }
    return substr($instLimpia, 0, 2);
}

function obtenerAnio(string $anioIngreso): string {
    $anioLimpio = trim((string) $anioIngreso);
    if (strlen($anioLimpio) < 2) {
        return $anioLimpio;
    }
    return substr($anioLimpio, -2);
}

function generarUsuario(string $nombre, string $institucion, string $anioIngreso): string {
    $nombreSinEspacios = limpiarNombre($nombre);
    $nombreMinusculas = convertirMinusculas($nombreSinEspacios);
    $siglasInstitucion = obtenerInstitucion($institucion);
    $dosDigitosAnio = obtenerAnio($anioIngreso);

    $usuario = $nombreMinusculas . $siglasInstitucion . $dosDigitosAnio;
    return str_replace(" ", "", $usuario);
}


if (php_sapi_name() === 'cli') {
    echo "Nombre completo: ";
    $nombre = trim(fgets(STDIN));

    echo "Nombre de la institución educativa: ";
    $institucion = trim(fgets(STDIN));

    echo "Año de ingreso: ";
    $anio = trim(fgets(STDIN));

    echo "Nombre de usuario generado: " . generarUsuario($nombre, $institucion, $anio) . PHP_EOL;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2 - Generador de usuario</title>
    </head>
    <body>
        <h2>Generador de nombres de usuario</h2>
        <form method="POST" action="">
            <label>Nombre completo:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>Nombre de la institución educativa:</label><br>
            <input type="text" name="institucion" required><br><br>

            <label>Año de ingreso:</label><br>
            <input type="number" name="anio" required><br><br>

            <button type="submit">Generar usuario</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $institucion = $_POST['institucion'] ?? '';
            $anio = $_POST['anio'] ?? '';
            echo "<h3>Usuario generado: " . generarUsuario($nombre, $institucion, $anio) . "</h3>";
        }
        ?>
    </body>
    </html>
    <?php
}