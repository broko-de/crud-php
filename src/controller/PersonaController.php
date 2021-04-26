<?php
require_once('../model/PersonaModel.php');

$personaModel = new PersonaModel();
if ($_GET['action'] == 'getList') {
    $results = $personaModel->all();
    $response = array(
        "status" => "Ok",
        "code" => 200,
        "message" => "Listado de personas",
        "data" => $results
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}

if ($_GET['action'] == 'get') {
    $result = $personaModel->get($_GET['id_persona']);
    $response = array(
        "status" => "Ok",
        "code" => 200,
        "message" => "Detalle de una persona",
        "data" => $result
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}

if ($_POST['action'] == 'save') {
    $data = array(
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "id_provincia" => $_POST["provincia"]
    );
    $results = $personaModel->save($data);
    $response = array(
        "status" => "Ok",
        "code" => 201,
        "message" => "Se creo la persona con éxito",
        "data" => $results
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}

if ($_POST['action'] == 'update') {
    $data = array(
        "id_persona" => $_POST["id_persona"],
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "id_provincia" => $_POST["provincia"]
    );
    $results = $personaModel->update($data);
    $response = array(
        "status" => "Ok",
        "code" => 200,
        "message" => "Se actualizó a la persona con éxito",
        "data" => $results
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}

if ($_POST['action'] == 'delete') {
    $results = $personaModel->delete($_POST["id_persona"]);
    $response = array(
        "status" => "Ok",
        "code" => 200,
        "message" => "Se elimino a la persona con éxito",
        "data" => $results
    );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($response);
    exit();
}
