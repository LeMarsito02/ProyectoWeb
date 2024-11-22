<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="register-container">
        <h1>REGISTRO</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Campo para nombre completo -->
            <div class="input-group">
                <label for="name">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Campo para nombre de usuario -->
            <div class="input-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            </div>

            <!-- Campo para correo electrónico -->
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Campo para la contraseña -->
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Campo para confirmar la contraseña -->
            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="buttons">
                <button type="button" class="btn-login" onclick="window.location.href='{{ route('login') }}'">Iniciar Sesión</button>
                <button type="submit" class="btn-register">Registrar</button>
            </div>

            <!-- Mostrar los errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mostrar mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
        </form>
    </div>
</body>
</html>
