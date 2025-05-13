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
}
