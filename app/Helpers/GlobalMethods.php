<?php
 declare(strict_types=1);

 use App\Exceptions\NotFoundException;

function view(string $path, array $data = [], ?string $layout = null) {
        $viewPath = __DIR__ . "/../../views/{$path}.php";

        if(!file_exists($viewPath)){
            throw new NotFoundException("View file not found: ". $viewPath);
        }

        extract($data);
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        if($layout === null){
            echo $content;
            return;
        }

        $layoutPath = __DIR__ . "/../../views/layouts/{$layout}.php";

        if(!file_exists($layoutPath)){
            throw new NotFoundException("Layout file not found: ". $layoutPath);
        }

        include $layoutPath;
}
function redirect($path, $data = []) {
        $query = '';
        foreach($data as $key => $q){
            $query .= "&{$key}={$q}";
        }
        header("Location: index.php?action={$path}{$query}");
        exit;
}

?>