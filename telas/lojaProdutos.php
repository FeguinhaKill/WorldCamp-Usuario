<?php
session_start();
include '../header.php';
include '../db.class.php';
$db = new db();

$db->checkLogin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WorldCamp Store - Equipamentos e Roupas para Aventura</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />


    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />


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
        border-color: var(--verde-escuro);
      }

      .card img {
        object-fit: cover;
        height: 220px;
      }

      footer {
        background-color: var(--verde-escuro);
        color: #fff;
        padding: 2rem 0;
        text-align: center;
      }

      h1.Principal {
        text-align: center;
        font-family: "Lucida Handwriting", cursive;
        color: var(--verde);
        margin-top: 50px;
        margin-bottom: 50px;
      }

      .hero {
        background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80')
          center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 6rem 2rem;
        border-radius: 10px;
      }

      .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
      }

      .hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 1.5rem;
      }

      .badge.bg-success {
        background-color: var(--verde) !important;
      }

      .card-body ul {
        list-style-type: disc;
        padding-left: 1.5rem;
      }
    </style>
  </head>

  <body>
    <!-- Cabeçalho -->
    <header class="hero-min">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-4 text-start">
            <a class="text-white text-decoration-none fw-bold" href="#">Loja</a>
          </div>
          <div class="col-4 text-center">
            <h3 class="m-0 fw-bold">🌍 WorldCamp Store</h3>
          </div>
          <div class="col-4 text-end">
            <a class="text-white me-3" href="#"><i class="fa-solid fa-cart-shopping"></i></a>
            <a class="btn btn-sm btn-outline-light" href="#produtos">Produtos</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="container my-5">
      <!-- Hero -->
      <section class="hero mb-5">
        <h1>Equipe-se para a Aventura!</h1>
        <p>
          Explore nossa linha de produtos WorldCamp: roupas, calçados e acessórios para quem ama viver ao ar livre.
        </p>
        <a href="#produtos" class="btn btn-lg btn-success">Ver Produtos</a>
      </section>

      <!-- Produtos -->
      <h1 class="Principal" id="produtos">Produtos em Destaque</h1>

      <div class="row mb-4">
        <!-- Camiseta -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://images.unsplash.com/photo-1598033129183-c4f50c736f10?auto=format&fit=crop&w=800&q=80" alt="Camiseta WorldCamp" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Roupa</span>
              <h4 class="card-title">Camiseta WorldCamp</h4>
              <ul>
                <li>Tecido leve e respirável</li>
                <li>Logo exclusivo bordado</li>
                <li>Ideal para trilhas e aventuras</li>
              </ul>
              <p><strong>R$ 89,90</strong></p>
              <a href="#" class="btn btn-success w-100">Comprar</a>
            </div>
          </div>
        </div>

        <!-- Botas de Chuva -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://images.unsplash.com/photo-1580910051073-581b9b21a5e5?auto=format&fit=crop&w=800&q=80" alt="Botas de chuva" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Calçado</span>
              <h4 class="card-title">Botas de Chuva Impermeáveis</h4>
              <ul>
                <li>Material resistente à água</li>
                <li>Solado antiderrapante</li>
                <li>Perfeitas para terrenos molhados</li>
              </ul>
              <p><strong>R$ 249,00</strong></p>
              <a href="#" class="btn btn-success w-100">Comprar</a>
            </div>
          </div>
        </div>

        <!-- Jaqueta -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://images.unsplash.com/photo-1593032457868-24c75b9b2d72?auto=format&fit=crop&w=800&q=80" alt="Jaqueta esportiva" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Roupa</span>
              <h4 class="card-title">Jaqueta Esportiva WorldCamp</h4>
              <ul>
                <li>Proteção contra vento e chuva</li>
                <li>Tecido térmico leve</li>
                <li>Design moderno e confortável</li>
              </ul>
              <p><strong>R$ 329,00</strong></p>
              <a href="#" class="btn btn-success w-100">Comprar</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Linha 2 -->
      <div class="row mb-4">
        <!-- Garrafa -->
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=800&q=80" alt="Garrafa térmica" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Acessório</span>
              <h4 class="card-title">Garrafa Térmica WorldCamp</h4>
              <ul>
                <li>Conserva a temperatura por até 12h</li>
                <li>Corpo em aço inoxidável</li>
                <li>750ml de capacidade</li>
              </ul>
              <p><strong>R$ 119,00</strong></p>
              <a href="#" class="btn btn-success w-100">Comprar</a>
            </div>
          </div>
        </div>

        <!-- Kit Adicional -->
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://images.unsplash.com/photo-1598387846115-16af62c58b6a?auto=format&fit=crop&w=800&q=80" alt="Kit acessórios" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Adicional</span>
              <h4 class="card-title">Kit Aventureiro WorldCamp</h4>
              <ul>
                <li>Caneca + lanterna + chaveiro temático</li>
                <li>Brinde exclusivo WorldCamp</li>
                <li>Ideal para presentear</li>
              </ul>
              <p><strong>R$ 159,00</strong></p>
              <a href="#" class="btn btn-success w-100">Comprar</a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Rodapé -->
    <footer>
      <div class="container">
        <p class="mb-1">© 2025 WorldCamp Store. Todos os direitos reservados.</p>
        <p class="small">
          <a href="#" class="text-white text-decoration-none">Termos e Condições</a> |
          <a href="#" class="text-white text-decoration-none">Política de Privacidade</a>
        </p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
