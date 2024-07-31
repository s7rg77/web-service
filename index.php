<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web service</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background-color: lavender;
            font-family: monospace;
            font-size: 16px;
        }

        h1,
        h2 {
            margin-left: 10px;
            color: rebeccapurple;
            font-weight: normal;
        }

        #head {
            margin-top: 10px;
            margin-right: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .home,
        .doc,
        .git {
            margin-left: 10px;
            width: 100px;
        }

        p {
            margin-left: 10px;
        }

        ul {
            margin-bottom: 50px;
            padding: 0;
            list-style-type: none;
        }

        button {
            margin-left: 10px;
            margin-bottom: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: mediumpurple;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: rebeccapurple;
        }

        input {
            padding: 5px;
            width: 25px;
        }

        footer {
            bottom: 0px;
            width: 100%;
            background-color: mediumpurple;
            color: white;
            text-align: center;
            position: fixed;
        }
    </style>
    <script>
        function goHome() {

            window.location.href = '/';

        }

        function goGit() {

            window.location.href = 'https://github.com/s7rg77/web-service';

        }

        function goDoc() {

            window.location.href = '/doc';
            
        }
    </script>
</head>

<body>
    <div id="head">
        <button class="doc" onclick="goDoc()">doc</button>
        <button class="git" onclick="goGit()">git</button>
        <button class="home" onclick="goHome()">back</button>
    </div>
<h1>web service</h1>
<h2>sergio lópez</h2>

<?php
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") {
    $app_info = file_get_contents('http://s7rg77.com/dwes/dwes07/api.php?action=get_datos_autor&id=' . $_GET["id"]);
    $app_info = json_decode($app_info);
    ?>
    <h2>autor:</h2>
        <p>
            <td>nombre: </td><td> <?php echo $app_info->datos->nombre ?></td>
        </p>
        <p>
            <td>apellidos: </td><td> <?php echo $app_info->datos->apellidos ?></td>
        </p>
        <p>
            <td>nacionalidad: </td><td> <?php echo $app_info->datos->nacionalidad ?></td>
        </p>
        <ul>
            <?php foreach ($app_info->libros as $libro): ?>
                <li>
                    <button onclick="window.location.href='<?php echo 'http://s7rg77.com/dwes/dwes07/index.php?action=get_datos_libro&id=' . $libro->id ?>'">
                        <?php echo $libro->titulo; ?>
                    </button>
                </li>
            <?php endforeach;?>
        </ul>
        <section>
        <button onclick="window.location.href='http://s7rg77.com/dwes/dwes07/index.php?action=get_listado_autores'" alt="lista de autores">
            volver a la lista de autores
        </button>
        </section>
    <?php
} elseif (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") {
    $id_libro = $_GET["id"];
    if ($id_libro !== null && $id_libro !== '') {
        $app_info = file_get_contents('http://s7rg77.com/dwes/dwes07/api.php?action=get_datos_libro&id=' . $id_libro);
        $app_info = json_decode($app_info);
        if ($app_info !== null) {
            ?>
            <h2>libro:</h2>
                <p>
                    <td>título: </td><td> <?php echo $app_info->titulo ?></td>
                </p>
                <p>
                    <td>fecha de publicación: </td><td> <?php echo $app_info->f_publicacion ?></td>
                </p>
                <p>
                    <td>autor: </td><td>
                        <button onclick="window.location.href='<?php echo 'http://s7rg77.com/dwes/dwes07/index.php?action=get_datos_autor&id=' . $app_info->datos->id ?>'">
                            <?php echo $app_info->datos->nombre . " " . $app_info->datos->apellidos ?>
                        </button>
                    </td>
                </p>
    <?php
} else {
            echo "<p>el libro con id " . $id_libro . " no existe</p>";
        }
    } else {
        echo "<p>id de libro no válida</p>";
    }
    ?>
    <section>
        <button onclick="window.location.href='http://s7rg77.com/dwes/dwes07/index.php?action=get_listado_autores'" alt="lista de autores">
            volver a la lista de autores
        </button>
    </section>
    <?php
} elseif (isset($_GET["action"]) && $_GET["action"] == "get_listado_libros") {
    $lista_libros = file_get_contents('http://s7rg77.com/dwes/dwes07/api.php?action=get_listado_libros');
    $lista_libros = json_decode($lista_libros);
    ?>
    <h2>lista de libros:</h2>
        <ul>
            <?php foreach ($lista_libros as $libro): ?>
                <li>
                    <button onclick="window.location.href='<?php echo 'http://s7rg77.com/dwes/dwes07/index.php?action=get_datos_libro&id=' . $libro->id ?>'">
                        <?php echo $libro->titulo; ?>
                    </button>
                </li>
            <?php endforeach;?>
        </ul>
        <section>
        <button onclick="window.location.href='http://s7rg77.com/dwes/dwes07/index.php?action=get_listado_autores'" alt="lista de autores">
            volver a la lista de autores
        </button>
        </section>
    <?php
} else {
    $lista_autores = file_get_contents("http://s7rg77.com/dwes/dwes07/api.php?action=get_listado_autores");
    $lista_autores = json_decode($lista_autores);
    ?>
    <h2>lista de autores:</h2>
        <ul>
            <?php foreach ($lista_autores as $autores): ?>
                <li>
                    <button onclick="window.location.href='<?php echo 'http://s7rg77.com/dwes/dwes07/index.php?action=get_datos_autor&id=' . $autores->id ?>'">
                        <?php echo $autores->nombre . " " . $autores->apellidos ?>
                    </button>
                </li>
            <?php endforeach;?>
        </ul>
        <section>
        <button onclick="window.location.href='http://s7rg77.com/dwes/dwes07/index.php?action=get_listado_libros'" alt="lista de libros">
            ver lista de libros
        </button>
        <form action="" method="get">
            <button type="submit">introduce id libro (0-6)</button>
            <input type="number" id="libro_id" name="id" min="0" step="1" required>
            <input type="hidden" name="action" value="get_datos_libro">
        </form>
        </section>
    <?php
}
?>
</body>

<footer>
    <h3>desarrollo web entorno servidor</h3>
</footer>

</html>