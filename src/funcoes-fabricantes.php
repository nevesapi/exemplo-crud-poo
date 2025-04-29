<?php
require_once "connect.php";

//listando todos os fabricantes
function listarFabricantes(PDO $connect): array
{
  $sql = "SELECT * FROM fabricantes ORDER BY nome";

  try {
    $query = $connect->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $erro) {
    die("Erro ao listar fabricantes: " . $erro->getMessage());
  }
}

//inserindo novo fabricante
function inserirFabricante(PDO $connect, string $nomeFabrincante): void
{
  $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

  try {

    $query = $connect->prepare($sql);
    $query->bindValue(":nome", $nomeFabrincante, PDO::PARAM_STR);
    $query->execute();
  } catch (Exception $erro) {
    die("Erro ao cadastrar fabricante: " . $erro->getMessage());
  }
}

//carregando um único fabricante com base no id
function carregarFabricante(PDO $connect, int $idFabricante): array
{
  $sql = "SELECT * FROM fabricantes WHERE id = :id";

  try {

    $query = $connect->prepare($sql);
    $query->bindValue(":id", $idFabricante, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $erro) {
    die("Erro ao carregar fabricante: " . $erro->getMessage());
  }
}

//atualizando nome do fabricante
function atualizaFabricante(PDO $connect, string $nome, int $idFabricante): void
{

  $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
  try {
    $query = $connect->prepare($sql);
    $query->bindValue(":nome", $nome, PDO::PARAM_STR);
    $query->bindValue(":id", $idFabricante, PDO::PARAM_INT);

    $query->execute();
  } catch (Exception $erro) {
    die("Erro ao atualizar nome do fabricante: " . $erro->getMessage());
  }
}

//deletando fabricante
function excluirFabricante(PDO $connect, int $idFabricante): void
{
  $sql = "DELETE FROM fabricantes WHERE id = :id";

  try {
    $query = $connect->prepare($sql);
    $query->bindValue(":id", $idFabricante, PDO::PARAM_INT);

    $query->execute();
  } catch (Exception $erro) {
    die("Erro ao excluir fabricante: " . $erro->getMessage());
  }
}
