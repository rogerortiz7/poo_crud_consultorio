<?php require_once("Components/Layout.php"); ?>

<body>
    <?php require_once("Components/Header.php"); ?>

    <main class="container text-center">

        <h2 class="text-center">Editar Consulta</h2>

        <form action='?action=update&id=<?php echo $data["student"]->getId() ?>' method="post">
            <input type="text" name="name" required value='<?php echo $data["student"]->getName() ?>'>
            <input type="submit" value="Editar">
            <input type="reset" value="Limpiar">
        </form>
    </main>

</body>