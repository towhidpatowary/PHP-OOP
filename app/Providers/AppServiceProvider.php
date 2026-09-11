<?php
namespace App\Providers;

use Core\Container;
use Core\Database\Database;

class AppServiceProvider {
    public function register(Container $container) {
        $container->bind(Database::class, function () {
            $config = config('database');

            return new Database($config['connections'][$config['default']]);
        });
    }
}


?>