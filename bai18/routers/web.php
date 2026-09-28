<?php

$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

$controller = new OrderController($pdo);

if ($method === 'GET' && $url === 'orders') {
    $controller->index();
} elseif ($method === 'GET' && preg_match('#^orders/([0-9]+)$#', $url, $matches)) {

    $id = (int) $matches[1];

    $controller->detail($id);
} elseif ($method === 'POST' && $url === "orders/create") {
    $controller->create($_POST);
} elseif ($method === 'GET' && $url === "orders/create") {
    $controller->showCreateForm();
} elseif ($method === 'GET' && preg_match('#^orders/edit/([0-9]+)$#', $url, $matches)) {

    $id = (int) $matches[1];
    $controller->showEditForm($id);
} elseif ($method === 'POST' && preg_match('#^orders/edit/([0-9]+)$#', $url, $matches)) {

    $id = (int) $matches[1];

    $controller->update($id, $_POST);
} elseif ($method === 'GET' && preg_match('#^orders/delete/([0-9]+)$#', $url, $matches)) {

    $id = (int) $matches[1];

    $controller->delete($id);
}
