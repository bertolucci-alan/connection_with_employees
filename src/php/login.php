<?php
require_once 'Funcionarios.php';
require_once 'message.php';

$funcionarios = new Funcionarios();

echo $funcionarios->login();