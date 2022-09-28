<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container d-flex  flex-column justify-content-center align-items-center min-vh-100">
        <div>
            <img src="/images/anillos.jpeg" style="width: 200px;height:200px;" alt="">
        </div>
        <form id="formRegistro" onsubmit="registrar(event)">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Email address</label>
                <input type="password" class="form-control" id="password" placeholder="********" required>
            </div>
            <div class="mx-auto d-grid">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

        <div class="mt-5">
            <a href="/vista/iniciar-sesion">Inicia sesion</a>
        </div>

    </div>

    <script>
        function registrar(e) {
            e.preventDefault();

            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('/registro', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre,
                        email,
                        password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    location.href = "/vista/iniciar-sesion";
                })
                .catch(err => {
                    console.error(err)
                });

        }
    </script>
</body>

</html>
