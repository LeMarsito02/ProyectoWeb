<!DOCTYPE html>
<html>
<head>
    <title>PAPA'S PIZZERIA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
</head>
<body>
<header>
    <nav class="sidebar">
        <div class="logo">
            <img src="Assets/Menu/logo.png" alt="Logo">
        </div>
        <ul class="menu">
            <li class="menu-item active">
                <a href="{{ route('index') }}">
                    <img src="Assets/Menu/casaicon.png" alt="Home">
                    <span>Inicio</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('menu') }}">
                    <img src="Assets/Menu/menuicon.png" alt="Menu">
                    <span>Menu</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('contacto') }}">
                    <img src="Assets/Menu/nosotros.png" alt="Order">
                    <span>Nosotros</span>
                </a>
            </li>
            @auth
            <li class="menu-item">
                <a href="{{ route('dashboard') }}">
                    <img src="Assets/Menu/dashboardicon.png" alt="Dashboard">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('logout') }}">
                    <img src="Assets/Menu/logouticon.png" alt="Logout">
                    <span>Salir</span>
                </a>
            </li>
            @endauth
        </ul>
        <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" style="text-decoration: none; color: inherit;">
            <div class="profile">
                <img src="{{ asset('Assets/Menu/anon.png') }}" alt="Profile Image">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                @else
                    <span>Usuario sin sesión iniciada</span>
                @endauth
            </div>
        </a>
    </nav>
</header>
<main class="dashboard-main">
    <div class="dashboard-container">
        <h2 class="dashboard-title">Dashboard de Pedidos</h2>

        <!-- Filtro de estado -->
        <div class="filter">
            <label for="estado-filter">Filtrar por estado:</label>
            <select id="estado-filter">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="en_proceso">En Proceso</option>
                <option value="completado">Completado</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>

        <!-- Filtro de cliente -->
        <div class="filter">
            <label for="cliente-filter">Filtrar por cliente:</label>
            <input type="text" id="cliente-filter" placeholder="Buscar cliente...">
        </div>

        <!-- Tabla de Pedidos -->
        <div id="loading-filtro" style="display: none;">Cargando...</div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="pedidos-tbody">
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->name }}</td>
                    <td>
                        <select class="estado-select" data-id="{{ $pedido->id }}">
                            <option value="pendiente" {{ $pedido->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ $pedido->status == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="completado" {{ $pedido->status == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelado" {{ $pedido->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </td>
                    <td>${{ number_format($pedido->total, 2) }}</td>
                    <td>
                        <button class="dashboard-btn ver-detalles" data-id="{{ $pedido->id }}">Ver Detalles</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Detalles del Pedido -->
        <div id="dashboard-detalles-pedido" style="display: none;">
            <h3>Detalles del Pedido</h3>
            <p><strong>Cliente:</strong> <span id="dashboard-cliente-nombre"></span></p>
            <p><strong>Teléfono:</strong> <span id="dashboard-cliente-telefono"></span></p>
            <p><strong>Dirección:</strong> <span id="dashboard-cliente-direccion"></span></p>
            <h4>Productos</h4>
            <ul id="dashboard-productos-lista"></ul>
            <p><strong>Total:</strong> $<span id="dashboard-pedido-total"></span></p>
        </div>
        <div id="loading" style="display: none;">Cargando...</div>
    </div>
</main>
<footer class="footer">
    <div class="contacto">
        <h3>Información de Contacto</h3>
        <p>Teléfono: #####</p>
        <p>Email: contacto@papaspizzeria.com</p>
        <p>Dirección: Calle 143#76b27, Ciudad Bogotá, País Colombia</p>
    </div>
    <div class="redes-sociales">
        <h3>Síguenos en:</h3>
        <a href="#"><img src="Assets/iconlogos/face.png" alt="Facebook"></a>
        <a href="#"><img src="Assets/iconlogos/x.png" alt="Twitter"></a>
        <a href="#"><img src="Assets/iconlogos/ig.jpg" alt="Instagram"></a>
    </div>
</footer>
</body>
</html>
