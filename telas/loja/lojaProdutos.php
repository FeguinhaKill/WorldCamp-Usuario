<?php
session_start();

include '../../header.php';

include '../../database/db.class.php';
$db = new db();

$db->checkLogin();

$produtosBD = $db->query("SELECT * FROM produtos");

$produtos = [];

foreach ($produtosBD as $p) {
    $descricaosBD = $db->query("SELECT descricao FROM produtos_descricao WHERE product_id = ?", [$p['id']]);

    $listaDescricoes = [];
    foreach ($descricaosBD as $f) {
        $listaDescricoes[] = $f['descricao'];
    }

    $produtos[$p['id']] = [
        'id' => $p['id'],
        'nome' => $p['nome'],
        'categoria' => $p['categoria'],
        'preco' => $p['preco'],
        'imagem' => $p['imagem_path'],
        'descricaos' => $listaDescricoes
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <style>
      :root {
        --verde: #198754;
        --verde-escuro: #146c43;
        --texto: #212529;
      }
      html, body { height: 100%; }
      body {
        margin: 0;
        color: var(--texto);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-bottom: 72px;
        background-color: #f5f8f6;
      }
      main { flex: 1 0 auto; padding-bottom: 2rem; }
      header.hero-min {
        background: linear-gradient(0deg, var(--verde-escuro), var(--verde));
        color: #fff;
        padding: 60px 0;
        text-align: center;
      }
      .btn-success { background-color: var(--verde); border-color: var(--verde-escuro); }
      .btn-success:hover { background-color: var(--verde-escuro); }
      .card img { object-fit: cover; height: 220px; }
      h1.Principal {
        text-align: center;
        font-family: "Lucida Handwriting", cursive;
        color: var(--verde);
        margin-top: 50px;
        margin-bottom: 50px;
      }
      .hero {
        background: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80")
          center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 6rem 2rem;
        border-radius: 10px;
      }
      .badge.bg-success { background-color: var(--verde) !important; }
      .card-body ul { list-style-type: disc; padding-left: 1.5rem; }
    </style>

    <title>Loja - WorldCamp</title>
  </head>

  <body>
    <script>
      function setCookie(nome, valor, quantidade){
        if (document.cookie.includes(nome)) {
          document.cookie = nome + "=" + valor + ";" + (quantidade + 1) + ";path=/";
        }else{
          quantidade = 1;
        }
        document.cookie = nome + "=" + valor + ";" + quantidade + ";path=/";
        console.log(document.cookie);
      }
    </script>
    <main class="container my-5">

      <section class="hero mb-5">
        <h1>Equipe-se para a Aventura!</h1>
        <p>Explore nossa linha de produtos WorldCamp: roupas, calçados e acessórios pensados para experiências de acampamento inesquecíveis.</p>
      </section>

      <h1 class="Principal">Produtos em Destaque</h1>

      <div class="row mb-4">
      <?php foreach ($produtos as $p): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="<?= $p['imagem'] ?>" alt="<?= $p['nome'] ?>" class="card-img-top" />

            <div class="card-body">
              <span class="badge bg-success mb-2"><?= $p['categoria'] ?></span>
              <h4 class="card-title"><?= $p['nome'] ?></h4>

              <ul>
                <?php foreach ($p['descricaos'] as $f): ?>
                  <li><?= $f ?></li>
                <?php endforeach; ?>
              </ul>

              <p><strong>R$ <?= number_format($p['preco'], 2, ',', '.') ?></strong></p>

              <a onclick="setCookie('<?= $p['nome'] ?>', '<?= $p['preco'] ?>','4')" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    </main>

    <?php include '../../footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
