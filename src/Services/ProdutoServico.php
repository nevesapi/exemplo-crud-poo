<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\ConnectDB;
use PDO;
use Throwable;

final class ProdutoServico
{
  private PDO $connect;

  public function __construct()
  {
    $this->connect = ConnectDB::getConnect();
  }
  function listarTodos(): array
  {
    // $sql = "SELECT * FROM produtos";
    $sql = "SELECT 
    produtos.id, 
    produtos.nome AS produto, 
    produtos.preco, 
    produtos.quantidade, 
    fabricantes.nome AS fabricante
    FROM produtos
    JOIN fabricantes
    ON produtos.fabricante_id = fabricantes.id
    ORDER BY produto";

    try {
      $query = $this->connect->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $err) {
      throw new Exception("Erro ao listar produtos: " . $err->getMessage());
    }
  }
}
