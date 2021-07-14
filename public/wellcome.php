<?php
//require_once '../src/php/message.php';
require_once 'includes/header.php';
require_once '../src/php/Funcionarios.php';


$funcionarios = new Funcionarios();

$connection = $funcionarios->__construct();

$id = $_GET['id'];

$sql = "SELECT * FROM funcionarios WHERE id = ?";

$prepare = $connection->prepare($sql);

$prepare->bindParam(1, $id);

$prepare->execute();

$info = $prepare->fetch();

$name = $info['name'];

?>

<div class="row">

    <div id="title">

        <h3 class="light">USUÁRIOS CONECTADOS</h3>

    </div>

    <div id="wellcome">

        <h2 class="light">OLÁ <?php echo mb_strtoupper($name); ?>!! </h2>

        <div id="buttons">
            <a href="index.php" class="btn" id="returnIndex">RETORNAR À TELA DE CADASTRO</a>
        </div>


    </div>
</div>

<?php

$sqlAll = "SELECT * FROM funcionarios";

$result = $connection->prepare($sqlAll);

$result->execute();

while ($row_result = $result->fetch()) {

    $nameUpper = mb_strtoupper($row_result['name']);

    $surnameUpper = strtoupper($row_result['surname']);

?>

<table>
    <thead>
        <tr>
            <th>NOME</th>
            <th>SOBRENOME</th>
            <th>IDADE</th>
            <th>E-MAIL</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td><?php echo $nameUpper; ?></td>
            <td><?php echo $surnameUpper; ?></td>
            <td><?php echo $row_result['age'];; ?></td>
            <td><?php echo $row_result['email'];; ?></td>
        </tr>
    </tbody>
</table>
<div>
    <div id=buttonsUser>

        <a href="../src/php/getIdForEmail.php?id=<?php echo $info['id']; ?>&id2=<?php echo $row_result['id']; ?>"
            class="btn-floating" id="email"><i class="material-icons">email</i></a>

        <a href="screenEdit.php?id=<?php echo $row_result['id']; ?>" class="btn-floating" id="edit"><i
                class="material-icons">edit</i></a>

        <a href="#modal<?php echo $row_result['id']; ?>" id="delete" class="btn-floating modal-trigger"><i
                class="material-icons">delete</i></a>

        <hr width="700px">
    </div>

    <!---------------- Modal Structure ------------->
    <div id="modal<?php echo $row_result['id']; ?>" class="modal">

        <div class="modal-content">

            <h5>ATENÇÂO!</h5>
            <p>A operação removerá o registro permanentemente.<br>
                Caso remover seu próprio registro, será redirecionado à página de cadastro!<br>
                Deseja continuar?</p>
        </div>

        <div class="modal-footer">

            <form action="../src/php/delete.php?id=<?php echo $info['id']; ?>&id2=<?php echo $row_result['id']; ?>"
                method="POST">

                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">


                <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="cancel">Cancelar</a></td>

                <button type="submit" name="delete" class="btn black" id="btndelete">Deletar</button>


            </form>
        </div>
    </div>
</div>

<?php
}

require_once 'includes/footer.php';
?>