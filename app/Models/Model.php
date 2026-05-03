<?php
namespace App\Models;
abstract class Model {
    abstract public function tableName(): string;
    abstract public function fillable(): array;
}

?>