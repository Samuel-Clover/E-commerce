<?php

namespace App\Utils;

class Product
{
  public static function returnProductsWithFormattedPrice(array $products)
  {
    $productsCopy = $products;
    for ($i = 0; $i < count($products); $i++) {
      $originalPrice = $productsCopy[$i]['price'];
      $priceWithDiscount = $productsCopy[$i]['price_from'];
      $formattedOriginalPrice = Price::formatForBRLCurrency($originalPrice);
      $formattedPriceWithDiscount = Price::formatForBRLCurrency($priceWithDiscount);
      $productsCopy[$i]['price'] = $formattedOriginalPrice;
      $productsCopy[$i]['price_from'] = $formattedPriceWithDiscount;
    }

    return $productsCopy;
  }
}
