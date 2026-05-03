<?php
namespace App\Controllers;

class Controller {
    protected function redirect($path, $data = []) {
        $query = '';
        foreach($data as $key => $q){
            $query .= "&{$key}={$q}";
        }
        header("Location: index.php?action={$path}{$query}");
        exit;
    }
}

?>