<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\Database\ConnectDB;
use ExemploCrud\Models\Fabricante;
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
}
