<?php

namespace App\Database;

use App\Core\Model;

class MySql implements Database
{
  protected $pdo;
  public $table;
  protected $limit = 100;
  protected $offset = 0;

  /***
   **@var pdo conexão com banco de dados Mysql
   ***/
  public function __construct()
  {
    try {
      $pdo = new \PDO(
        'mysql:dbname=' . DB . ';host=' . HOST . ';charset=utf8',
        USER,
        PASSWORD,
        array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
      );
      $this->pdo = $pdo;
    } catch (\PDOException $e) {
      throw new \Exception('Erro de conexão com banco de dados', 1);
    }
  }

  public function setTable(string $table)
  {
    $this->table = $table;
    return $this;
  }

  public function setLimit(int $limit)
  {
    $this->limit = $limit;
    return $this;
  }

  public function setOffset(int $offset)
  {
    $this->offset = $offset;
    return $this;
  }

  public function select(array $columns = ['*'], array $conditions = [])
  {
    $query = 'SELECT ';
    foreach ($columns as $column) {
      $query .= $column . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= ' FROM ' . $this->table;

    $data = $this->params($conditions);

    if ($data) {
      $splitedData = explode(',', $data);
      $whereStatement = $this->mountBindedWhereStatement($splitedData);
      $query .= $whereStatement;
    }

    $hasLimit = (bool) $this->limit;
    if ($hasLimit) {
      $query .= ' LIMIT ' . $this->limit;
    }

    $this->query = $this->pdo->prepare($query);
    $this->bind($conditions);

    return $this;
  }

  public function selectManyTables(
    array $columns = ['*'],
    array $tables,
    array $conditions = []
  ) {

    $query = $this->mountSelectManyTablesQuery($columns, $tables, $conditions);

    $this->query = $this->pdo->prepare($query);

    return $this;
  }

  public function insert(Model $data)
  {
    $query = 'INSERT INTO %s (%s) VALUES (%s)';
    $fields = [];
    $fieldsToBind = [];

    foreach ($data as $field => $value) {
      $fields[] = $field;
      $fieldsToBind[] = ':' . $field;
    }

    $fields = implode(',', $fields);
    $fieldsToBind = implode(',', $fieldsToBind);

    $query = sprintf($query, $this->table, $fields, $fieldsToBind);

    $this->query = $this->pdo->prepare($query);
    $this->bind($data);

    return $this;
  }

  public function update(Model $data)
  {
    if (empty($data->id)) {
      throw new \Exception('id é obrigatório');
    }

    $query = 'UPDATE %s SET %s';
    $dataToUpdate = $this->params($data);

    $query = sprintf($query, $this->table, $dataToUpdate);
    $query .= ' WHERE id = :id';
    $this->query = $this->pdo->prepare($query);
    $this->bind($data);

    return $this;
  }

  public function save(Model $data)
  {
    if (!empty($data->id)) {
      $this->update($data);
      return $this;
    }

    $this->insert($data);
    return $this;
  }

  public function exec(string $query = null)
  {
    $this->query->execute();
    return $this;
  }

  public function delete(array $conditions)
  {
    $query = 'DELETE FROM ' . $this->table;
    $data = $this->params($conditions);
    $query .= ' WHERE ' . $data;

    $this->query = $this->pdo->prepare($query);
    $this->bind($conditions);

    return $this;
  }

  public function join(
    array $columns = ['*'],
    string $tableToJoin,
    string $foreignKeyColumn,
    string $primaryKeyColumnToJoin
  ) {

    $query = 'SELECT ';
    foreach ($columns as $column) {
      $query .= $column . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= <<<QUERY
      FROM {$this->table}
      INNER JOIN {$tableToJoin}
      ON
      {$this->table}.{$foreignKeyColumn} = {$tableToJoin}.{$primaryKeyColumnToJoin}
      GROUP BY id
    QUERY;

    $hasLimit = (bool) $this->limit;
    if ($hasLimit) {
      $query .= " LIMIT {$this->limit}";
      $query .= " OFFSET {$this->offset}";
    }

    $this->query = $this->pdo->prepare($query);
    return $this;
  }

  public function first()
  {
    return $this->query->fetch(\PDO::FETCH_ASSOC);
  }

  public function all()
  {
    return $this->query->fetchAll(\PDO::FETCH_ASSOC);
  }

  private function params($conditions)
  {
    $fields = [];
    foreach ($conditions as $field => $value) {
      $fields[] = $field . '=:' . $field;
    }

    return implode(',', $fields);
  }

  private function bind($data)
  {
    foreach ($data as $field => $value) {
      $this->query->bindValue($field, $value);
    }
  }

  private function mountSelectManyTablesQuery(
    array $columns,
    array $tables,
    array $conditions
  ) {
    $query = 'SELECT ';
    foreach ($columns as $column) {
      $query .= $column . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= " FROM $this->table, ";

    foreach ($tables as $table) {
      $query .= $table . ', ';
    }
    $query = rtrim($query, ', ');

    $whereStatement = $this->mountWhereStatement($conditions);
    $query .= $whereStatement;

    $query .= " GROUP BY id";

    $hasLimit = (bool) $this->limit;
    if ($hasLimit) {
      $query .= " LIMIT {$this->limit}";
    }

    return $query;
  }

  private function mountWhereStatement(array $conditions)
  {
    $whereStatement = '';
    $counter = 0;
    foreach ($conditions as $key => $value) {
      $isTheFirstCondition = $counter === 0;
      if ($isTheFirstCondition) {
        $whereStatement .= " WHERE {$key} = {$value}";
      } else {
        $whereStatement .= " AND {$key} = {$value}";
      }
      $counter++;
    }

    return $whereStatement;
  }

  private function mountBindedWhereStatement(array $conditions) {
    $whereStatement = '';
    for ($i = 0; $i < count($conditions); $i++) {
      if ($i === 0) {
        $whereStatement .= ' WHERE ' . $conditions[$i];
      } else {
        $whereStatement .= ' AND ' . $conditions[$i];
      }
    }

    return $whereStatement;
  }

  public function joinAndWhere(
    array $columns = ['*'],
    string $tableToJoin,
    string $foreignKeyColumn,
    string $primaryKeyColumnToJoin,
    array $columnWheretable = [],
    array $params = []
  ) {

    $query = 'SELECT ';
    foreach ($columns as $column) {
      $query .= $column . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= <<<QUERY
      FROM {$this->table}
      INNER JOIN {$tableToJoin}
      ON
      {$this->table}.{$foreignKeyColumn} = {$tableToJoin}.{$primaryKeyColumnToJoin}
    QUERY;

    if ($columnWheretable != null) {
      $like = $this->paramsLike($params);
      $columnWheretable = $this->paramsLike($columnWheretable);
      if ($like) {
        $query .= " WHERE $columnWheretable LIKE :$like GROUP BY id";
      }
    } else {
      $hasLimit = (bool) $this->limit;
      if ($hasLimit) {
        $query .= " GROUP BY id LIMIT {$this->limit}";
        $query .= " OFFSET {$this->offset}";
      }
    }

    $this->query = $this->pdo->prepare($query);
    $this->bindLike($params);

    return $this;
  }

  private function paramsLike($conditions)
  {
    $fields = [];
    foreach ($conditions as $field => $value) {
      $fields[] = $field;
    }

    return implode(',', $fields);
  }

  private function bindLike($data)
  {
    foreach ($data as $field => $value) {
      $this->query->bindValue($field, '%' . $value . '%');
    }
  }
}
