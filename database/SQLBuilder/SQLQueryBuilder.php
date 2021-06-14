<?php

interface SQLQueryBuilder{
    public function select(string $table, array $fields):SQLQueryBuilder;
    public function where(string $field, string $value, string $operator= '='):SQLQueryBuilder;
    public function limit(int $start, int $offset):SQLQueryBuilder;
    public function update():SQLQueryBuilder;
    public function delete():SQLQueryBuilder;
    public function insert():SQLQueryBuilder;    
}

?>