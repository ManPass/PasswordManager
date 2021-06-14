<?php

//Строитель SQL-запросов
class MysqlQueryBuilder implements SQLQueryBuilder{
    protected $query;

    //Очищение предыдущего сгенерированного запроса
    protected function reset() : void{
        $this->query = new \stdClass();
    }

    //Построение запроса на выборку(1: имя_таблицы, 2: поля из которых нужно получить данные)
    public function select(string $table, array $fields):SQLQueryBuilder{
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';
        return $this;
    }

    //Добавляет
    public function where(string $field, string $value, string $operator= '='):SQLQueryBuilder{
        if(!in_array($this->query->type, ['select', 'update', 'delete']))
        {
            throw new \Exception("WHERE может использоваться только в запросах SELECT, UPDATE или DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

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
