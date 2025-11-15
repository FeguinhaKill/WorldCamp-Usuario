<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="text-center mb-4">
      <div class="logo h1"><img src="../imagens/logoWorldCamp.png" width="100" length="100" alt="Logo">World Camp</div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    </div>
  </div>
    <div class="col text-end">
      <a href="login.php" class="btn btn-danger m-2" <? session_abort() ?>>Sair</a>
    </div>
    <div class="col text-end">
      <button type="button" class="btn btn-secondary m-2" onclick="history.back();">Voltar</button>
    </div>
</nav>