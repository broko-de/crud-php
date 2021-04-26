<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario TEST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
    <?php include('./src/templates/header.tpl.php') ?>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Modulo de personas de ejemplo</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10">
                        <p class="card-text">Este es un ejemplo de CRUD de personas para el MINISTERIO DE SALUD</p>
                    </div>
                    <div class="col-lg-2">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#personaModal">Agregar</a>
                    </div>
                </div>
                <h5 class="card-title">Lista</h5>
                <div class="alert alert-success alert-dismissible hide" role="alert" id="alertSuccess">
                    <strong id="alertSuccessMsg"></strong>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="resultadosTabla">
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Persona SAVE -->
    <div class="modal fade" id="personaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="personaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formPersona">
                    <div class="modal-header">
                        <h5 class="modal-title" id="personaModalLabel">Formulario Persona</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nombreInput">Nombre</label>
                                    <input type="text" class="form-control" id="nombreInput" name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="apellidoInput">Apellido</label>
                                    <input type="text" class="form-control" id="apellidoInput" name="apellido">
                                </div>
                                <div class="form-group">
                                    <label for="provinciaInput">Provincia</label>
                                    <select id="provinciaSelect" name="provincia" class="form-control">
                                        <option value="">--Seleccione--</option>
                                    </select>
                                </div>
                                <input type="hidden" id="id_persona" name="id_persona" value="">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal DELETE-->
    <div class="modal fade" id="deletePersonaModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formDeletePersona">
                    <input type="hidden" id="idPersonaDelete">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar una persona</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro que desea eliminar a <strong id="nombreEliminar"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('./src/templates/footer.tpl.php') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="./public/js/PersonaController.js"> </script>
    <script src="./public/js/ProvinciaController.js"> </script>

</body>

</html>