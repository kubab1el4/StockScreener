<?php

namespace App\Filter;
use App\Interfaces\FilterableInterface;
use Illuminate\Support\Facades\DB;

abstract class RelationFilter implements FilterableInterface {

    protected string $primaryKey = 'id';

    protected string $entitiesTable;
    protected string $valueField;
    protected string $foreignKey;
    protected string $relationsTable;
    protected array $keys = [];

    public function __construct($keys) {
        $this->keys = $keys;
    }
    public function getKeys(): array {
        return $this->keys;
    }

    public function setKeys(array $keys): void {
        $this->keys = $keys;
    }

    public function filter(int $limit, string $function, string $operator, float $value, array $where = []): FilterableInterface {
        if (!empty($where)) {
            $clause = collect($where)->map(fn($val, $key) => (int)$val != 0 ? "{$key} = {$val}" : "{$key} = '{$val}'")->toArray();

            $whereString = "WHERE " . implode(' AND ', $clause);
        } else {
            $whereString = '';
        }
        $keysString = implode(',', $this->keys);

        $this->setKeys(collect(DB::select(
                "WITH top_values as (SELECT * FROM (
                SELECT ROW_NUMBER() OVER (PARTITION BY r.{$this->foreignKey} ORDER BY r.{$this->primaryKey} DESC) AS r,
                    r.*
                FROM {$this->relationsTable} r
                JOIN {$this->entitiesTable} e on e.{$this->primaryKey} = r.{$this->foreignKey} AND e.{$this->primaryKey} IN ($keysString)
                {$whereString}) x
            WHERE x.r<={$limit}
            ) SELECT tv.{$this->foreignKey} FROM top_values tv GROUP BY {$this->foreignKey} HAVING({$function}(tv.{$this->valueField}::float) {$operator} {$value})"
        ))->map(fn($row) => $row->company_id)->toArray());

        return $this;
    }

}
