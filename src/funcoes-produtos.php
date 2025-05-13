<?php
require_once "connect.php";

function inserirProduto(PDO $connect, string $nomeProduto,  float $preco, int $quantidade, int $fabricanteId, string $descricao): void
{
  $sql = "INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) 
    VALUES(:nome, :preco, :quantidade, :fabricanteId, :descricao)";

  try {
    $query = $connect->prepare($sql);
    $query->bindValue(":nome", $nomeProduto, PDO::PARAM_STR);
    $query->bindValue(":preco", $preco, PDO::PARAM_STR);
    $query->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
    $query->bindValue(":fabricanteId", $fabricanteId, PDO::PARAM_INT);
    $query->bindValue(":descricao", $descricao, PDO::PARAM_STR);

    $query->execute();
  } catch (Exception $erro) {
    die("Erro ao cadastrar produto: " . $erro->getMessage());
  }
}

function carregarUmProduto(PDO $connect, int $idProduto): array
{
  $sql = "SELECT * FROM produtos WHERE id = :idProduto";

  try {
    $query = $connect->prepare($sql);
    $query->bindValue(":idProduto", $idProduto, PDO::PARAM_INT);

    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $erro) {
    die("Erro ao cadastrar produto: " . $erro->getMessage());
  }
}
