<?php

namespace App\Core;

use App\Database\Database;
use App\Database\MySql;

abstract class Model
{
  protected MySql $drive;

  public function setDrive(Database $drive)
  {
    $this->drive = $drive;
    $this->drive->setTable($this->table);
    return $this;
  }

  public function getDrive()
  {
    return $this->drive;
  }

  public function setLimit(int $limit)
  {
    $this->drive->setLimit($limit);
  }

  public function findFirst($id)
  {
    return $this->getDrive()
      ->select(['id' => $id])
      ->exec()
      ->first();
  }

  public function delete()
  {
    return $this->getDrive()
      ->delete(['id' => $this->id])
      ->exec();
  }

  public function findBy(array $conditions)
  {
    $data = $this->drive->select(['*'], $conditions)->exec()->first();
    return $data;
  }

  public function findAll(array $conditions = [])
  {
    return $this->getDrive()
      ->select($conditions)
      ->exec()
      ->all();
  }

  public function save()
  {
    return $this->getDrive()
      ->save($this)
      ->exec();
  }

  public function __get($variable)
  {
    if ($variable === 'table') {
      $table = get_class($this);
      $table = explode('\\', $table);
      return strtolower(array_pop($table));
    }

    return null;
  }
}
