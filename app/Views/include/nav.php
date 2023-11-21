<?php
$data['link_css'] = "assets/css/nav.css";

?>

<header>
    <div class="text-center py-3 header-top">
        <span id="mensagem" class="mensagem"><b>SONHE, PLANEJE E REALIZE!</b></span>
    </div>
    <div class="border-header"></div>

    <div class="container d-flex justify-content-between align-items-center my-4">
        <form action="" action="" class="w-25 form-search-nav" style="position: relative">
            <input type="search" class="input-navegacao" name="pesquisa-nav" placeholder="Buscar">
            <img src="<?= base_url('assets/icons/lupa.png') ?>" style="position: absolute; top: 50%; right: 120px; transform: translateY(-50%); height: 20px; width: 20px;" alt="Ícone Search" />
        </form>

        <div class="w-50 text-center box-logo-header">
            <a href="<?= base_url('') ?>">
                <img class="" src="<?= base_url('assets/img/logo-projeto-svg.svg') ?>" alt="logo-projeto">
            </a>
        </div>

        <div class="d-flex w-25 justify-content-end content-icons-nav content-icons-nav-desktop">
            <!-- SEM LOGIN -->
            <?php if (!session()->has('usuario')) : ?>
                <a href="<?= base_url('login') ?>" class="d-flex flex-column align-items-center link-nav">
                    <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    Iniciar sessão
                </a>

                <a href="<?= base_url('login/cadastro-usuario') ?>" class="d-flex flex-column align-items-center link-nav">
                    <img src="<?= base_url('assets/icons/cadastro.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    Cadastrar
                </a>

                <!-- COM LOGIN -->
            <?php else : ?>
                <a href="<?= base_url('carrinho') ?>" class="d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/icons/carrinho-compras.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    carrinho
                </a>
                <a href="<?= base_url('perfil/perfil-usuario') ?>" class="d-flex flex-column align-items-center">
                    <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                    profile
                </a>
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
                    <!-- por ícone projeto no mobile (apenas) -->
                    <!-- <a href="#" class="brand"><img src="assets/img/logo-projeto.png" alt="" style="width: 120px;"></a> -->

                    <!-- SEM LOGIN -->
                    <?php if (!session()->has('usuario')) : ?>
                        <a href="<?= base_url('login') ?>" class="d-flex flex-column align-items-center">
                            <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                            iniciar sessão
                        </a>

                        <!-- COM LOGIN -->
                    <?php else : ?>
                        <a href="<?= base_url('carrinho') ?>" class="d-flex flex-column align-items-center">
                            <img src="<?= base_url('assets/icons/carrinho-compras.png') ?>" alt="" class="icon-nav" style="width: 32px">
                            carrinho
                        </a>
                        <a href="" class="d-flex flex-column align-items-center">
                            <img src="<?= base_url('assets/icons/user.png') ?>" alt="" class="icon-nav" style="width: 32px">
                            profile
                        </a>
                        <a href="user/logout" class="d-flex flex-column align-items-center">
                            <img src="<?= base_url('assets/icons/logout.png') ?>" alt="" class="icon-nav" style="width: 32px">
                            Logout
                        </a>
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
                            <!-- <li><a href="#">Home</a></li> -->

                            <li class="menu-item-has-children">
                                <a href="#">PLANNERS<img src="#" alt=""></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        <li class="nav-categorias"><a href="<?= base_url('/planners')  ?>">Ver planners</a></li>
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
                                        <li><a href="<?= base_url('/agendas')  ?>">Ver agendas</a></li>
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
                                        <li><a href="<?= base_url('/blocos')  ?>">Ver blocos</a></li>
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
                                        <li><a href="<?= base_url('/cadernos')  ?>">Ver cadernos</a></li>
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

<script>
    // Array com as mensagens
    const mensagens = [
        "SONHE, PLANEJE E REALIZE!",
        "ACREDITE NOS SEUS SONHOS E FAÇA ACONTECER!"
        // Adicione mais mensagens aqui se desejar
    ];

    // Função para alternar as mensagens a cada 10 segundos
    function alternarMensagem() {
        const mensagemElement = document.getElementById('mensagem');
        let index = 0;

        setInterval(() => {
            mensagemElement.innerHTML = `<b>${mensagens[index]}</b>`;
            index = (index + 1) % mensagens.length;
        }, 3000); // 10 segundos em milissegundos
    }

    // Chamar a função para começar a alternância das mensagens
    alternarMensagem();
</script>