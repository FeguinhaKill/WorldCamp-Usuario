<?php
session_start();
include '../../database/db.class.php';
$db = new db();

$db->checkLogin();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["acao"]) && $_GET["acao"] === "finalizar") {
  $json = file_get_contents("php://input");
  $carrinho = json_decode($json, true);

  if (!$carrinho) {
    http_response_code(400);
    echo "Carrinho inválido";
    exit;
  }

  if (!isset($_SESSION["nome"])) {
    http_response_code(401);
    echo "Usuário não logado";
    exit;
  }

  $nome_usuario = $_SESSION["nome"];
  $produtos_json = json_encode($carrinho, JSON_UNESCAPED_UNICODE);
  $db->query("
        INSERT INTO compras_realizadas (nome_usuario, produtos_json, data_compra)
        VALUES (?, ?, NOW())
    ", [
    $nome_usuario,
    $produtos_json
  ]);

  echo "OK";
  exit;
  
}

$comprasBD = $db->query("SELECT * FROM compras_realizadas ORDER BY data_compra DESC");

$compras = [];

foreach ($comprasBD as $c) {
  $compras[] = [
    'id' => $c['id'],
    'nome_usuario' => $c['nome_usuario'],
    'data' => $c['data_compra'],
    'itens' => json_decode($c['produtos_json'], true)
  ];
}
$editando = false;
$compra_edicao = null;

if (isset($_GET['id'])) {
    $editando = true;
    $id = intval($_GET['id']);

    $compra_edicao = $db->query("SELECT * FROM compras_realizadas WHERE id = ?", [$id]);

    if ($compra_edicao) {
        $compra_edicao = $compra_edicao[0];
        $compra_itens = json_decode($compra_edicao['produtos_json'], true);
    }
}





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

include '../../header.php';
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

    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      color: var(--texto);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding-bottom: 72px;
      background-color: #f5f8f6;
    }

    main {
      flex: 1 0 auto;
      padding-bottom: 2rem;
    }

    header.hero-min {
      background: linear-gradient(0deg, var(--verde-escuro), var(--verde));
      color: #fff;
      padding: 60px 0;
      text-align: center;
    }

    .btn-success {
      background-color: var(--verde);
      border-color: var(--verde-escuro);
    }

    .btn-success:hover {
      background-color: var(--verde-escuro);
    }

    .card img {
      object-fit: cover;
      height: 220px;
    }

    h1.Principal {
      text-align: center;
      font-family: "Lucida Handwriting", cursive;
      color: var(--verde);
      margin-top: 50px;
      margin-bottom: 50px;
    }

    .hero {
      background: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80") center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 6rem 2rem;
      border-radius: 10px;
    }

    .badge.bg-success {
      background-color: var(--verde) !important;
    }

    .card-body ul {
      list-style-type: disc;
      padding-left: 1.5rem;
    }
  </style>

  <title>Loja - WorldCamp</title>
</head>

<body>
  <script>
    const carrinho = [];
    
    function addCarrinho(botao, nome, preco) {
      const noCarrinho = carrinho.find(item => item.nome === nome);
      const quantidade = botao.parentElement.querySelector(".quantidade").value;

      if (noCarrinho) {
        noCarrinho.quantidade += parseInt(quantidade);
      } else {
        carrinho.push({ nome, preco, quantidade: parseInt(quantidade) });
      }

      alert(`Adicionado ao carrinho: ${nome} (Quantidade: ${quantidade}) - Preço unitário: R$ ${preco}`);

    }
    function mostrarCarrinho() {
      const container = document.getElementById("carrinhoConteudo");

      if (carrinho.length === 0) {
        container.innerHTML = "<p>Seu carrinho está vazio.</p>";
      } else {
        let html = `
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço unitário</th>
            <th>Total</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
    `;

        carrinho.forEach(item => {
          const total = (item.preco * item.quantidade).toFixed(2);

          html += `
        <tr>
          <td>${item.nome}</td>
          <td>
            <input type="number" class="form-control form-control-sm" value="${item.quantidade}" min="1" onchange="atualizarQuantidade('${item.nome}', this.value)">
          </td>
          <td>R$ ${parseFloat(item.preco).toFixed(2)}</td>
          <td>R$ ${total}</td>
          <td><button class="btn btn-danger btn-sm" onclick="removerDoCarrinho('${item.nome}')">Remover</button></td>
        </tr>
      `;
        });

        html += `
        </tbody>
      </table>
    `;

        container.innerHTML = html;
      }

      const modalEl = document.getElementById("carrinhoModal");
      const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
      modal.show();

    }
    function removerDoCarrinho(nome) {
      const index = carrinho.findIndex(item => item.nome === nome);
      if (index !== -1) {
        carrinho.splice(index, 1);
        mostrarCarrinho();
      }
    }
    function finalizarCompra() {
      if (carrinho.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
      }

      fetch("lojaForm.php?acao=finalizar", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(carrinho)
      })
        .then(res => res.text())
        .then(res => {
          if (res === "OK") {
            alert("Compra finalizada e registrada no banco!");

            carrinho.length = 0;
            mostrarCarrinho(); 

            const modalEl = document.getElementById("carrinhoModal");
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
          } else {
            alert("Erro ao finalizar compra: " + res);
          }
        })
        .catch(err => {
          alert("Erro no envio: " + err);
        });
    }
function atualizarQuantidade(nome, novaQtd) {
        novaQtd = parseInt(novaQtd);

        if (novaQtd <= 0 || isNaN(novaQtd)) {
            alert("Quantidade inválida");
            return;
        }

        const item = carrinho.find(p => p.nome === nome);
        if (item) {
            item.quantidade = novaQtd;
        }

        mostrarCarrinho();
    }


  </script>
  <main class="container my-5">

    <section class="hero my-5">
      <h1>Equipe-se para a Aventura!</h1>
      <p>Explore nossa linha de produtos WorldCamp: roupas, calçados e acessórios pensados para experiências de
        acampamento inesquecíveis.</p>
    </section>

    <div class="d-flex justify-content-end mb-4">
      <button class="btn btn-success" onclick="mostrarCarrinho()">
        <i class="fa-solid fa-cart-shopping"></i> Ver Carrinho
      </button>
    </div>
    <div class="modal fade" id="carrinhoModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seu Carrinho</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body">
            <div id="carrinhoConteudo"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar Comprando</button>
            <button type="button" class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>
          </div>
        </div>
      </div>
    </div>

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
              <div>
                <h6>Quantidade</h6>
                <input type="number" class="quantidade" value="1" min="1">

                <a onclick="addCarrinho(this, '<?= $p['nome'] ?>', '<?= $p['preco'] ?>')" class="btn btn-success w-100">

                  <i class="fa-solid fa-cart-plus"></i> Comprar
                </a>
              </div>
            </div>

          </div>
        </div>

      <?php endforeach; ?>
    </div>
    <div class="text-center mt-5 mb-5">
    <a href="lojaList.php" class="btn btn-success btn-lg">
        <i class="fa-solid fa-list"></i> Ver Histórico de Compras
    </a>
</div>



  </main>

  <?php include '../../footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>