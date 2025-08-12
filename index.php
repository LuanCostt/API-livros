<?php

use Model\Connection;
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'Config/configuration.php';
require_once 'Model/Connection.php';
require_once 'Model/Userlivros.php';
require_once 'Controller/LivroController.php';

$database = new Connection();
$db = $database->getConnection();


$userlivros = new Model\Userlivros($db);
$controller = new Connection\LivroController($userlivros);

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$method = $_SERVER['REQUEST_METHOD'];


$controller->processarRequisicao($method, $id);

?>