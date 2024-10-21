<?php

namespace App\Filter;
use App\Interfaces\FilterableInterface;

class CompanyScreener extends RelationFilter implements FilterableInterface {

    protected string $primaryKey = 'id';

    protected string $entitiesTable;
    protected string $valueField;
    protected string $foreignKey;
    protected string $relationsTable;
    protected array $keys = [];

    public function __construct($keys) {

        $this->entitiesTable = 'companies';
        $this->valueField = 'value';
        $this->foreignKey = 'company_id';
        $this->relationsTable = 'company_data';
        parent::__construct($keys);
    }

}
