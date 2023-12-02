<footer class="py-5">
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <h5 class="link-footer">INFORMAÇÕES</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="/politicas/politica-loja" class="nav-link p-0 text-body-secondary">Política da Loja</a></li>
          <li class="nav-item mb-2"><a href="/politicas/politica-privacidade" class="nav-link p-0 text-body-secondary">Política de Privacidade</a></li>
        </ul>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <h5 class="link-footer">INSTITUCIONAL</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="/politicas/quem-somos" class="nav-link p-0 text-body-secondary">Quem Somos</a></li>
          <li class="nav-item mb-2"><a href="/depoimentos-clientes" class="nav-link p-0 text-body-secondary">Depoimentos</a></li>
        </ul>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <h5 class="link-footer">MINHA CONTA</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="/perfil/perfil-usuario" class="nav-link p-0 text-body-secondary">Meu perfil</a></li>
          <li class="nav-item mb-2"><a href="/carrinho" class="nav-link p-0 text-body-secondary">Carrinho</a></li>
        </ul>
      </div>

      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <h5 class="link-footer">CONTATO</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a class="nav-link p-0 text-body-secondary">Seg à Sex - das 9h as 17h </a></li>
          <li class="nav-item mb-2"><a href="https://wa.me/5515991263437" target="_blank" class="nav-link p-0 text-body-secondary">Whatsapp (15)99126-3437</a></li>
          <li class="nav-item mb-2"><a  href="mailto:plannerbymarilia@gmail.com" class="nav-link p-0 text-body-secondary">planner.bymarilia@gmail.com</a></li>
        </ul>
      </div>
    </div>
    <!-- ../row -->
    <br>
    <hr>
    <p class="mb-1 text-center">&copy; 2023 Planner by Marília</p>

  </div>
</footer>

<div class="whats">
  <a href="https://wa.me/5515991263437" target="_blank">
    <img src="<?= base_url('assets/img/whatsapp.png') ?>" alt="Fale Conosco pelo Whatsapp" width="50">
  </a>

</div>

<!-- mensagem pop-up adicioanndo item carrinho -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-cart" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Produto adicionado no carrinho.
        <br><a href="<?= base_url('/carrinho') ?>" class="p-small" style="text-decoration: underline">Clique aqui</a> e acesse o seu carrinho!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up precisa fazer login quando clicado em carrinho-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-login" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Você precisa fazer login para adicionar um item no carrinho.
        <br><a href="<?= base_url('/login') ?>" class="p-small" style="text-decoration: underline">Clique aqui</a> para fazer o login.
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up precisa fazer login quando clicado em depoimentos-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-login-depoimentos" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Você precisa fazer login para adicionar um depoimento.
        <br><a href="<?= base_url('/login') ?>" class="p-small" style="text-decoration: underline">Clique aqui</a> para fazer o login.
      </p>
    </div>
  </div>
</div>

<!-- mensagem que código foi copiado -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-copy-coadigo" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Código copiado
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up exclusao categoria-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-exclusao-categoria" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Categoria removida com sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up exclusao produto-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-exclusao-produto" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Produto removido com sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up exclusao usuario-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-exclusao-usuario" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Usuario removido com sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up exclusao usuario-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-exclusao-opcoes-adicionais" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Adicional removido com sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up alteração usuario logado-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-alterar-usuario-logado" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Suas informações foram alteradas com sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up alteração usuario logado-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-alterar-senha-usuario-logado" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Sua Senha foi alterada com Sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up desativar capa produto-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-exclusao-capa-produto" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
        Capa do produto desativada com Sucesso!
      </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up alterar quantidade estoque-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-alterar-quantidade-estoque" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
      Estoque alterado com sucesso!
    </p>
    </div>
  </div>
</div>

<!-- mensagem pop-up desativar depoimento -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="open-toast-desativar-depoimento" class="toast bg-light" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="<?= base_url('favicon.ico') ?>" class="rounded me-2" alt="...">
      <strong class="me-auto">Planner By marília</strong>
      <small>Agora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <p class="p-small">
      Depoimento desativado!
    </p>
    </div>
  </div>
</div>