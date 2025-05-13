<?php

namespace ExemploCrud\Services;

use ExemploCrud\Database\ConnectDB;
use ExemploCrud\Models\Fabricante;
use Exception;
use PDO;
use Throwable;

final class FabricanteServico
{
  private PDO $connect;

  public function __construct()
  {
    $this->connect = ConnectDB::getConnect();
  }

  public function listarTodos(): array
  {
    $sql = "SELECT * FROM fabricantes ORDER BY nome";
    try {
      $query = $this->connect->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $erro) {
      throw new Exception("Erro ao listar fabricantes: " . $erro->getMessage());
    }
  }

  public function inserir(Fabricante $fabricante): void
  {
    $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
      $query->execute();
    } catch (Throwable $erro) {
      throw new Exception("Erro ao cadastrar fabricante: " . $erro->getMessage());
    }
  }

  public function buscarPorId(int $id): ?array
  {
    $sql = "SELECT * FROM fabricantes WHERE id = :id";

    try {

      $query = $this->connect->prepare($sql);
      $query->bindValue(":id", $id, PDO::PARAM_INT);
      $query->execute();

      $result = $query->fetch(PDO::FETCH_ASSOC);

      return $result ? $result : null;
    } catch (Throwable $erro) {
      throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
    }
  }

  public function atualizar(Fabricante $fabricante): void
  {
    $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
      $query->bindValue(":id", $fabricante->getId(), PDO::PARAM_INT);

      $query->execute();
    } catch (Throwable $erro) {
      throw new Exception("Erro ao atualizar nome do fabricante: " . $erro->getMessage());
    }
  }

  public function excluir(int $id): void
  {
    $sql = "DELETE FROM fabricantes WHERE id = :id";

    try {
      $query = $this->connect->prepare($sql);
      $query->bindValue(":id", $id, PDO::PARAM_INT);

      $query->execute();
    } catch (Throwable $erro) {
      throw new Exception("Erro ao excluir fabricante: " . $erro->getMessage());
    }
  }
}
