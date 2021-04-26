<?php
require_once('../model/ProvinciaModel.php');

$provinciaModel = new ProvinciaModel();
if ($_GET['action'] == 'getListado') {
    $results = $provinciaModel->all();
    $response = array(
        "status" => "Ok",
        "code" => 200,
        "message" => "Listado de provincias",
        "data" => $results
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}
