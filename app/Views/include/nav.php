<header>
    <div class="text-center py-3 header-top">
        <span><b>SONHE, PLANEJE E REALIZE!</b></span>
    </div>
    <div class="border-header"></div>

    <div class="container d-flex justify-content-between align-items-center my-4">
        <form action="" action="" class="w-25 form-search-nav" style="position: relative">
            <input type="search" class="input-navegacao" name="pesquisa-nav" placeholder="Buscar">
            <img src="assets/icons/lupa.png" style="position: absolute; top: 50%; right: 120px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone Search" />
        </form>

        <div class="w-50 text-center box-logo-header">
            <img class="" src="assets/img/logo-projeto.png" alt="">
        </div>

        <div class="d-flex w-25 justify-content-end content-icons-nav content-icons-nav-desktop">
            <a href="" class="d-flex flex-column align-items-center">
                <img src="assets/icons/carrinho-compras.png" alt="" class="icon-nav" style="width: 32px">
                carrinho
            </a>
            
            <!-- SEM LOGIN -->
            <?php if (!session()->has('usuario')): ?>
            <a href="" class="d-flex flex-column align-items-center">
                <img src="assets/icons/user.png" alt=""  class="icon-nav" style="width: 32px">
                iniciar sessão
            </a>

            <!-- COM LOGIN -->
            <?php else: ?>
            <a href="" class="d-flex flex-column align-items-center">
                <img src="assets/icons/user.png" alt=""  class="icon-nav" style="width: 32px">
                profile
            </a>
            <?php endif; ?>
            
            <a href="user/logout">Logout</a>

            

        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="wrapper">
                <div class="header-item-left  content-icons-nav content-icons-nav-mobile">
                    <!-- por ícone projeto no mobile (apenas) -->
                    <!-- <a href="#" class="brand"><img src="assets/img/logo-projeto.png" alt="" style="width: 120px;"></a> -->
                    <a href="" class="d-flex flex-column align-items-center">
                        <img src="assets/icons/carrinho-compras.png" alt="" class="icon-nav" style="width: 32px">
                        carrinho
                    </a>
                    <!-- SEM LOGIN -->
                    <?php if (!session()->has('usuario')): ?>
                    <a href="" class="d-flex flex-column align-items-center">
                        <img src="assets/icons/user.png" alt=""  class="icon-nav" style="width: 32px">
                        iniciar sessão
                    </a>

                    <!-- COM LOGIN -->
                    <?php else: ?>
                    <a href="" class="d-flex flex-column align-items-center">
                        <img src="assets/icons/user.png" alt=""  class="icon-nav" style="width: 32px">
                        profile
                    </a>
                    <?php endif; ?>
                </div>
                <div class="header-item-center">
                    <div class="overlay"></div>
                    <nav class="menu">
                        <div class="menu-mobile-header">
                            <!-- por icone menu -->
                            <button type="button" class="menu-mobile-arrow">
                                <img src="assets/icons/back.png" alt="" style="width: 32px;">
                            </button>
                            <div class="menu-mobile-title"></div>
                                <button type="button" class="menu-mobile-close">
                                    <!-- <i class="ion ion-ios-close"></i> -->
                                    <img src="assets/icons/close.png" alt="" style="width: 32px;">
                                </button>
                        </div>
                        <ul class="menu-section menu-nav">
                            <!-- <li><a href="#">Home</a></li> -->

                            <li class="menu-item-has-children">
                                <a href="#">PLANNERS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#">Item 01</a></li>
                                        <li><a href="#">Item 02</a></li>
                                        <li><a href="#">Item 03</a></li>
                                        <li><a href="#">Item 04</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">AGENDA<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#">Item 01</a></li>
                                        <li><a href="#">Item 02</a></li>
                                        <li><a href="#">Item 03</a></li>
                                        <li><a href="#">Item 04</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">BLOCO DE NOTAS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#">Item 01</a></li>
                                        <li><a href="#">Item 02</a></li>
                                        <li><a href="#">Item 03</a></li>
                                        <li><a href="#">Item 04</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">CADERNOS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#">Item 01</a></li>
                                        <li><a href="#">Item 02</a></li>
                                        <li><a href="#">Item 03</a></li>
                                        <li><a href="#">Item 04</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">PRONTA ENTREGA<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#">Item 01</a></li>
                                        <li><a href="#">Item 02</a></li>
                                        <li><a href="#">Item 03</a></li>
                                        <li><a href="#">Item 04</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="header-item-right">
                    <a href="#" class="menu-icon"><i class="ion ion-md-search"></i></a>
                    <a href="#" class="menu-icon"><i class="ion ion-md-heart"></i></a>
                    <a href="#" class="menu-icon"><i class="ion ion-md-cart"></i></a>
                    <button type="button" class="menu-mobile-trigger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
                </div>
            </div>
        </div>
    </header>
</header>