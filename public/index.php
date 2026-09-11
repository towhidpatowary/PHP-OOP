<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../bootstrap/helpers.php";

use App\Providers\AppServiceProvider;
use Core\Container;
use Core\Router;

$container = new Container();
$appServiceProvider = new AppServiceProvider();
$appServiceProvider->register($container);

session_start();

if(!isset($_SESSION['CSRF_TOKEN'])){
    $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32));
}

$method = $_SERVER['REQUEST_METHOD'];
$basePath = config('app')['app_url'] ?? '';
$serverUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$action = str_replace($basePath, '', $serverUri);


require_once __DIR__ .'/../routes/web.php';

Router::dispatch($container, $method, $action);
?>