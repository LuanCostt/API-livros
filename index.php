<?php

require_once __DIR__.'/vendor/autoload.php';

use Controller\LivrosController;
$livrosController = new LivrosController();

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'GET':
        $livrosController->getBooks();
        break;
    case 'POST':
        $livrosController->createBook();
        break;
    case 'PUT':
        $livrosController->updateBook();
        break;
    case 'DELETE':
        $livrosController->deleteBook();
        break;
    default:
        // FORMATA TEXTO EM JSON
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
// if (empty($usuario)){
//     echo "Vazio!";
// }
?>