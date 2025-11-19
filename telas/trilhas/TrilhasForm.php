<?php
include '../../header.php';
include '../../database/db.class.php';
session_start();
$db = new db();
$data = null;

if (!empty($_GET['Id'])) {
  $data = $db->findTrilha($_GET['Id']);
}

if (!empty($_POST)) {
  try {

    if (empty($_POST['Id'])) {

      $db->storeTrilha([
        "nome_usuario" => $_POST['nome_usuario'],
        "trilha" => $_POST['trilha'],
        "data_realizacao" => $_POST['data_realizacao'],
        "numero_acompanhantes" => $_POST['numero_acompanhantes'],
      ]);

      echo "Trilha criada com sucesso!";

    } else {

      $db->updateTrilha([
        "Id" => $_POST['Id'],
        "nome_usuario" => $_POST['nome_usuario'],
        "trilha" => $_POST['trilha'],
        "data_realizacao" => $_POST['data_realizacao'],
        "numero_acompanhantes" => $_POST['numero_acompanhantes'],
      ]);

      echo "Trilha atualizada com sucesso!";
    }

    echo "<script>
            setTimeout(() => window.location.href = 'TrilhasList.php', 800);
          </script>";

  } catch (Exception $e) {
    var_dump($e->getMessage());
    exit();
  }
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../css/styles.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

  <title>Inscrição em Trilhas - WorldCamp</title>
</head>

<body>
  <script>
    function agendarTrilha() {

      const nome = document.querySelector('input[name="nome_usuario"]').value.trim();
      const trilha = document.getElementById('trilha').value;
      const data = document.querySelector('input[name="data_realizacao"]').value;
      const acompanhantes = document.querySelector('input[name="numero_acompanhantes"]').value;
      if (!data) {
        alert("Por favor, selecione uma data para realizar a trilha.");
        return; // impede o envio
      }
      document.getElementById('formTrilha').submit();
    }
  </script>
  <main class="container my-4">
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
          <img src="../../imagens/trilha_vale_verde.png" loading="lazy" style="height:225px; object-fit:cover;"
            class="card-img-top" alt="Trilha do Vale Verde" />
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



          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm card-trilha h-100">
          <img src="../../imagens/trilha_pedra_clara.png" loading="lazy" style="height:225px; object-fit:cover;"
            class="card-img-top" alt="Trilha da Pedra Clara" />
          <div class="card-body">
            <span class="badge bg-warning text-dark badge-nivel mb-2">Nível: Intermediário</span>
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

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm card-trilha h-100">
          <img src="../../imagens/trilha_pico_nebuloso.png" loading="lazy" style="height:225px; object-fit:cover;"
            class="card-img-top" alt="Trilha do Pico Nebuloso" />
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
          </div>
        </div>
      </div>

    </section>
    <form class="mb-5" action="" method="POST" id="formTrilha">
      <input type="hidden" name="Id" value="<?= $data->Id ?? '' ?>">

      <label class="form-label">Nome completo:</label>
      <input type="text" class="form-control" name="nome_usuario"
        value="<?= $data->nome_usuario ?? $_SESSION['nome'] ?>" required>

      <label class="form-label">Trilha:</label>
      <select class="form-select" name="trilha" id="trilha" required>
        <option value="vale verde" <?= (isset($data) && $data->trilha == "vale verde") ? 'selected' : '' ?>>Trilha do Vale
          Verde</option>
        <option value="pedra clara" <?= (isset($data) && $data->trilha == "pedra clara") ? 'selected' : '' ?>>Trilha da
          Pedra Clara</option>
        <option value="pico nebuloso" <?= (isset($data) && $data->trilha == "pico nebuloso") ? 'selected' : '' ?>>Trilha do
          Pico Nebuloso</option>
      </select>

      <label class="form-label">Data de realização:</label>
      <input type="date" class="form-control" name="data_realizacao" value="<?= $data->data_realizacao ?? '' ?>"
        required>

      <label class="form-label">Número de acompanhantes:</label>
      <input type="number" class="form-control" name="numero_acompanhantes" min="1"
        value="<?= $data->numero_acompanhantes ?? 1 ?>" required>
      <div>
        <button type="button" class="btn btn-success" onclick="agendarTrilha()">
          <i class="fa-solid fa-paper-plane"></i> Enviar inscrição
        </button>
      </div>
    </form>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<?php
include '../../footer.php';

?>