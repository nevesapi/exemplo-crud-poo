<?php
require_once "connect.php";

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
