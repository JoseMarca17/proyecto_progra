<link rel="stylesheet" href="styles/estiloPgPrnl.css">
<header>
    <nav>
        <fieldset>
            <img src="images/logo1.jpg" alt="" width="65" height="30">
            <a href="#">NOVEDADES</a>
            <a href="#">ACCESORIOS</a>
            <a href="#">NOSOTROS</a>
            <div class="busqueda">
                <form action="/buscar" method="get">
                    <input type="search" name="q" placeholder="Buscar">
                    <button type="submit">🔍</button>
                </form>
            </div>
<<<<<<< HEAD
            <a href="#">ADM</a>
            <div class="usuario-menu">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="dropdown">
                        <button class="dropdown-toggle"><?php echo $_SESSION['usuario']; ?></button>
                        <div class="dropdown-content">
                            <a href="cerrar_sesion.php">Cerrar sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php">CERRAR SESION</a>
                <?php endif; ?>
            </div>
        </fieldset>
    </nav>
=======
            <div class="navegar">CUENTA</div>
            <div class="navegar">CARRITO</div>
            <div class="navegar" onclick="window.location.href='carrito.php'">CARRITO</div>


        </div>
    </div>
>>>>>>> 68282ab5b397aa2f71f372098f4e4956b178e692
</header>