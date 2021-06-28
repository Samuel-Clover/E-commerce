<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Utils\Cart;
use App\Utils\Product;

class CheckOutController extends Controller
{
  public function index()
  {
    $cartDefaultInfo = Cart::getDefaultValue();
    $cartInfo = $_SESSION['cartInfo'] ?? $cartDefaultInfo;

    $categoryModel = new CategoryModel;
    $productModel = new ProductModel;

    $productModel->setLimit(5);
    $genericProducts = $productModel->getGenericProductsWithItsImages();
    $newProducts = $productModel->getNewProductsWithItsImages();

    $genericProducts = Product::returnProductsWithFormattedPrice($genericProducts);

    $data = [
      'cartInfo' => $cartInfo,
      'genericProducts' => $genericProducts,
      'newProducts' => $newProducts,
      'categories' => $categoryModel->getNames()
    ];

    $this->render('checkout', $data);
  }
}
