<nav class="navbar navbar-expand-lg fondoVioleta">

    <!-- Logo -->
    <a class="navbar-brand" href="./">
    <i class="fas fa-shopping-cart" style="color:white"></i>
        <span style="color: white;">
            <?= session()->get('sistema') ?>
        </span>
    </a>

    <!-- Boton menú responsive -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>

    <!-- Elementos del menú -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav">
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='<?= HOME_PATH . 'clientes' ?>' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Productos
                </a>
                <div class='dropdown-menu dropdown-menu-center' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'productos' ?>'>
                        <?= 'Productos'?>
                    </a>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'productos_stock' ?>'>
                        <?= 'Productos stock'?>
                    </a>
                </div>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='<?= HOME_PATH . 'clientes' ?>' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Pedidos
                </a>
                <div class='dropdown-menu dropdown-menu-center' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'pedidos' ?>'>
                       Pedidos
                    </a>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'productos_pedidos' ?>'>
                        Productos pedidos (Fábrica)
                    </a>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'productos_pedidos_todos' ?>'>
                        Productos pedidos
                    </a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav mr-col-3">
            <li class='nav-item '>
                <a class='nav-link' href='<?= HOME_PATH . 'clientes' ?>'>
                    <?= 'Clientes'?>
                </a>
             </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class='nav-item '>
                <a class='nav-link' href='<?= HOME_PATH . 'usuarios' ?>'>
                    <?= 'Usuarios'?>
                </a>
             </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-user'></i><?= ' '.session()->get('nombre_usuario') ?>
                </a>
                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='<?= HOME_PATH . 'logout' ?>'>
                        Cerrar sesión <i class='fas fa-sign-out-alt'></i>
                    </a>
                </div>
            </li>
        </ul>

    </div>
</nav>

<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">
        <img src="../../public/img/er.svg" width="30" height="30" alt="">
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown" id="nav_li_telegramas">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-file-alt"></i> ACCIONES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class='dropdown-item' href='#'>
                        Nuevo <i class='fas fa-plus'></i> <i class='far fa-file-alt'></i>
                    </a>

                </div>

            </li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <i class='fas fa-user'></i> <?php echo $user_name; ?>
                </a>
                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='../../app/routes.php?peticion=AuthLogout'>
                        Cerrar sesión <i class='fas fa-sign-out-alt'></i>
                    </a>
                </div>
            </li>

        </ul>
    </div>

</nav>
-->