<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="/SISTEMA_PROYECTO/styles/estiloPgPrnl.css">

<nav>
    <fieldset>
        <a href="/SISTEMA_PROYECTO/Ptlprpl.php">
            <img src="/SISTEMA_PROYECTO/styles/images/logo.svg" alt="Logo" width="65" height="30">
        </a>
        <a href="productos.php">CATÁLOGO</a>
        <a href="#">ACCESORIOS</a>
        <a href="#">NOSOTROS</a>

        <div class="busqueda">
            <form action="/buscar" method="get">
                <input type="search" name="q" placeholder="Buscar">
                <button type="submit">🔍</button>
            </form>
        </div>

        <!-- SOLO ADMINISTRADOR PUEDE VER ESTA OPCIÓN -->
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
            <a href="/SISTEMA_PROYECTO/inicio.php">ADM</a>
        <?php endif; ?>

        <div class="usuario-menu">
            <?php if (isset($_SESSION['usuario'])): ?>
                <div class="dropdown">
                    <button class="dropdown-toggle"><?php echo htmlspecialchars($_SESSION['usuario']); ?> ⌄</button>
                    <div class="dropdown-content">
                        <a href="/SISTEMA_PROYECTO/cerrar_sesion.php">Cerrar sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/SISTEMA_PROYECTO/cerrar_sesion.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </fieldset>
</nav>
