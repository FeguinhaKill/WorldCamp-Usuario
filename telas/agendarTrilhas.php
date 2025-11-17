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

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
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

      body {
        background-color: #f5f8f6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-bottom: 72px;
        color: var(--texto);
      }

      main {
        flex: 1 0 auto;
        padding-bottom: 2rem;
      }

      .hero-trilhas {
        background: linear-gradient(
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.5)
          ),
          url("https://images.unsplash.com/photo-1528909514045-2fa4ac7a08ba?auto=format&fit=crop&w=1600&q=80")
            center/cover no-repeat;
        color: #fff;
        text-align: center;
        padding: 5rem 2rem;
        border-radius: 12px;
        margin-top: 2rem;
      }

      .hero-trilhas h1 {
        font-size: 2.6rem;
        font-weight: 700;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
      }

      .hero-trilhas p {
        max-width: 720px;
        margin: 1rem auto 0;
      }

      h1.Principal {
        text-align: center;
        font-family: "Lucida Handwriting", cursive;
        color: var(--verde);
        margin-top: 40px;
        margin-bottom: 40px;
      }

      .card-trilha img {
        height: 220px;
        object-fit: cover;
      }

      .btn-success {
        background-color: var(--verde);
        border-color: var(--verde-escuro);
      }

      .btn-success:hover {
        background-color: var(--verde-escuro);
        border-color: var(--verde-escuro);
      }

      .badge-nivel {
        font-size: 0.8rem;
      }
    </style>

    <title>Inscrição em Trilhas - WorldCamp</title>
  </head>
  <body>
    <main class="container my-4">
      <!-- HERO -->
      <section class="hero-trilhas mb-5">
        <h1>Inscreva-se nas Trilhas WorldCamp</h1>
        <p>
          Escolha uma das trilhas guiadas, prepare a mochila e venha viver uma
          experiência de aventura com segurança, natureza e muita história pra contar.
        </p>
        <a href="#form-inscricao" class="btn btn-lg btn-success mt-3">
          <i class="fa-solid fa-person-hiking"></i> Fazer inscrição
        </a>
      </section>

      <!-- TRILHAS DISPONÍVEIS -->
      <h1 class="Principal">Nossas trilhas</h1>

      <section class="row g-4 mb-5">
        <!-- Trilha 1 -->
        <div class="col-md-4">
          <div class="card shadow-sm card-trilha h-100">
            <img
              src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80"
              class="card-img-top"
              alt="Trilha do Vale Verde"
            />
            <div class="card-body">
              <span class="badge bg-success badge-nivel mb-2">Nível: Fácil</span>
              <h4 class="card-title">Trilha do Vale Verde</h4>
              <p class="card-text">
                Caminhada leve por campos abertos e riachos rasos. Ideal para
                iniciantes, famílias e grupos escolares.
              </p>
              <p class="mb-0">
                <strong>Duração média:</strong> 1h30<br />
                <strong>Idade mínima:</strong> 7 anos
              </p>
            </div>
          </div>
        </div>

        <!-- Trilha 2 -->
        <div class="col-md-4">
          <div class="card shadow-sm card-trilha h-100">
            <img
              src="https://images.unsplash.com/photo-1496417263034-38ec4f0b665a?auto=format&fit=crop&w=800&q=80"
              class="card-img-top"
              alt="Trilha da Pedra Clara"
            />
            <div class="card-body">
              <span class="badge bg-warning text-dark badge-nivel mb-2"
                >Nível: Intermediário</span
              >
              <h4 class="card-title">Trilha da Pedra Clara</h4>
              <p class="card-text">
                Terreno variado, com subidas moderadas e mirantes naturais.
                Perfeita para quem já tem algum contato com trilhas.
              </p>
              <p class="mb-0">
                <strong>Duração média:</strong> 2h30<br />
                <strong>Idade mínima:</strong> 12 anos
              </p>
            </div>
          </div>
        </div>

        <!-- Trilha 3 -->
        <div class="col-md-4">
          <div class="card shadow-sm card-trilha h-100">
            <img
              src="https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?auto=format&fit=crop&w=800&q=80"
              class="card-img-top"
              alt="Trilha do Pico Nebuloso"
            />
            <div class="card-body">
              <span class="badge bg-danger badge-nivel mb-2">Nível: Avançado</span>
              <h4 class="card-title">Trilha do Pico Nebuloso</h4>
              <p class="card-text">
                Desafio intenso com subidas íngremes e terrenos rochosos. Acompanhada
                por instrutores experientes.
              </p>
              <p class="mb-0">
                <strong>Duração média:</strong> 4h<br />
                <strong>Idade mínima:</strong> 16 anos
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- FORMULÁRIO DE INSCRIÇÃO (APENAS HTML) -->
      <section class="mb-5" id="form-inscricao">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="mb-3">
              <i class="fa-solid fa-clipboard-list"></i> Formulário de inscrição
            </h3>
            <p class="text-muted">
              Preencha seus dados para realizar a inscrição na trilha desejada.
              (Por enquanto é só visual, sem envio para banco de dados.)
            </p>

            <!-- Somente HTML, sem backend -->
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nome" class="form-label">Nome completo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    required
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    required
                  />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="telefone" class="form-label">Telefone</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="telefone"
                    name="telefone"
                    placeholder="(DDD) 90000-0000"
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="idade" class="form-label">Idade</label>
                  <input
                    type="number"
                    class="form-control"
                    id="idade"
                    name="idade"
                    min="7"
                    required
                  />
                </div>
              </div>

              <div class="mb-3">
                <label for="trilha" class="form-label">Trilha desejada</label>
                <select
                  class="form-select"
                  id="trilha"
                  name="trilha"
                  required
                >
                  <option value="">Selecione uma trilha</option>
                  <option value="vale_verde">
                    Trilha do Vale Verde (Fácil)
                  </option>
                  <option value="pedra_clara">
                    Trilha da Pedra Clara (Intermediária)
                  </option>
                  <option value="pico_nebuloso">
                    Trilha do Pico Nebuloso (Avançada)
                  </option>
                </select>
              </div>

              <div class="mb-3">
                <label for="data_trilha" class="form-label">Data desejada</label>
                <input
                  type="date"
                  class="form-control"
                  id="data_trilha"
                  name="data_trilha"
                  required
                />
              </div>

              <div class="mb-3">
                <label for="observacoes" class="form-label"
                  >Observações (opcional)</label
                >
                <textarea
                  class="form-control"
                  id="observacoes"
                  name="observacoes"
                  rows="3"
                  placeholder="Ex.: experiência em trilhas, restrições físicas, dúvidas..."
                ></textarea>
              </div>

              <button type="submit" class="btn btn-success w-100">
                <i class="fa-solid fa-paper-plane"></i> Enviar inscrição
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>



<?php
include '../footer.php';

?>
