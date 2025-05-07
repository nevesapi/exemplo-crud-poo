<?php

namespace ExemploCrud\Services;

use Exception;
use ExemploCrud\ConnectDB;
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
}
