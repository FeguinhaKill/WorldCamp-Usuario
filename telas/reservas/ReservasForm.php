<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db('agendardormitorio');
$db->checkLogin();
$data = null;

if (!empty($_POST)) {
    try {
        $errors = [];

        if (empty($_POST['tipo_acomodacao'])) $errors[] = 'Tipo de acomodação obrigatório';
        if (empty($_POST['nome_completo'])) $errors[] = 'Nome obrigatório';
        if (empty($_POST['email'])) $errors[] = 'Email obrigatório';
        if (empty($_POST['data_checkin'])) $errors[] = 'Data de check-in obrigatória';
        if (empty($_POST['data_checkout'])) $errors[] = 'Data de check-out obrigatória';
        if (empty($_POST['qtd_hospedes'])) $errors[] = 'Quantidade de hóspedes obrigatória';

        if (empty($errors)) {
            if (empty($_POST['id'])) {
                unset($_POST['id']);
                $db->store($_POST);
                echo "Registro Salvo!";
            } else {
                $db->update($_POST);
                echo "Registro Atualizado!";
            }

            echo "<script>
                setTimeout(()=> window.location.href = 'ReservasList.php', 1000);
            </script>";
        } else {
            foreach ($errors as $e) echo $e . "<br>";
        }

    } catch (Exception $e) {
        var_dump($errors, $e->getMessage());
        exit();
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
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
      :root { --verde: #198754; --verde-escuro: #146c43; --texto: #212529; }
      body { margin: 0; background-color: #f5f8f6; color: var(--texto); }
      .btn-success { background-color: var(--verde); border-color: var(--verde-escuro); }
      .btn-success:hover { background-color: var(--verde-escuro); }
      .hero-reservas {
        background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0,0,0,0.55)),
        url("https://images.unsplash.com/photo-1523419409543-3e4f83b9b4c9?auto=format&fit=crop&w=1600&q=80")
        center/cover no-repeat;
        color: white; text-align: center; padding: 5rem 2rem; border-radius: 10px; margin-top: 2rem;
      }
      .hero-reservas h1 { font-size: 2.8rem; font-weight: 700; }
      .card-opcao { border-left: 5px solid var(--verde); }
    </style>

    <title>Reservas - WorldCamp</title>
  </head>
  <body>

    <main class="container my-4">

      <section class="hero-reservas mb-5">
        <h1>Reserve seu cantinho no WorldCamp</h1>
        <p>Escolha a acomodação desejada e realize sua reserva.</p>
        <a href="#form-reserva" class="btn btn-lg btn-success">
          <i class="fa-solid fa-calendar-check"></i> Fazer reserva
        </a>
      </section>

      <section class="mb-5" id="form-reserva">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="card shadow-sm">
              <div class="card-body">

                <h3 class="mb-3"><i class="fa-solid fa-pen-to-square"></i> Solicitar reserva</h3>

                <form action="" method="post">
                  <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                  <div class="mb-3">
                    <label class="form-label">Tipo de acomodação</label>
                    <select class="form-select" name="tipo_acomodacao" required>
                      <?php $tipo = $data->tipo_acomodacao ?? ''; ?>
                      <option value="">Selecione</option>
                      <option value="cabana" <?= $tipo=='cabana'?'selected':'' ?>>Cabana</option>
                      <option value="dormitorio" <?= $tipo=='dormitorio'?'selected':'' ?>>Dormitório</option>
                      <option value="voluntariado" <?= $tipo=='voluntariado'?'selected':'' ?>>Voluntariado</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Nome completo</label>
                      <input type="text" class="form-control" name="nome_completo"
                             value="<?= $data->nome_completo ?? '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">E-mail</label>
                      <input type="email" class="form-control" name="email"
                             value="<?= $data->email ?? '' ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Telefone</label>
                      <input type="tel" class="form-control" name="telefone"
                             value="<?= $data->telefone ?? '' ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Hóspedes</label>
                      <input type="number" min="1" class="form-control" name="qtd_hospedes"
                             value="<?= $data->qtd_hospedes ?? '' ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Check-in</label>
                      <input type="date" class="form-control" name="data_checkin"
                             value="<?= $data->data_checkin ?? '' ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Check-out</label>
                      <input type="date" class="form-control" name="data_checkout"
                             value="<?= $data->data_checkout ?? '' ?>" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Forma de pagamento</label>
                      <select class="form-select" name="forma_pagamento">
                        <?php $fp = $data->forma_pagamento ?? ''; ?>
                        <option value="">Selecione</option>
                        <option value="cartao_credito" <?= $fp=='cartao_credito'?'selected':'' ?>>Cartão</option>
                        <option value="pix" <?= $fp=='pix'?'selected':'' ?>>PIX</option>
                        <option value="boleto" <?= $fp=='boleto'?'selected':'' ?>>Boleto</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label class="form-label">Valor total</label>
                      <input type="text" class="form-control" name="valor_total"
                             value="<?= $data->valor_total ?? '' ?>" readonly>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea class="form-control" id="observacoes" rows="3"
                              name="observacoes"><?= $data->observacoes ?? '' ?></textarea>
                  </div>

                  <button type="submit" class="btn btn-success w-100">
                    <i class="fa-solid fa-paper-plane"></i> Salvar reserva
                  </button>

                </form>

              </div>
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
