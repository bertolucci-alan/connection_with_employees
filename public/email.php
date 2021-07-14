<?php

require_once 'includes/header.php';
require_once '../src/php/Funcionarios.php';

$funcionarios = new Funcionarios();

$connection = $funcionarios->__construct();

//--------USER------//
$idUser = $_GET['id'];

$sql = "SELECT * FROM funcionarios WHERE id = ?";

$prepare = $connection->prepare($sql);

$prepare->bindParam(1, $idUser);

$prepare->execute();

$User = $prepare->fetch();

$nameUpper = mb_strtoupper($User['name']);

//----USEREMAIL----//
$idUserEmail = $_GET['id2'];

$sql = "SELECT * FROM funcionarios WHERE id = ?";

$prepare = $connection->prepare($sql);

$prepare->bindParam(1, $idUserEmail);

$prepare->execute();

$UserEmail = $prepare->fetch();

$nameEmailUpper = mb_strtoupper($UserEmail['name']);
?>

<div class="row">

    <div id="title">

        <h3 class="light">ENVIAR E-MAIL PARA <?php echo $nameEmailUpper; ?> </h3>

    </div>

    <div id="wellcome">

        <h4 class="light"><br>SUAS INFORMAÇÕES, <?php echo $nameUpper; ?>:</h4>
    </div>

    <div id="formEmail">

        <form action="../src/php/sendEmail.php?id=<?php echo $User['id']; ?>&id2=<?php echo $UserEmail['id']; ?>"
            method="POST">

            <div class="input-field" id="name">
                <label for="nameUser">Nome</label>
                <input type="text" name="nameUser" id="nameUser" value="<?php echo $User['name']; ?>" disabled="">
            </div>

            <div class="input-field" id="email">
                <label for="emailUser">E-mail</label>
                <input type="email" name="emailUser" id="emailUser" value="<?php echo $User['email']; ?>" disabled="">
            </div>

            <div id="wellcome">
                <h4 class="light"><br>INFORMAÇÕES DE <?php echo $nameEmailUpper ?>:</h4>
            </div>

            <div class="input-field" id="name">
                <label for="nameUserEmail">Nome</label>
                <input type="text" name="nameUserEmail" id="nameUserEmail" value="<?php echo $UserEmail['name']; ?>"
                    disabled="">
            </div>

            <div class="input-field" id="email">
                <label for="emailUserEmail">E-mail</label>
                <input type="email" name="emailUserEmail" id="emailUserEmail" value="<?php echo $UserEmail['email']; ?>"
                    disabled="">
            </div>

            <div id="textEmail">

                <textarea name="textEmail" id="textEmail" placeholder="Digite aqui sua mensagem..."></textarea>
            </div>

            <div id="buttons">
                <a href="wellcome.php?id=<?php echo $User['id']; ?>" class="btn" id="returnIndex">RETORNAR AOS
                    REGISTROS</a>
                <button type="submit" class="btn" name="send" id="send">ENVIAR EMAIL</button>
            </div>

        </form>
    </div>







</div>






<?php
require_once 'includes/footer.php';
?>