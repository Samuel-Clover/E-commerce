<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Database\MySql;
use App\Models\Coupon;
use App\Utils\Login;
use App\Utils\Price;

class CouponsController extends Controller
{
  public function verifyCoupon()
  {
    Login::redirectNotLoggedInUserToTheHomepage();

    $cartProducts = $_SESSION['cart'];
    $couponCode = file_get_contents('php://input') ?? null;

    if (empty($couponCode)) {
      $response = [
        'error' => true,
        'message' => 'Nenhum cupom foi fornecido.',
      ];
      exit(json_encode($response));
    }

    $couponCode = filter_var($couponCode, FILTER_SANITIZE_STRING);

    $appliedCouponInSession = $_SESSION['appliedCoupon'] ?? null;
    $couponAlreadyApplied = $appliedCouponInSession === $couponCode;
    if ($couponAlreadyApplied) {
      $response = [
        'error' => true,
        'message' => 'Este cupom já está aplicado.'
      ];
      exit(json_encode($response));
    }

    $couponModel = new Coupon;

    $coupon = $couponModel->findBy(['name' => $couponCode]);
    if (!$coupon) {
      $response = [
        'error' => true,
        'message' => 'Cupom inválido.',
      ];
      exit(json_encode($response));
    }

    $foundProduct = null;
    $couponValue = (float) $coupon['coupon_value'];
    $invalidCouponForSomeCartProduct = true;

    $updatedTotalPrice = 0;

    for ($i = 0; $i < count($cartProducts); $i++) {
      if ($cartProducts[$i]['id'] === $coupon['id_product']) {
        $invalidCouponForSomeCartProduct = false;
        $cartProducts[$i]['price_from'] -= $couponValue;
        $foundProduct = $cartProducts[$i];
      }

      $updatedTotalPrice += $cartProducts[$i]['price_from'];
    }

    if ($invalidCouponForSomeCartProduct) {
      $response = [
        'error' => true,
        'message' => 'Este cupom não é válido para nenhum dos produtos que estão no seu carrinho.'
      ];
      exit(json_encode($response));
    }

    $updatedTotalPrice = Price::formatForBRLCurrency($updatedTotalPrice);

    $_SESSION['cartInfo']['total'] = $updatedTotalPrice;
    $_SESSION['cart'] = $cartProducts;
    $_SESSION['appliedCoupon'] = $couponCode;

    $response = [
      'error' => false,
      'product' => [
        'id' => $foundProduct['id'],
        'name' => $foundProduct['name'],
        'price' => $foundProduct['price_from'],
        'couponValue' => $couponValue
      ]
    ];
    exit(json_encode($response));
  }
}
