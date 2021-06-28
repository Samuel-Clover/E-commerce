<?php

namespace App\Database;

use App\Core\Model;

interface Database
{
  public function select(array $columns = ['*'], array $conditions = []);
  public function exec(string $query = null);
  public function insert(Model $data);
  public function update(Model $data);
  public function save(Model $data);
  public function delete(array $data);
  public function first();
  public function all();
  public function join(
    array $columns = ['*'],
    string $tableToJoin,
    string $foreignKeyColumn,
    string $primaryKeyColumnToJoin
  );
  public function joinAndWhere(
    array $columns = ['*'],
    string $tableToJoin,
    string $foreignKeyColumn,
    string $primaryKeyColumnToJoin,
    array $columnWheretable = [],
    array $params = []
  );
  public function selectManyTables(
    array $columns = ['*'],
    array $tables,
    array $conditions = []
  );
}
