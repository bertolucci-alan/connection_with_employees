<?php

require_once './includes/header.php';
require_once '../src/php/Funcionarios.php';
?>


<?php

$funcionarios = new Funcionarios();

$connection = $funcionarios->__construct();

$sql = "SELECT * FROM funcionarios WHERE id = ?";

$prepare = $connection->prepare($sql);

$prepare->bindParam(1, $_GET['id']);

$prepare->execute();

// $result = $connection->query($sql);

$info = $prepare->fetch();

$name = mb_strtoupper($info['name']);



?>

<div class="row">
    <div id="title">
        <h3 class="light">EDITAR REGISTROS DE <?php echo $name; ?></h3>

    </div>
    <div id="form">

        <form action="../src/php/update.php?id=<?php echo $info['id']; ?>" method="POST">

            <div class="input-field" id="name">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $info['name']; ?>">
            </div>

            <div class="input-field" id="surname">
                <label for="surname">Surname</label>
                <input type="text" name="surname" id="surname" value="<?php echo $info['surname']; ?>">
            </div>

            <div class="input-field" id="email">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $info['email']; ?>">
            </div>

            <div class="input-field" id="age">
                <label for="age">Age</label>
                <input type="text" name="age" id="age" value="<?php echo $info['age']; ?>">
            </div>

            <div id="buttons">
                <a href="wellcome.php?id=<?php echo $info['id']; ?>" class="btn" id="returnWellcome">VOLTAR</a>

                <button type="submit" id="update" name="update" class="btn">CONFIRMAR</button>



            </div>
        </form>
    </div>
</div>


<?php
require_once './includes/footer.php';
?>