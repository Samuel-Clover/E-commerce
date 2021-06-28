<?php

namespace App\Models;

use App\Database\MySql;
use App\Core\Model;

class User extends Model
{
  protected MySql $drive;
  protected $table;
  public string $name;
  public string $password;
  public string $email;
  public string $phone;
  public string $address;

  public function __construct()
  {
    $this->drive = new MySql;
    $this->table = 'users';
    $this->setDrive($this->drive);
  }
}
