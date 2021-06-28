<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\Cart;
use App\Utils\Product;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Brand as BrandModel;

class HomeController extends Controller
{
  public function index()
  {
    $isTheUserLoggedIn = $_SESSION['userId'] ?? false;
    $cartDefaultInfo = Cart::getDefaultValue();
    $cartInfo = $_SESSION['cartInfo'] ?? $cartDefaultInfo;

    $categoryModel = new CategoryModel;
    $productModel = new ProductModel;
    $brandModel = new BrandModel;

    $productModel->setLimit(10);
    $products = $productModel->getGenericProductsWithItsImages();
    $newProducts = $productModel->getNewProductsWithItsImages();

    $productModel->setLimit(3);
    $featuredProducts = $productModel->getFeaturedProductsWithItsImages();
    $recentProducts = $productModel->getRecentProductsWithItsImages();
    $productReleases = $productModel->getProductReleasesWithItsImages();

    $products = Product::returnProductsWithFormattedPrice($products);
    $newProducts = Product::returnProductsWithFormattedPrice($newProducts);
    $featuredProducts = Product::returnProductsWithFormattedPrice($featuredProducts);
    $recentProducts = Product::returnProductsWithFormattedPrice($recentProducts);
    $productReleases = Product::returnProductsWithFormattedPrice($productReleases);

    $brands = $brandModel->getNamesAndImages();

    $data = [
      'isTheUserLoggedIn' => $isTheUserLoggedIn,
      'cartInfo' => $cartInfo,
      'products' => $products,
      'featuredProducts' => $featuredProducts,
      'recentProducts' => $recentProducts,
      'productReleases' => $productReleases,
      'newProducts' => $newProducts,
      'brands' => $brands,
      'categories' => $categoryModel->getNames(),
      'userId' => $_SESSION['userId'] ?? null
    ];

    $this->render('home', $data);
  }
}
