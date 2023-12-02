<?php
$data['link_css'] = "assets/css/nav.css";

?>

<header>
    <!-- <div class="text-center py-3 header-top">
        <span id="mensagem" class="mensagem"><b>SONHE, PLANEJE E REALIZE!</b></span>
    <div class="text-center py-1 header-top">
        <span>SONHE, PLANEJE E REALIZE!</span>
    </div>
    <div class="border-header"></div> -->

    <div class="container d-flex justify-content-between align-items-center">
        <form method="GET" id="pesquisarNav" class="w-25 form-search-nav" style="position: relative">
            <div>
                <input type="search" class="input-navegacao" value="" name="pesquisa-nav" placeholder="Buscar">
                <img src="<?= base_url('assets/icons/lupa.png') ?>" style="position: absolute; top: 50%; right: 120px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone Search" />
            </div>
        </form>

        <div class="w-50 text-center box-logo-header">
            <a href="<?= base_url('') ?>">
                <img class="w-100" src="<?= base_url('assets/img/logo-2.png') ?>" alt="logo-projeto" style="max-width: 300px">
            </a>
        </div>

        <div class="d-flex w-25 justify-content-end content-icons-nav content-icons-nav-desktop">
            <!-- SEM LOGIN -->
            <?php if (!session()->has('usuario')) : ?>
                <a href="<?= base_url('login') ?>" class="d-flex flex-column align-items-center link-nav p-small">

                    <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav link-nav " style="width: 32px">
                    Login
                </a>

                <a href="<?= base_url('login/cadastro-usuario') ?>" class="d-flex flex-column align-items-center link-nav p-small">
                    <img src="<?= base_url('assets/icons/cadastro.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    Cadastrar-se
                </a>

                <!-- COM LOGIN -->
            <?php else : ?>
                <?php if (session()->get('nivel') == 1) : ?>
                    <a href="<?= base_url('carrinho') ?>" class="d-flex flex-column align-items-center">
                        <img src="<?= base_url('assets/icons/carrinho-compras.png') ?>" alt="" class="icon-nav" style="width: 32px">
                        Carrinho
                    </a>
                    <a href="<?= base_url('perfil/perfil-usuario') ?>" class="d-flex flex-column align-items-center">
                        <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                        Perfil
                    </a>
                <?php else : ?>
                    <a href="<?= base_url('/administrador/dashboard') ?>" class="d-flex flex-column align-items-center">
                        <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                        Painel Administrativo
                    </a>
                <?php endif; ?>
                <a href=<?= base_url('user/logout') ?> class="d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/icons/logout.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    Logout
                </a>
            <?php endif; ?>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="wrapper">
                <div class="header-item-left  content-icons-nav content-icons-nav-mobile">
                    <!-- SEM LOGIN -->
                    <?php if (!session()->has('usuario')) : ?>
                        <li class="visao-mobile-icons">
                            <a href="<?= base_url('login') ?>" class="d-flex flex-column align-items-center">
                                <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 24px">
                                <span class="p-small">Login</span>
                            </a>
                        </li>
                        <li class="visao-mobile-icons">
                            <a href="<?= base_url('login/cadastro-usuario') ?>" class="d-flex flex-column align-items-center">
                                <img src="<?= base_url('assets/icons/cadastro.png') ?>" alt="" class="icon-nav" style="width: 24px">
                                <span class="p-small">Cadastrar-se</span>
                            </a>
                        </li>

                        <!-- COM LOGIN -->
                    <?php else : ?>
                        <?php if (session()->get('nivel') == 1) : ?>
                            <li class="visao-mobile-icons">
                                <a href="<?= base_url('carrinho') ?>" class="d-flex flex-column align-items-center">
                                    <img src="<?= base_url('assets/icons/carrinho-compras.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                    <span class="p-small">Carrinho</span>
                                </a>
                            </li>
                            <li class="visao-mobile-icons">
                                <a href="<?= base_url('perfil/perfil-usuario') ?>" class="d-flex flex-column align-items-center">
                                    <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                    <span class="p-small">Perfil</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="visao-mobile-icons">
                                <a href="<?= base_url('/administrador/dashboard') ?>" class="d-flex flex-column align-items-center">
                                    <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                    <span class="p-small">Painel Administrativo</span>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>
                <div class="header-item-center">
                    <div class="overlay"></div>
                    <nav class="menu">
                        <div class="menu-mobile-header">
                            <!-- por icone menu -->
                            <button type="button" class="menu-mobile-arrow">
                                <img src="<?= base_url('assets/icons/back.png') ?>" alt="" style="width: 32px;">
                            </button>
                            <div class="menu-mobile-title"></div>
                            <button type="button" class="menu-mobile-close">
                                <!-- <i class="ion ion-ios-close"></i> -->
                                <img src="<?= base_url('assets/icons/close.png') ?>" alt="" style="width: 32px;">
                            </button>
                        </div>
                        <ul class="menu-section menu-nav">

                            <!-- SEM LOGIN -->
                            <?php if (!session()->has('usuario')) : ?>
                                <li class="visao-mobile-icons">
                                    <a href="<?= base_url('login') ?>" class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                        iniciar sessão
                                    </a>
                                </li>


                                <!-- COM LOGIN -->
                            <?php else : ?>
                                <?php if (session()->get('nivel') == 1) : ?>
                                    <li class="visao-mobile-icons">
                                        <a href="<?= base_url('carrinho') ?>" class="d-flex align-items-center gap-2">
                                            <img src="<?= base_url('assets/icons/carrinho-compras.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                            Carrinho de compras
                                        </a>
                                    </li>
                                    <li class="visao-mobile-icons">
                                        <a href="<?= base_url('perfil/perfil-usuario') ?>" class="d-flex align-items-center gap-2">
                                            <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                            Perfil
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li class="visao-mobile-icons">
                                        <a href="<?= base_url('/administrador/dashboard') ?>" class="d-flex align-items-center gap-2">
                                            <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                            Painel Administrativo
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="visao-mobile-icons">
                                    <a href="user/logout" class="d-flex align-items-center gap-2">
                                        <img src="<?= base_url('assets/icons/logout.png') ?>" alt="" class="icon-nav" style="width: 32px">
                                        Sair
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li class="menu-item-has-children">
                                <a href="#" class="p-small">PLANNERS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li class="nav-categorias"><a href="<?= base_url('/planners')   ?>" class="p-small">Ver planners</a></li>
                                        <li><a href="#" class="p-small">Planner Anual</a></li>
                                        <li><a href="#" class="p-small">Planner Mensal</a></li>
                                        <li><a href="#" class="p-small">Planner Diário</a></li>
                                        <li><a href="#" class="p-small">Planner Pet</a></li>
                                        <li><a href="#" class="p-small">Planner Financeiro</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#" class="p-small">AGENDA<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="<?= base_url('/agendas')  ?>" class="p-small">Ver agendas</a></li>
                                        <li><a href="#" class="p-small">Agenda Anual - 1 dia/pg</a></li>
                                        <li><a href="#" class="p-small">Agenda Anual - 2 dia/pg</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#" class="p-small">BLOCO DE NOTAS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="<?= base_url('/blocos')  ?>" class="p-small">Ver blocos</a></li>
                                        <li><a href="#" class="p-small">Bloco A6</a></li>
                                        <li><a href="#" class="p-small">Bloco Diário</a></li>
                                        <li><a href="#" class="p-small">Bloco Semanal</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#" class="p-small">CADERNOS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="<?= base_url('/cadernos')  ?>" class="p-small">Ver cadernos</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#" class="p-small">PRONTA ENTREGA<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li><a href="#" class="p-small">Lista de Tarefas</a></li>
                                        <li><a href="#" class="p-small">Lista de Compras</a></li>
                                        <li><a href="#" class="p-small">Bloco Diário</a></li>
                                        <li><a href="#" class="p-small">Bloco Semanal</a></li>
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