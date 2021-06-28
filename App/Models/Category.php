<?php

namespace App\Models;

use App\Database\MySql;
use App\Core\Model;

class Category extends Model
{
  protected MySql $drive;
  protected string $table;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'categories';
    $this->setDrive($this->drive);
  }

  public function getNames()
  {
    $this->drive->setLimit(5);
    $categoryNames = $this->drive->select(['name'])->exec()->all();
    return $categoryNames;
  }
}
