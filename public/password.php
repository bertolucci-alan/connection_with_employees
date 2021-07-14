<?php

require_once 'includes/header.php';
require_once '../src/php/Funcionarios.php';




$funcionarios = new Funcionarios();



$connection = $funcionarios->__construct();


$sql = "SELECT * FROM funcionarios";

$funcionarios = [];


foreach ($connection->query($sql) as $key => $value) {
    //arra_push ->adicionando ao $funcionarios passando o array e o produto:
    array_push($funcionarios, $value);
}
foreach ($funcionarios as $value) {
}

$idBase64 = base64_encode($value['id']);




?>


<div class="row">

    <div id="title">
        <h3 class="light">DEFINA UMA SENHA</h3>
    </div>

    <div id="passwordbox">

        <form action="../src/php/create.php?id=<?php echo $value['id']; ?>" method="POST">

            <div class="input-field" id="password">

                <label for="tpassword">Password</label>
                <input type="password" name="tpassword" id="tpassword">

            </div>

            <div id="buttonpass">

                <button id="password" class="btn" name="password">CONCLUIR REGISTRO</button>

            </div>

        </form>
    </div>


</div>






<?php

require_once 'includes/footer.php';
?>