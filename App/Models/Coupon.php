<?php

namespace App\Models;

use App\Database\MySql;
use App\Core\Model;

class Coupon extends Model
{
  protected MySql $drive;
  protected $table;
  public string $name;
  public int $coupon_type;
  public float $coupon_value;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'coupons';
    $this->setDrive($this->drive);
  }
}
