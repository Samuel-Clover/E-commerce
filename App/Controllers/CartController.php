<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Product as ProductModel;
use App\Utils\Cart;
use App\Utils\Login;
use App\Utils\Price;
use App\Utils\Product;

class CartController extends Controller
{
  public function index()
  {
    Login::redirectNotLoggedInUserToTheHomepage();

    $isTheUserLoggedIn = $_SESSION['userId'] ?? false;
    $products = $_SESSION['cart'] ?? [];
    $cartDefaultInfo = Cart::getDefaultValue();
    $cartInfo = $_SESSION['cartInfo'] ?? $cartDefaultInfo;

    $category = new Category;
    $product = new ProductModel;

    $product->setLimit(5);
    $genericProducts = $product->getGenericProductsWithItsImages();
    $newProducts = $product->getNewProductsWithItsImages();

    $formatProductIfItExists = function ($product) {
      if ($product) {
        $priceFrom = $product['price_from'];
        $price = $product['price'];
        $product['price_from'] = Price::formatForBRLCurrency($priceFrom);
        $product['price'] = Price::formatForBRLCurrency($price);
        return $product;
      }
    };

    $genericProducts = Product::returnProductsWithFormattedPrice($genericProducts);
    $productsWithFormattedPrice = array_map($formatProductIfItExists, $products);

    $data = [
      'isTheUserLoggedIn' => $isTheUserLoggedIn,
      'products' => $productsWithFormattedPrice,
      'newProducts' => $newProducts,
      'genericProducts' => $genericProducts,
      'cartInfo' => $cartInfo,
      'categories' => $category->getNames()
    ];

    $this->render('carrinho', $data);
  }

  public function deleteAProductFromCart()
  {
    $cart = $_SESSION['cart'] ?? [];
    $cartInfo = $_SESSION['cartInfo'] ?? [];
    $productId = file_get_contents('php://input');

    $productExists = function ($product) {
      return $product !== null;
    };

    $getProductByDifferentIdThanProvided = function ($product) use ($productId) {
      if ($product['id'] !== $productId) {
        return $product;
      }
    };

    $getProductById = function ($product) use ($productId) {
      if ($product['id'] === $productId) {
        return $product;
      }
    };

    $product = array_filter($cart, $getProductById);
    $cartInfo['total'] = Price::formatForBRLCurrency($cartInfo['total'] - $product['price_from']);
    $cartInfo['count'] = $cartInfo['count'] - 1;

    $mappedCart = array_map($getProductByDifferentIdThanProvided, $cart);
    $filteredCart = array_filter($mappedCart, $productExists);

    $_SESSION['cart'] = $filteredCart;
    $_SESSION['cartInfo'] = $cartInfo;

    exit;
  }

  public function search()
  {
    $product = new ProductModel;
    $searchValue = filter_input(INPUT_POST, 'busca');
    $filteredProducts = $product->getFilteredProducts($searchValue);
    $filteredProducts = Product::returnProductsWithFormattedPrice($filteredProducts);
    die(json_encode($filteredProducts));
  }
}
