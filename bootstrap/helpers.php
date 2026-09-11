<?php

use App\Exceptions\NotFoundException;

function config(string $file)
{
    static $configCache = [];

    if(isset($configCache[$file])) {
        return $configCache[$file];
    }

    $configCache[$file] = require __DIR__ . "/../config/$file.php";
    return $configCache[$file];
}

function url(string $path = ''): string
{
    static $baseUrl = null;

    if ($baseUrl === null) {
        $baseUrl = config('app')['app_url'];
    }

    return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
}

function view(string $path, array $data = [], ?string $layout = null)
{
    $viewPath = __DIR__ . "/../views/{$path}.php";

    if (!file_exists($viewPath)) {
        throw new NotFoundException("View file not found: " . $viewPath);
    }

    extract($data);
    ob_start();
    include $viewPath;
    $content = ob_get_clean();

    if ($layout === null) {
        echo $content;
        return;
    }

    $layoutPath = __DIR__ . "/../views/layouts/{$layout}.php";

    if (!file_exists($layoutPath)) {
        throw new NotFoundException("Layout file not found: " . $layoutPath);
    }

    include $layoutPath;
}

function redirect($path, $data = []) {
    $query = '';

    if (!empty($data)) {
        $query = "?". http_build_query($data);
    }

    $url = url("{$path}{$query}");

    header("Location: $url");
    exit;
}

?>