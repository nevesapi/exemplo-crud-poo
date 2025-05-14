<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\ConnectDB;
use ExemploCrud\Models\Produto;
use PDO;
use Throwable;

final class ProdutoServico
{
  private PDO $connect;

  public function __construct()
  {
    $this->connect = ConnectDB::getConnect();
  }

  public function listarTodos(): array
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

  public function inserir(Produto $produto): void
  {
    $sql = "INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) 
    VALUES(:nome, :preco, :quantidade, :fabricanteId, :descricao)";

    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
      $query->bindValue(":preco", $produto->getPreco(), PDO::PARAM_STR);
      $query->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_INT);
      $query->bindValue(":fabricanteId", $produto->getFabricanteId(), PDO::PARAM_INT);
      $query->bindValue(":descricao", $produto->getDescricao(), PDO::PARAM_STR);

      $query->execute();
    } catch (Throwable $erro) {
      throw new Exception("Erro ao cadastrar produto: " . $erro->getMessage());
    }
  }

  public function buscarPorId(int $id): array
  {
    $sql = "SELECT * FROM produtos WHERE id = :idProduto";

    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":idProduto", $id, PDO::PARAM_INT);

      $query->execute();

      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
      die("Erro ao cadastrar produto: " . $erro->getMessage());
    }
  }

  function atualizarProduto(Produto $produto): void
  {

    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade, fabricante_id = :fabricante_id, descricao = :descricao WHERE id = :id";

    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
      $query->bindValue(":preco", $produto->getPreco(), PDO::PARAM_STR);
      $query->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_INT);
      $query->bindValue(":fabricante_id", $produto->getFabricanteId(), PDO::PARAM_INT);
      $query->bindValue(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
      $query->bindValue(":id", $produto->getId(), PDO::PARAM_INT);
      $query->execute();
    } catch (Throwable $erro) {
      throw new Exception("Erro ao atualizar produto: " . $erro->getMessage());
    }
  }
}
