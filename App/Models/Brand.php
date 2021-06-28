<?php

namespace App\Models;

use App\Core\Model;
use App\Database\MySql;

class Brand extends Model
{
  protected MySql $drive;
  protected string $table;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'brands';
    $this->setDrive($this->drive);
  }

  public function getNamesAndImages()
  {
    $brands = $this->drive->join(
      ['brands.id', 'brands.name', 'brands_images.url AS image'],
      'brands_images',
      'id',
      'id_brand'
    )->exec();
    $brands = $brands->all();
    return $brands;
  }
}
