<!DOCTYPE html>
<html>
  <head>
    <title>PAPA'S PIZZERIA</title>
    <link rel="stylesheet" href="Style.css">
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body> 
    <header>
      <nav class="sidebar">
          <div class="logo">
              <img src="Assets/Menu/logo.png" alt="Logo">
          </div>
          <ul class="menu">
              <li class="menu-item active"><a href={{ route('index') }}><img src="Assets/Menu/casaicon.png" alt="Home"><span>Inicio</span></a></li>
              <li class="menu-item"><a href="{{ route('menu') }}"><img src="Assets/Menu/menuicon.png" alt="Menu"><span>Menu</span></a></li>
              <li class="menu-item"><a href="{{ route('contacto') }}"><img src="Assets/Menu/nosotros.png" alt="Order"><span>Nosotros</span></a></li>
              @auth
              <!-- Solo visible para usuarios autenticados -->
              <li class="menu-item">
                  <a href="{{ route('dashboard') }}">
                      <img src="Assets/Menu/dashboardicon.png" alt="Dashboard">
                      <span>Dashboard</span>
                  </a>
              </li>
              <li class="menu-item">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <img src="Assets/Menu/logouticon.png" alt="Logout"><span>Salir</span>
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
    <main class="izquierda">
     @yield(section: 'content')

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
        <a href=  "#"><img src="Assets/iconlogos/face.png" alt="Facebook"></a>
        <a href="#"><img src="Assets/iconlogos/x.png" alt="Twitter"></a>
        <a href="#"><img src="Assets/iconlogos/ig.jpg" alt="Instagram"></a>
      </div>
    </footer>
  </body>
</html>
  