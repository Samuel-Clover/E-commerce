<?php

namespace App\Utils;

class Cart
{
  public static function getDefaultValue()
  {
    $defaultValue = ['count' => 0, 'total' => 'R$ 0,00'];
    return $defaultValue;
  }

  public static function generateCartInfo(array $cartProducts)
  {
    $productsCount = count($cartProducts);
    $totalPrice = 0;

    foreach ($cartProducts as $cartProduct) {
      $totalPrice += $cartProduct['price_from'];
    }

    $formattedTotalPrice = Price::formatForBRLCurrency($totalPrice);

    $cartInfo = [
      'count' => $productsCount,
      'total' => $formattedTotalPrice
    ];

    return $cartInfo;
  }

  public static function getProductsThatAreInTheCart(
    array $products,
    array $cartProductsIds
  ) {
    $cartProducts = [];

    foreach ($products as $product) {
      $productId = (int) $product['id'];
      foreach ($cartProductsIds as $cartProductId) {
        $cartProductId = (int) $cartProductId;
        if ($productId === $cartProductId) {
          $cartProducts[] = $product;
        }
      }
    }

    return $cartProducts;
  }
}
