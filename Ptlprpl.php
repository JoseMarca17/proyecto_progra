<?php session_start();
include("header.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloPgPrnl.css">
    <title>S N A</title>
</head>
<body>
    <section class="hero">
  <div class="carrusel">
    <div class="slides">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
      <img src="images/logocae2.png" alt="foto">
      <img src="images/logocar1.png" alt="foto 2">
      <img src="images/logocar3.png" alt="foto 3">
    </div>
  </div>
  
  <div class="hero-texto">
    <h1>¡Bienvenido a SNV!</h1>
    <p>Encuentra las mejores ofertas en ropa urbana y accesorios</p>
    <a href="/productos" class="btn">Comprar ahora</a>
  </div>
</section>

<section class="categorias">
    <h2>Categorías</h2>
    <div class="grid-categorias">
    <a href="/hombre">Hombre</a>
    <a href="/mujer">Mujer</a>
    <a href="/accesorios">Accesorios</a>
    <a href="/ofertas">Ofertas</a>
    </div>
</section>

<section class="destacados">
  <h2>Nuevos ingresos</h2>
  <div class="productos-grid">
    <!-- Repite por producto -->
    <div class="producto">
      <h3>Zapatillas Urbanas</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Camiseta</h3>
      <p>Bs. 230</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Falda</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Chaqueta</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Jersey</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Gorro</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Bikini</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Pantalon</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
    <div class="producto">
      <h3>Vestido</h3>
      <p>Bs. 220</p>
      <button>Agregar al carrito</button>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer-contenido">
    <div class="footer-logo">
      <h3>S N A</h3>
      <p>Tienda de ropa urbana y accesorios</p>
    </div>
    
    <div class="footer-links">
      <h4>Secciones</h4>
      <a href="#">Productos</a>
      <a href="#">Ofertas</a>
      <a href="#">Novedades</a>
      <a href="#">Contacto</a>
    </div>

    <div class="footer-social">
      <h4>Síguenos</h4>
      <a href="#">Instagram</a>
      <a href="#">Facebook</a>
      <a href="#">TikTok</a>
    </div>
  </div>

  <div class="footer-copy">
    <p>&copy; 2025 SNA - Todos los derechos reservados</p>
  </div>
</footer>


    
</body>
</html>