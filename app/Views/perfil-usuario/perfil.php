<?php
$data['title'] = "Perfil Usuário";
$data['link_css'] = "assets/css/perfil.css";
?>

<?= view("include/head", $data) ?>

<?= view("include/nav") ?>

    <main class="container my-5">
        <input class="tab-perfil" id="tab1" type="radio" name="tabs" checked>
        <label class="label-tab" for="tab1">Minhas informações</label>
            
        <input class="tab-perfil" id="tab2" type="radio" name="tabs">
        <label class="label-tab" for="tab2">Meus dados de usuário</label>
            
        <input class="tab-perfil" id="tab3" type="radio" name="tabs">
        <label class="label-tab" for="tab3">Meus depoimentos</label>
            
        <input class="tab-perfil" id="tab4" type="radio" name="tabs">
        <label class="label-tab" for="tab4">Minhas compras</label>
            
        <section id="content1">
            <?= view("perfil-usuario/include/minhas-informacoes", $usuario_selecionado) ?>
        </section>
            
        <section id="content2">
            <?= view("perfil-usuario/include/dados-usuario",) ?>
        </section>
            
        <section id="content3">
            <?= view("perfil-usuario/include/meus-depoimentos", $depoimentos_usuario) ?>
        </section>
            
        <section id="content4">
            <?= view("perfil-usuario/include/minhas-compras") ?>
        </section>
    </main>

<?= view("include/footer") ?>

<?= view("include/scripts") ?>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        selecionarTabComBaseNoHash();
    })


    // Função para adicionar um hash à URL
    function adicionarHashNaURL(hash) {
        // Atualiza a URL sem causar um carregamento de página
        history.pushState({}, '', window.location.pathname + '#' + hash);
    }

    // Função para selecionar o tab com base no hash na URL
    function selecionarTabComBaseNoHash() {
        if (window.location.hash) {
            // Obtém o hash da URL (excluindo o caractere #)
            var hash = window.location.hash.substring(1);

            // Seleciona o input correspondente ao hash
            var targetInput = document.getElementById(hash);
            if (targetInput) {
                // Esconde o conteúdo do tab atual
                esconderConteudoAtual();

                // Marca o input como selecionado
                targetInput.checked = true;

                // Atualiza o valor do parâmetro 'tab' na URL
                adicionarHashNaURL(hash);

                // Exibe o conteúdo do tab correspondente
                exibirConteudoDoTab(hash);
            }
        }
    }

    // Função para esconder o conteúdo do tab atual
    function esconderConteudoAtual() {
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.removeAttribute('checked');
        });
    }

    // Função para exibir o conteúdo do tab correspondente
    function exibirConteudoDoTab(tabId) {
        // Exibe o conteúdo do tab correspondente
        var targetContent = document.getElementById('content' + tabId.replace('tab', ''));
        if (targetContent) {
            targetContent.setAttribute('checked')
        }
    }

    // Adicione este código ao seu código existente para lidar com a mudança de tabs
    const tabs = document.querySelectorAll('.tab-perfil');
    tabs.forEach(function(el) {
        el.addEventListener('change', function() {
            // Obtém o valor do tab selecionado
            var tabValue = el.id;

            // Esconde o conteúdo do tab atual
            esconderConteudoAtual();

            // Adiciona o hash à URL
            adicionarHashNaURL(tabValue);

            // Exibe o conteúdo do tab correspondente
            exibirConteudoDoTab(tabValue);
        });
    });




</script>