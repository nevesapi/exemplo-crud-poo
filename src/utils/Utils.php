<?php

namespace ExemploCrud\Utils;

final class Utils
{
  private function __construct() {}

  public static function dump($dados): void
  {
    echo "<pre>";
    var_dump($dados);
    echo "</pre>";
  }

  public static function formatarPreco(float $valor): string
  {
    $precoFormatado = "R$ " . number_format($valor, 2, ",", ".");
    return $precoFormatado;
  }

  public static function calcularTotal(float $valor, int $quantidade): string
  {
    $calculaTotal = $valor * $quantidade;
    $calculaTotalFormatado = self::formatarPreco($calculaTotal);

    return $calculaTotalFormatado;
  }
}
