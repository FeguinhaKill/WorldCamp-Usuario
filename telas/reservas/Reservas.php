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

      .btn-success {
        background-color: var(--verde);
        border-color: var(--verde-escuro);
      }

      .btn-success:hover {
        background-color: var(--verde-escuro);
        border-color: var(--verde-escuro);
      }

      .hero-reservas {
        background: linear-gradient(
            rgba(0, 0, 0, 0.45),
            rgba(0, 0, 0, 0.55)
          ),
          url("https://images.unsplash.com/photo-1523419409543-3e4f83b9b4c9?auto=format&fit=crop&w=1600&q=80")
          center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 5rem 2rem;
        border-radius: 10px;
        margin-top: 2rem;
      }

      .hero-reservas h1 {
        font-size: 2.8rem;
        font-weight: 700;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
      }

      .hero-reservas p {
        font-size: 1.1rem;
        max-width: 720px;
        margin: 0 auto 1.5rem;
      }

      h1.Principal {
        text-align: center;
        font-family: "Lucida Handwriting", cursive;
        color: var(--verde);
        margin-top: 50px;
        margin-bottom: 40px;
      }

      .card-opcao {
        border-left: 5px solid var(--verde);
      }

      .tag-preco {
        font-size: 0.9rem;
        font-weight: 600;
      }

      .detalhe-incluso {
        font-size: 0.9rem;
        color: #6c757d;
      }

      .resumo-texto ul {
        list-style-type: disc;
        padding-left: 1.5rem;
      }

      .badge.bg-success {
        background-color: var(--verde) !important;
      }

      .resumo-total {
        font-size: 0.9rem;
        color: #6c757d;
      }
    </style>

    <title>Reservas - WorldCamp</title>
  </head>
  <body>

    <main class="container my-4">

      <section class="hero-reservas mb-5">
        <h1>Reserve seu cantinho no WorldCamp</h1>
        <p>
          Escolha entre cabanas aconchegantes, dormitórios compartilhados ou
          viva a experiência do voluntariado em meio à natureza.
        </p>
        <a href="#form-reserva" class="btn btn-lg btn-success">
          <i class="fa-solid fa-calendar-check"></i> Fazer reserva
        </a>
      </section>

      <h1 class="Principal">Opções de hospedagem</h1>

      <section class="row g-4 mb-5 resumo-texto">
        <div class="col-md-4">
          <div class="card card-opcao shadow-sm h-100">
            <div class="card-body">
              <span class="badge bg-success mb-2">
                <i class="fa-solid fa-house-chimney"></i> Cabana na floresta
              </span>
              <h4 class="card-title mb-2">Cabana na Floresta</h4>
              <p class="tag-preco text-success mb-2">
                R$ 600,00 / diária
              </p>
              <p class="detalhe-incluso mb-2">
                Incluso café da manhã — Pet friendly
              </p>
              <ul>
                <li>Ambiente privativo em meio às árvores.</li>
                <li>Ideal para famílias ou pequenos grupos.</li>
                <li>Permite pets sob supervisão dos responsáveis.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-opcao shadow-sm h-100">
            <div class="card-body">
              <span class="badge bg-success mb-2">
                <i class="fa-solid fa-bed"></i> Dormitórios compartilhados
              </span>
              <h4 class="card-title mb-2">Dormitórios Compartilhados</h4>
              <p class="tag-preco text-success mb-2">
                R$ 300,00 / diária
              </p>
              <p class="detalhe-incluso mb-2">
                Incluso café da manhã
              </p>
              <ul>
                <li>Ambiente coletivo com beliches confortáveis.</li>
                <li>Opção econômica para grupos e escolas.</li>
                <li>Divisão por faixa etária e gênero.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-opcao shadow-sm h-100">
            <div class="card-body">
              <span class="badge bg-success mb-2">
                <i class="fa-solid fa-hand-holding-heart"></i> Voluntariado
              </span>
              <h4 class="card-title mb-2">Programa de Voluntariado</h4>
              <p class="tag-preco text-success mb-2">
                2 semanas de trabalho no acampamento
              </p>
              <p class="detalhe-incluso mb-2">
                Dormitório gratuito durante o período
              </p>
              <ul>
                <li>Apoio em atividades do acampamento WorldCamp.</li>
                <li>Experiência imersiva em ambiente educativo.</li>
                <li>Vagas limitadas e sujeitas à aprovação.</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="mb-5" id="form-reserva">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="card shadow-sm">
              <div class="card-body">
                <h3 class="mb-3">
                  <i class="fa-solid fa-pen-to-square"></i> Solicitar reserva
                </h3>
                <p class="text-muted mb-3">
                  Preencha os dados abaixo para registrar sua intenção de reserva.
                  As informações serão analisadas pela equipe WorldCamp antes da
                  confirmação final.
                </p>

                <form action="processa_reserva.php" method="post">
                  <!-- Tipo de acomodação -->
                  <div class="mb-3">
                    <label for="tipo_acomodacao" class="form-label">
                      Tipo de acomodação
                    </label>
                    <select
                      class="form-select"
                      id="tipo_acomodacao"
                      name="tipo_acomodacao"
                      required
                    >
                      <option value="">Selecione uma opção</option>
                      <option value="cabana">Cabana na Floresta</option>
                      <option value="dormitorio">Dormitórios Compartilhados</option>
                      <option value="voluntariado">Programa de Voluntariado</option>
                    </select>
                  </div>

                  <!-- Dados pessoais -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="nome_completo" class="form-label">Nome completo</label>
                      <input
                        type="text"
                        class="form-control"
                        id="nome_completo"
                        name="nome_completo"
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
                      <label for="telefone" class="form-label">Telefone / WhatsApp</label>
                      <input
                        type="tel"
                        class="form-control"
                        id="telefone"
                        name="telefone"
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="qtd_hospedes" class="form-label">
                        Quantidade de hóspedes
                      </label>
                      <input
                        type="number"
                        min="1"
                        class="form-control"
                        id="qtd_hospedes"
                        name="qtd_hospedes"
                        required
                      />
                    </div>
                  </div>

                  <!-- Datas -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="data_checkin" class="form-label">Data de check-in</label>
                      <input
                        type="date"
                        class="form-control"
                        id="data_checkin"
                        name="data_checkin"
                        required
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="data_checkout" class="form-label">Data de check-out</label>
                      <input
                        type="date"
                        class="form-control"
                        id="data_checkout"
                        name="data_checkout"
                        required
                      />
                    </div>
                  </div>

                  <!-- Forma de pagamento + total -->
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="forma_pagamento" class="form-label">Forma de pagamento</label>
                      <select
                        class="form-select"
                        id="forma_pagamento"
                        name="forma_pagamento"
                      >
                        <option value="">Selecione</option>
                        <option value="cartao_credito">Cartão de crédito</option>
                        <option value="pix">PIX</option>
                        <option value="boleto">Boleto bancário</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="valor_total" class="form-label">Valor total estimado</label>
                      <input
                        type="text"
                        class="form-control"
                        id="valor_total"
                        name="valor_total"
                        readonly
                        placeholder="R$ 0,00"
                      />
                      <div class="resumo-total mt-1" id="resumo_diarias">
                        <!-- resumo de diárias aparece aqui via JS -->
                      </div>
                    </div>
                  </div>

                  <!-- Observações -->
                  <div class="mb-3">
                    <label for="observacoes" class="form-label">
                      Observações (pets, restrições, voluntariado etc.)
                    </label>
                    <textarea
                      class="form-control"
                      id="observacoes"
                      name="observacoes"
                      rows="3"
                      placeholder="Ex.: Levo 1 cachorro de porte médio / Interesse específico no programa de voluntariado..."
                    ></textarea>
                  </div>

                  <button type="submit" class="btn btn-success w-100">
                    <i class="fa-solid fa-paper-plane"></i> Enviar solicitação de reserva
                  </button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h5 class="mb-3">
                  <i class="fa-solid fa-circle-info"></i> Como funciona a reserva
                </h5>
                <ul>
                  <li>Você preenche o formulário com os dados da hospedagem.</li>
                  <li>A equipe do WorldCamp verifica disponibilidade e valores finais.</li>
                  <li>Você recebe a confirmação e instruções de pagamento por e-mail.</li>
                </ul>
                <hr />
                <p class="mb-1"><strong>Valores base:</strong></p>
                <ul class="mb-2">
                  <li>Cabana na floresta: <strong>R$ 600,00 / diária</strong></li>
                  <li>Dormitórios compartilhados: <strong>R$ 300,00 / diária</strong></li>
                  <li>Voluntariado: <strong>dormitório grátis</strong> por 2 semanas de trabalho</li>
                </ul>
                <small class="text-muted">
                  *Valores podem variar em datas especiais e alta temporada.
                </small>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

 
    <script>
      const campoTipo = document.getElementById('tipo_acomodacao');
      const campoCheckin = document.getElementById('data_checkin');
      const campoCheckout = document.getElementById('data_checkout');
      const campoValorTotal = document.getElementById('valor_total');
      const resumoDiarias = document.getElementById('resumo_diarias');

      const valoresDiaria = {
        cabana: 600,
        dormitorio: 300,
        voluntariado: 0
      };

      function calcularTotal() {
        const tipo = campoTipo.value;
        const checkin = campoCheckin.value;
        const checkout = campoCheckout.value;

       
        if (!tipo || !checkin || !checkout) {
          campoValorTotal.value = '';
          resumoDiarias.textContent = '';
          return;
        }

        const dataIn = new Date(checkin);
        const dataOut = new Date(checkout);

        const diffMs = dataOut - dataIn;
        const dias = diffMs / (1000 * 60 * 60 * 24);

        if (isNaN(dias) || dias <= 0) {
          campoValorTotal.value = '';
          resumoDiarias.textContent = 'Verifique as datas: o check-out deve ser depois do check-in.';
          return;
        }

        const diaria = valoresDiaria[tipo] ?? 0;

        if (tipo === 'voluntariado') {
          campoValorTotal.value = 'R$ 0,00';
          resumoDiarias.textContent = 'Programa de voluntariado: não há cobrança de diária.';
          return;
        }

        const total = diaria * dias;
        campoValorTotal.value = total.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL'
        });

        resumoDiarias.textContent =
          `Cálculo: ${dias} diária(s) × ` +
          diaria.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) +
          ` = ${campoValorTotal.value}`;
      }

      campoTipo.addEventListener('change', calcularTotal);
      campoCheckin.addEventListener('change', calcularTotal);
      campoCheckout.addEventListener('change', calcularTotal);
    </script>
  </body>
</html>

<?php
include '../footer.php';

?>


