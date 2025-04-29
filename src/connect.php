<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "vendas";

try {
  $connect = new PDO(
    "mysql:host=$servidor;dbname=$dbname;charset=utf8",
    $usuario,
    $senha
  );

  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $error) {
  die("Erro: " . $error->getMessage());
}
