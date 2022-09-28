<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>



<body>

    <div class="container d-flex justify-content-between">
        <div>
            <a href="/vista/registrar/persona" class="btn btn-success"> Agregar</a>
            <a href="/vista/casar" class="btn btn-primary"> Casar</a>
        </div>
        <a href="/cerrar-sesion" class="btn btn-danger">Cerrar sesion</a>

    </div>

    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th>Estado Civil</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>{{ $persona->id }}</td>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->edad }}</td>
                        <td>{{ $persona->sexo }}</td>
                        <td>{{ $persona->estado_civil }}</td>
                        <td>
                            <button type="button" onclick="editar({{ $persona->id }})"
                                class="btn btn-outline-warning">Editar</button>
                            <button type="button" onclick="borrar({{ $persona->id }})"
                                class="btn btn-outline-danger">Borrar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

<script>
    function editar(id) {
        location.href = `/vista/editar/persona/${id}`
    }

    function borrar(id) {
        fetch(`/vista/visualizar/personas/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }

            })
            .then(response => response.json())
            .then(data => {
                location.reload();
            });

    }
</script>

</html>
