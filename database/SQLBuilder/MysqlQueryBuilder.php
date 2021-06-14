<?php
class MysqlQueryBuilder implements SQLQueryBuilder{
    protected $query;
    protected function reset(){
        $this->query = new \stdClass();
    }
    public function select(string $table, array $fields):SQLQueryBuilder{
        return $this;
    }

    public function where(string $field, string $value, string $operator= '='):SQLQueryBuilder{
        return $this;
    }
    public function limit(int $start, int $offset):SQLQueryBuilder{
        return $this;
    }
    public function update():SQLQueryBuilder{
        return $this;
    }
    public function delete():SQLQueryBuilder{
        return $this;
    }
    public function insert():SQLQueryBuilder{
        return $this;
    }
}
