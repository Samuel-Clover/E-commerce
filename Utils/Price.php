<?php

namespace App\Utils;

use NumberFormatter;

class Price
{
  public static function formatForBRLCurrency(string $price)
  {
    $numberFormatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
    $formattedPrice = $numberFormatter->format($price);

    return $formattedPrice;
  }
}
