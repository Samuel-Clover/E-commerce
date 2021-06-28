<?php

namespace App\Models;

use App\Core\Model;
use App\Database\MySql;

class ProductImages extends Model
{
  protected MySql $drive;
  protected string $table;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'products_images';
    $this->setDrive($this->drive);
  }

  public function getProductImageById(int $productId)
  {
    $productImages = $this->drive->select(
      ['url'],
      ['id_product' => $productId]
    )->exec()->all();

    return $productImages;
  }
}
