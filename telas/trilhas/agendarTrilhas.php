<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';
$db = new db();

$db->checkLogin();
?>


<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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

      body {
        background-color: #f5f8f6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
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

      .card-trilha form {
        border-top: 1px solid #e9ecef;
        margin-top: 1rem;
        padding-top: 1rem;
      }

      .card-trilha label {
        font-size: 0.85rem;
        margin-bottom: 0.15rem;
      }

      .card-trilha .form-control,
      .card-trilha .form-select {
        font-size: 0.85rem;
        padding: 0.25rem 0.4rem;
      }

      .card-trilha button[type="submit"] {
        margin-top: 0.5rem;
        font-size: 0.9rem;
      }
    </style>

    <title>Inscrição em Trilhas - WorldCamp</title>
  </head>
  <body>
    <main class="container my-4">
      <!-- HERO -->
      <section class="hero-trilhas mb-5">
        <h1>Inscreva-se nas Trilhas WorldCamp</h1>
        <p class="lead">
          Cada trilha, uma história. Escolha a sua e preencha o mini-formulário direto no card da trilha desejada.
        </p>
      </section>

      <h1 class="Principal">Nossas Trilhas</h1>

      <section class="row g-4 mb-5">
   
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
                A Trilha da Cachoeira é uma das mais populares entre nossos participantes, 
                com duração média de 2 horas e meia, levando a uma belíssima cachoeira 
                escondida dentro da floresta.<br><br>
                De dificuldade leve, possui poucas inclinações durante o percurso, sendo 
                indicada para todas as idades. A quantidade de profissionais que acompanharão 
                o grupo varia conforme a demanda de participantes e a faixa etária.<br><br>
                Durante o percurso, nossos profissionais explicam sobre a fauna e flora local, 
                além de curiosidades sobre a cachoeira e sua descoberta.<br><br>
                Ao final da trilha, haverá um tempo reservado para que os participantes possam 
                aproveitar a cachoeira, nadar e tirar fotos, sempre com acompanhamento e lanches 
                disponibilizados por nossa equipe, com duração aproximada de 1 hora.
              </p>
              <p class="mb-2">
                <strong>Duração:</strong> 1h30<br />
                <strong>Idade mínima:</strong> 7 anos
              </p>

            
              <form action="#" method="post">
                <input type="hidden" name="trilha" value="vale_verde" />
                <div class="mb-2">
                  <label for="nome_vale" class="form-label" value="<?php ?>">Nome completo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nome_vale"
                    name="nome"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="email_vale" class="form-label">E-mail</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email_vale"
                    name="email"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="data_vale" class="form-label">Data desejada</label>
                  <input
                    type="date"
                    class="form-control"
                    id="data_vale"
                    name="data_trilha"
                    required
                  />
                </div>

                <button type="submit" class="btn btn-success w-100">
                  <i class="fa-solid fa-paper-plane"></i> Inscrever na Trilha do Vale Verde
                </button>
              </form>
            </div>
          </div>
        </div>

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
                A trilha consiste em uma caminhada duradoura, com média de 3 horas e 
                3 paradas ao longo do caminho.<br><br>
                Leva até o pé de uma de nossas montanhas mais simples, porém belíssimas 
                (Sonna Peaks), 
                com uma vista incrível e contato direto com a natureza ao redor.<br><br>
                De dificuldade moderada, conta com subidas e descidas que exigem um bom 
                condicionamento físico, mas nada fora do alcance de quem já pratica caminhadas.<br><br>
                O grupo será guiado por nossos profissionais, definidos conforme a faixa etária, 
                que também apresentam informações sobre a fauna, a flora local e curiosidades sobre 
                a montanha e a construção do percurso como um todo.
              </p>
              <p class="mb-2">
                <strong>Duração:</strong> 2h30<br />
                <strong>Idade mínima:</strong> 12 anos
              </p>

              <form action="#" method="post">
                <input type="hidden" name="trilha" value="pedra_clara" />
                <div class="mb-2">
                  <label for="nome_pedra" class="form-label">Nome completo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nome_pedra"
                    name="nome"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="email_pedra" class="form-label">E-mail</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email_pedra"
                    name="email"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="data_pedra" class="form-label">Data desejada</label>
                  <input
                    type="date"
                    class="form-control"
                    id="data_pedra"
                    name="data_trilha"
                    required
                  />
                </div>

                <button type="submit" class="btn btn-success w-100">
                  <i class="fa-solid fa-paper-plane"></i> Inscrever na Trilha da Pedra Clara
                </button>
              </form>
            </div>
          </div>
        </div>

       
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
                A Trilha da Caverna é uma das mais desafiadoras, por adentrar uma caverna 
                de baixa luminosidade, porém de ampla extensão, levando em média 2 horas para 
                ser concluída, com 2 paradas e diversas saídas de emergência ao longo do percurso.<br><br>
                A trilha leva os participantes até uma caverna natural, descoberta por nossos 
                profissionais durante explorações na região.<br><br>
                É necessário bom condicionamento físico e, principalmente, controle emocional, 
                devido a possíveis gatilhos de claustrofobia, uma vez que o trajeto é feito 
                praticamente todo dentro da caverna.<br><br>
                A participação é restrita para idades acima de 13 anos, por questões de segurança. 
                Durante o trajeto, nossos profissionais apresentam curiosidades sobre a caverna 
                e sobre a descoberta do percurso.<br><br>
                Ao final, os participantes têm a oportunidade de explorar a área com supervisão 
                constante da equipe, garantindo a segurança de todos.
              </p>
              <p class="mb-2">
                <strong>Duração:</strong> 4h<br />
                <strong>Idade mínima:</strong> 16 anos
              </p>

        
              <form action="#" method="post">
                <input type="hidden" name="trilha" value="pico_nebuloso" />
                <div class="mb-2">
                  <label for="nome_pico" class="form-label">Nome completo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nome_pico"
                    name="nome"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="email_pico" class="form-label">E-mail</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email_pico"
                    name="email"
                    required
                  />
                </div>

                <div class="mb-2">
                  <label for="data_pico" class="form-label">Data desejada</label>
                  <input
                    type="date"
                    class="form-control"
                    id="data_pico"
                    name="data_trilha"
                    required
                  />
                </div>

                <button type="submit" class="btn btn-success w-100">
                  <i class="fa-solid fa-paper-plane"></i> Inscrever na Trilha do Pico Nebuloso
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>



<?php
include '../../footer.php';

?>


