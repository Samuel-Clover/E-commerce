<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\ProductImages as ProductImagesModel;
use App\Models\Rate as RateModel;
use App\Utils\Cart;
use App\Utils\Product;

class DetailsController extends Controller
{
  public function index($params)
  {
    $isTheUserLoggedIn = $_SESSION['userId'] ?? false;
    $userId = $_SESSION['userId'] ?? false;
    $productId = (int) $params['id'];
    $cartInfoDefault = Cart::getDefaultValue();

    $categoryModel = new CategoryModel;
    $productModel = new ProductModel;
    $productImagesModel = new ProductImagesModel;

    $productDetails = $productModel->getProductDetailsById($productId);
    if (!$productDetails) {
      header('Location: ' . BASE_URL);
      exit;
    }

    $productModel->setLimit(5);
    $similarProducts = $productModel->getGenericProductsWithItsImages();
    $genericProducts = $productModel->getGenericProductsWithItsImages();
    $newProducts = $productModel->getNewProductsWithItsImages();

    [$productDetails] = Product::returnProductsWithFormattedPrice([$productDetails]);
    $similarProducts = Product::returnProductsWithFormattedPrice($similarProducts);
    $genericProducts = Product::returnProductsWithFormattedPrice($genericProducts);

    $productImages = $productImagesModel->getProductImageById($productId);
    $productDetails['images'] = $productImages;

    $rateModel = new RateModel;
    $notFoundRate = !($rateModel->findBy(
      [
        'id_user' => $userId,
        'id_product' => $productId
      ],
    ));
    $userHasNotVoted = $notFoundRate;

    $data = [
      'product' => $productDetails,
      'similarProducts' => $similarProducts,
      'genericProducts' => $genericProducts,
      'newProducts' => $newProducts,
      'categories' => $categoryModel->getNames(),
      'cartInfo' => $_SESSION['cartInfo'] ?? $cartInfoDefault,
      'userId' => $userId,
      'userHasNotVoted' => $userHasNotVoted,
      'isTheUserLoggedIn' => $isTheUserLoggedIn,
      'storeRatesRoute' => BASE_URL . '/rates'
    ];

    $this->render('detalhes', $data);
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
