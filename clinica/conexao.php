<?php

$host = "localhost";
$banco = "clinica";
$usuario = "root";
$senha = "";

$conexao = new PDO(
    "mysql:host=$host;dbname=$banco;charset=utf8mb4",
    $usuario,
    $senha
);

$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
