<?php

namespace App\Models;

use App\Core\Model;
use App\Database\MySql;
use DateTime;

class Rate extends Model
{
  public int $id_user;
  public int $id_product;
  public DateTime $date_rated;
  public int $points;
  public string $comment;
  protected MySql $drive;
  protected string $table;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'rates';
    $this->setDrive($this->drive);
  }
}
