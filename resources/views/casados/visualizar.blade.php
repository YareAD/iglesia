<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casados</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <a href="/vista/visualizar/personas" class="btn btn-primary">Principal</a>
    <div class="container mt-5">
        <h3>CASADOS</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hombre</th>
                    <th>Mujer</th>
                    <th>Fecha boda</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($casados as $casado)
                    <tr>
                        <td>{{ $casado->hombre }}</td>
                        <td>{{ $casado->mujer }}</td>
                        <td>{{ $casado->fecha_boda }}</td>
                        <td>
                            <button type="button" onclick="divorciar({{ $casado->id }})"
                                class="btn btn-outline-danger">Divorciar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function divorciar(id) {
            fetch(`/divorciar/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },

                })
                .then(response => response.json())
                .then(data => {
                    location.href = '/vista/visualizar/divorcios'
                })
                .catch(err => {
                    console.error(err)
                });
        }
    </script>

</body>

</html>
