<?php

function formatarPreco(float $valor): string
{

  $precoFormatado = "R$ " . number_format($valor, 2, ",", ".");
  return $precoFormatado;
};

$calcularTotal = function (float $valor, int $quantidade): string {

  $calculaTotal = $valor * $quantidade;
  $calculaTotalFormatado = formatarPreco($calculaTotal);
  return $calculaTotalFormatado;
};
