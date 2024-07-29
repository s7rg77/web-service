<?php

require_once 'Libros.php';

function get_listado_autores()
{
    $libros = new Libros();
    $mysqli = $libros->conexion("...", "...", "...", "...");
    if ($mysqli) {
        $lista_autores = $libros->consultarAutores($mysqli, $id);
        $libros->closeConnection();
        return $lista_autores;
    }
}

function get_datos_autor($id)
{
    $libros = new Libros();
    $mysqli = $libros->conexion("...", "...", "...", "...");
    if ($mysqli) {
        $info_autor = $libros->consultarDatosLibro($mysqli, $id);
        $info_autor->datos = $libros->consultarAutores($mysqli, $id);
        $info_autor->libros = $libros->consultarLibros($mysqli, $id);
        $libros->closeConnection();
        return $info_autor;
    }
}

function get_listado_libros()
{
    $libros = new Libros();
    $mysqli = $libros->conexion("...", "...", "...", "...");
    if ($mysqli) {
        $lista_libros = $libros->consultarLibros($mysqli, "");
        $libros->closeConnection();
        return $lista_libros;
    }
}

function get_datos_libro($id)
{
    $libros = new Libros();
    $mysqli = $libros->conexion("...", "...", "...", "...");
    if ($mysqli) {
        $info_libro = $libros->consultarDatosLibro($mysqli, $id);
        $info_libro->datos = $libros->consultarAutores($mysqli, $info_libro->id_autor);
        $libros->closeConnection();
        return $info_libro;
    }
}

$posibles_URL = array("get_listado_autores", "get_datos_autor", "get_listado_libros", "get_datos_libro");
$valor = "Ha ocurrido un error";
if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL)) {
    switch ($_GET["action"]) {
        case "get_listado_autores":
            $valor = get_listado_autores();
            break;
        case "get_datos_autor":
            if (isset($_GET["id"])) {
                $valor = get_datos_autor($_GET["id"]);
            }
            break;
        case "get_listado_libros":
            $valor = get_listado_libros();
            break;
        case "get_datos_libro":
            if (isset($_GET["id"])) {
                $valor = get_datos_libro($_GET["id"]);
            }
            break;
    }
}

exit(json_encode($valor));

?>