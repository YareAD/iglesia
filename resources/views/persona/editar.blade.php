<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container mt-5">

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" id="id" disabled value="{{ $persona->id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" value="{{ $persona->nombre }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Edad:</label>
            <input type="number" class="form-control" id="edad" value="{{ $persona->edad }}">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" value="M"
                {{ $persona->sexo == 'M' ? 'checked' : '' }}>
            <label class="form-check-label" for="mujer">
                Mujer
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" value="H"
                {{ $persona->sexo == 'H' ? 'checked' : '' }}>
            <label class="form-check-label" for="hombre">
                Hombre
            </label>
        </div>
        <br>


        <select class="form-select" id="estado_civil" aria-label="estado_civil">
            <option {{ $persona->estado_civil == 'SOLTERO' ? 'selected' : '' }} value="SOLTERO">SOLTERO</option>
            <option {{ $persona->estado_civil == 'CASADO' ? 'selected' : '' }} value="CASADO">CASADO</option>
        </select>
        <br>
        <button class="btn btn-warning" onclick="editar()">EDITAR</button>

    </div>

</body>

<script>
    function editar() {
        const id = document.getElementById('id').value;
        const nombre = document.getElementById('nombre').value;
        const edad = document.getElementById('edad').value;
        const sexo = document.querySelector('input[name="sexo"]:checked').value;
        const estado_civil = document.getElementById('estado_civil').value;

        if (nombre.length < 6) {
            alert('El nombre es requerido con mas de 6 caracteres');
            return;
        }

        if (Number(edad) < 18) {
            alert('Debe ser mayor a 18 años');
            return;
        }


        fetch(`/editar/persona/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id,
                    nombre,
                    edad,
                    sexo,
                    estado_civil
                })
            })
            .then(response => response.json())
            .then(data => {
                location.href = "/vista/visualizar/personas";
            })
            .catch(err => {
                console.error(err)
            });

    }
</script>

</html>
