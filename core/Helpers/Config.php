<?php
namespace Core\Helpers;

abstract class Config {
    public static function get(string $file)
    {
        return require __DIR__ . "/../../config/$file.php";
    }
}

?>