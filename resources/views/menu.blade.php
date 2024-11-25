<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <!-- Ruta al CSS -->
    <link rel="stylesheet" href="css/Style.css">
    <!-- Ruta al JS -->
    <script src="js/elcarrito.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
        <nav class="sidebar">
            <div class="logo">
                <img src="{{ asset('Assets/Menu/logo.png') }}" alt="Logo">
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="{{ route('index') }}"><img src="{{ asset('Assets/Menu/casaicon.png') }}" alt="Home"><span>Inicio</span></a></li>
                <li class="menu-item active"><a href="{{ route('menu') }}"><img src="{{ asset('Assets/Menu/menuicon.png') }}" alt="Menu"><span>Menu</span></a></li>
                <li class="menu-item"><a href="{{ route('contacto') }}"><img src="{{ asset('Assets/Menu/nosotros.png') }}" alt="Order"><span>Nosotros</span></a></li>
                @auth
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}">
                            <img src="Assets/Menu/dashboardicon.png" alt="Dashboard">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item"><a href="{{ route('logout') }}"><img src="Assets/Menu/logouticon.png" alt="Logout"><span>Salir</span></a> </li>
                @endauth
            </ul>
            <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" style="text-decoration: none; color: inherit;">
                <div class="profile">
                    <img src="{{ asset('Assets/Menu/anon.png') }}" alt="Profile Image">
                    @auth
                        <!-- Usuario autenticado -->
                        <span>{{ Auth::user()->name }}</span>
                    @else
                        <!-- Usuario no autenticado -->
                        <span>Usuario sin sesión iniciada</span>
                    @endauth
                </div>
            </a>

        </nav>
    </header>

    <main class="container">
        <div class="menuProductos">
            <div class="search-bar">
                <span class="out-of-stock">Papa´s Pizzería Menú</span>
            </div>
            <div class="categories">
                <button class="category active" data-category="pizza" onclick="filterCategory('pizza')">Pizza</button>
                <button class="category" data-category="drinks" onclick="filterCategory('drinks')">Bebidas</button>
                <button class="category" data-category="dessert" onclick="filterCategory('dessert')">Postres</button>
            </div>
            <div id="loading" style="display: none;">
                <p>Cargando...</p>
                <div class="spinner"></div>
            </div>
            <div class="menu-items" id="menu-items">
                <!-- Items will be dynamically generated here -->
            </div>
        </div>

        <div class="order-summary">
            <h2>Tu carrito de compras :D</h2>
            <div id="order-items">
                <!-- Order Items will be dynamically added here -->
            </div>
            <div class="customer-info">
                <label for="customer-name">Nombre del Cliente:</label>
                <input type="text" id="customer-name" placeholder="Ingresa tu nombre" />
        
                <label for="customer-phone">Teléfono del Cliente:</label>
                <input type="tel" id="customer-phone" placeholder="Ingresa tu teléfono" />
        
                <label for="customer-address">Dirección del Cliente:</label>
                <input type="text" id="customer-address" placeholder="Ingresa tu dirección" />
            </div>

            <div class="delivery-options">
                <button class="delivery-btn active" onclick="setDeliveryOption('pickup')">Recoger en restaurante</button>
                <button class="delivery-btn" onclick="setDeliveryOption('delivery')">A Domicilio</button>
            </div>

            <div class="summary">
                <p>Productos: (<span id="item-count">0</span>) <span id="item-total">$0.00</span></p>
                <p>IVA (10%) <span id="tax-amount">$0.00</span></p>
                <h3>Total <span id="total-amount">$0.00</span></h3>
                <button class="print-btn" onclick="printBill()">Imprimir Factura</button>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="contacto">
            <h3>Información de Contacto</h3>
            <p>Teléfono: #####</p>
            <p>Email: contacto@papaspizzeria.com</p>
            <p>Dirección: Calle 143#76b27, Bogotá, Colombia</p>
        </div>
        <div class="redes-sociales">
            <h3>Síguenos en:</h3>
            <a href="#"><img src="{{ asset('Assets/iconlogos/face.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('Assets/iconlogos/x.png') }}" alt="Twitter"></a>
            <a href="#"><img src="{{ asset('Assets/iconlogos/ig.jpg') }}" alt="Instagram"></a>
        </div>
    </footer>
</body>
</html>
