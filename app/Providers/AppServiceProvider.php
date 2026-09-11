<?php
namespace App\Providers;

use App\Requests\Request;
use Core\Container;
use Core\Database\Database;

class AppServiceProvider {
    public function register(Container $container) {
        $container->bind(Database::class, function () {
            $config = config('database');

            return new Database($config['connections'][$config['default']]);
        });

        $container->bind(Request::class, function () {
            return new Request($_GET, $_POST);
        });
    }
}


?>