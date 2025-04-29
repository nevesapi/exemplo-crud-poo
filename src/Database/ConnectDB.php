<?php

namespace ExemploCrud;

use Exception;
use PDO;
use Throwable;

abstract class ConnectDB
{
  private static PDO $connect;
  private static string $servidor = "localhost";
  private static string $usuario = "root";
  private static string $senha = "";
  private static string $dbname = "vendas";

  public static function getConnect(): PDO
  {
    if (!isset(self::$connect)) {
      try {
        self::$connect = new PDO(
          "mysql:host=" . self::$servidor . ";dbname=" . self::$dbname . ";charset=utf8",
          self::$usuario,
          self::$senha
        );

        self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (Throwable $error) {

        throw new Exception("Erro ao conectar ao banco de dados!");
      }
    }
    return self::$connect;
  }
}
