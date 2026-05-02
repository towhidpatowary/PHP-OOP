<?php
namespace Models;
require_once __DIR__ . "/Model.php";

use Models\Model;

class User extends Model {
    protected $tableName = "users";

    protected $fillable = ['name', 'phone'];

    public function tableName(): string {
        return $this->tableName;
    }
    public function fillable(): array {
        return $this->fillable;
    }
}

?>