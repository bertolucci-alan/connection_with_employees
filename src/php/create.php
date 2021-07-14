<?php
require_once 'Funcionarios.php';

$funcionarios = new Funcionarios();


echo $funcionarios->create();
echo $funcionarios->createPassword();