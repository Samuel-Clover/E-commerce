<?php

namespace App\Models;

use App\Core\Model;
use App\Database\MySql;

class Product extends Model
{
  protected MySql $drive;
  protected string $table;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'products';
    $this->setDrive($this->drive);
  }

  public function getQuantityOfProducts()
  {
    $this->setLimit(1);
    $quantityOfProducts = $this->drive->select(['COUNT(*)'])->exec()->first();
    $quantityOfProducts = $quantityOfProducts['COUNT(*)'];
    return $quantityOfProducts;
  }

  public function getGenericProductsWithItsImages()
  {
    $genericProducts = $this->drive->join(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products_images.url as image'
      ],
      'products_images',
      'id',
      'id_product'
    )->exec();
    $genericProducts = $genericProducts->all();
    return $genericProducts;
  }

  public function getFilteredProducts(string $operatorValueLike)
  {
    $filteredProducts = $this->drive->joinAndWhere(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products_images.url as image'
      ],
      'products_images',
      'id',
      'id_product',
      ['name'=>'name'],
      ['like'=>$operatorValueLike]
    )->exec();
    $filteredProducts = $filteredProducts->all();
    return $filteredProducts;
  }

  public function getNewProductsWithItsImages()
  {
    $newProducts = $this->drive->selectManyTables(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products_images.url AS image'
      ],
      ['products_images'],
      [
        'new_product' => true,
        'products.id' => 'products_images.id_product'
      ]
    )->exec();
    $newProducts = $newProducts->all();
    return $newProducts;
  }

  public function getFeaturedProductsWithItsImages()
  {
    $featuredProducts = $this->drive->selectManyTables(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products.rating',
        'products_images.url AS image'
      ],
      ['products_images'],
      [
        'featured' => true,
        'bestseller' => true,
        'rating' => 5,
        'products.id' => 'products_images.id_product'
      ]
    )->exec()->all();

    return $featuredProducts;
  }

  public function getRecentProductsWithItsImages()
  {
    $recentProducts = $this->drive->selectManyTables(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products.rating',
        'products_images.url AS image'
      ],
      ['products_images'],
      [
        'featured' => true,
        'sale' => true,
        'bestseller' => true,
        'products.id' => 'products_images.id_product'
      ]
    )->exec()->all();

    return $recentProducts;
  }

  public function getProductReleasesWithItsImages()
  {
    $productReleases = $this->drive->selectManyTables(
      [
        'products.id',
        'products.name',
        'products.price',
        'products.price_from',
        'products.stock',
        'products.rating',
        'products_images.url AS image'
      ],
      ['products_images'],
      [
        'featured' => true,
        'sale' => true,
        'bestseller' => true,
        'new_product' => true,
        'products.id' => 'products_images.id_product'
      ]
    )->exec()->all();

    return $productReleases;
  }

  public function getProductDetailsById(int $productId)
  {
    $productDetails = $this->drive->selectManyTables(
      [
        'products.id',
        'products.name',
        'products.description',
        'products.price_from',
        'products.price',
        'categories.name AS category',
        'products_images.url AS image',
      ],
      [
        'categories',
        'products_images'
      ],
      [
        'products.id' => $productId,
        'products.id_category' => 'categories.id',
        'products_images.id_product' => $productId
      ]
    )->exec()->first();

    return $productDetails;
  }
}
