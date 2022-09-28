<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h3>SOLTEROS</h3>
        <p>Seleccione un Hombre:</p>
        <select class="form-select" id="id_hombre" aria-label="hombre">
            @foreach ($hombres as $soltero)
                <option selected value={{ $soltero->id }}>{{ $soltero->nombre }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <p>Seleccione una Mujer:</p>
        <select class="form-select" id="id_mujer" aria-label="mujer">
            @foreach ($mujeres as $soltera)
                <option selected value={{ $soltera->id }}>{{ $soltera->nombre }}</option>
            @endforeach
        </select>
        <br>
        <button class="btn btn-primary" onclick="casar()">Casar</button>

    </div>


</body>

<script>
    function casar() {
        let id_hombre = document.getElementById('id_hombre').value;
        let id_mujer = document.getElementById('id_mujer').value;

        if (!id_hombre || !id_mujer) {
            alert('Debe seleccionar ambos campos');
            return;
        }

        fetch('/casar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id_hombre,
                    id_mujer,
                })
            })
            .then(response => response.json())
            .then(data => {
                location.href = "/vista/ver/casados";
            })
            .catch(err => {
                console.error(err)
            });

    }
</script>

</html>
