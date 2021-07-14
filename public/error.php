<?php
require_once './includes/header.php';
require_once '../src/php/Funcionarios.php';

$funcionarios = new Funcionarios();

$connection = $funcionarios->__construct();

$sql = "SELECT * FROM funcionarios WHERE id = ?";

$prepare = $connection->prepare($sql);

$prepare->bindParam(1, $_GET['id']);

$prepare->execute();

$infoUser = $prepare->fetch();

$nameUser = mb_strtoupper($infoUser['name']);

?>


<div class="row">

    <div id="title">

        <h3 class="light">OPS :(</h3>

    </div>

    <div id="wellcome">

        <h4 class="light"><br>AINDA RESOLVENDO ALGUNS ERROS DA APLICAÇÃO!</h4>
    </div>

    <div id="wellcome">
        <h4 class="light"><br>ME PERDOE POR ISSO <?php echo $nameUser; ?></h4>
    </div>


    <div id="buttons">
        <a href="wellcome.php?id=<?php echo $infoUser['id']; ?>" class="btn" id="returnIndex">RETORNAR AOS
            REGISTROS</a>
        <a href="index.php" class="btn" name="returnIndex" id="returnIndex">RETORNAR AO LOGIN</a>
    </div>

</div>

<?php
require_once './includes/footer.php';
?>