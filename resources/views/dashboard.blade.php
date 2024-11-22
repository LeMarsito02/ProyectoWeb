<!DOCTYPE html>
<html>
  <head>
    <title>PAPA'S PIZZERIA</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/style.css') }}">
    <script src="script.js"></script>
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
              <!-- Solo visible para usuarios autenticados -->
              <li class="menu-item">
                  <a href="{{ route('dashboard') }}">
                      <img src="Assets/Menu/dashboardicon.png" alt="Dashboard">
                      <span>Dashboard</span>
                  </a>
              </li>
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
    <main class="dashboard-main">
        <div class="dashboard-container">
            <h2 class="dashboard-title">Dashboard de Pedidos</h2>

            <!-- Tabla de Pedidos -->
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
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->cliente->name }}</td>
                        <td>{{ $pedido->status }}</td>
                        <td>${{ number_format($pedido->total, 2) }}</td>
                        <td>
                            <button class="dashboard-btn dashboard-btn-info ver-detalles" data-id="{{ $pedido->id }}">Ver Detalles</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Sección de Detalles del Pedido -->
            <div id="dashboard-detalles-pedido" style="display: none;">
                <h3 class="dashboard-subtitle">Detalles del Pedido</h3>
                <p><strong>Cliente:</strong> <span id="dashboard-cliente-nombre"></span></p>
                <p><strong>Teléfono:</strong> <span id="dashboard-cliente-telefono"></span></p>
                <p><strong>Dirección:</strong> <span id="dashboard-cliente-direccion"></span></p>
                <h4 class="dashboard-productos-title">Productos</h4>
                <ul id="dashboard-productos-lista"></ul>
                <p><strong>Total:</strong> $<span id="dashboard-pedido-total"></span></p>
            </div>
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

  <script>
    document.querySelectorAll('.ver-detalles').forEach(button => {
        button.addEventListener('click', function() {
            const pedidoId = this.dataset.id;

            fetch(`/dashboard/pedido/${pedidoId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cliente-nombre').innerText = data.cliente.name;
                    document.getElementById('cliente-telefono').innerText = data.cliente.phone;
                    document.getElementById('cliente-direccion').innerText = data.cliente.address;

                    const productosLista = document.getElementById('productos-lista');
                    productosLista.innerHTML = '';
                    data.productos.forEach(producto => {
                        productosLista.innerHTML += `<li>${producto.name} - Cantidad: ${producto.pivot.quantity}, Subtotal: $${producto.pivot.subtotal}</li>`;
                    });

                    document.getElementById('pedido-total').innerText = data.total;

                    document.getElementById('detalles-pedido').style.display = 'block';
                });
        });
    });
    </script>
</html>
