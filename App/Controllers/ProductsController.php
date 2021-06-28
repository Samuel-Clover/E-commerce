<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Database\MySql;
use App\Utils\Cart;
use App\Utils\Product;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;

class ProductsController extends Controller
{
  public function index()
  {
    $isTheUserLoggedIn = $_SESSION['userId'] ?? false;
    $cartDefaultInfo = Cart::getDefaultValue();
    $cartInfo = $_SESSION['cartInfo'] ?? $cartDefaultInfo;

    $categoryModel = new CategoryModel;
    $productModel = new ProductModel;

    $pageNumber = (int) filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

    $pageNumberWasNotProvided = $pageNumber === 0;
    if ($pageNumberWasNotProvided) {
      $pageNumber = 1;
    }

    $offset = ($pageNumber - 1) * QUANTITY_OF_PRODUCTS_PER_PAGE;
    $productModel->getDrive()->setOffset($offset);
    $productModel->getDrive()->setLimit(12);

    $products = $productModel->getGenericProductsWithItsImages();
    $productsWithFormattedPrice = Product::returnProductsWithFormattedPrice($products);

    $quantityOfProducts = $productModel->getQuantityOfProducts();
    $totalPages = ceil($quantityOfProducts / QUANTITY_OF_PRODUCTS_PER_PAGE);

    $data = [
      'isTheUserLoggedIn' => $isTheUserLoggedIn,
      'cartInfo' => $cartInfo,
      'totalPages' => $totalPages,
      'pageNumber' => $pageNumber,
      'products' => $productsWithFormattedPrice,
      'categories' => $categoryModel->getNames(),
      'userId' => $_SESSION['userId'] ?? null
    ];

    $this->render('produtos', $data);
  }

  public function getProducts()
  {
    $cartProductsIds = json_decode(file_get_contents('php://input')) ?? [];

    $db = new MySql;
    $db->setTable('products');
    $products = $db->join(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products_images.url AS image'
      ],
      'products_images',
      'id',
      'id_product'
    )->exec();
    $products = $products->all();

    $cartProducts = Cart::getProductsThatAreInTheCart($products, $cartProductsIds);
    $cartInfo = Cart::generateCartInfo($cartProducts);

    $_SESSION['cartInfo'] = $cartInfo;
    $_SESSION['cart'] = $cartProducts;
    exit;
  }

  
}
