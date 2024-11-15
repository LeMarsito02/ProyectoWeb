<!DOCTYPE html>
<html>
  <head>
    <title>PAPA'S PIZZERIA</title>
    <link rel="stylesheet" href="Style.css">
    <meta charset="UTF-8">
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
          </ul>
          <div class="profile">
              <img src="Assets/Menu/anon.png" alt="Profile Image">
              <span>Usuario sin sesion iniciada</span>
          </div>
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
  