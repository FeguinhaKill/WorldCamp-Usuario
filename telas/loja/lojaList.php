<?php
session_start();
include '../../database/db.class.php';
$db = new db();

$db->checkLogin();

include '../../header.php';

$compras = $db->getCompras();

if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    if ($db->deleteCompra($id)) {
        echo "<script>alert('Compra excluída com sucesso!'); window.location='lojaList.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao excluir.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Compras Recentes</title>
</head>

<body class="container my-5">

  <h2 class="mb-4">Compras Recentes</h2>

  <?php if (empty($compras)): ?>
    <p class="text-muted">Nenhuma compra foi registrada ainda.</p>
  <?php else: ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Usuário</th>
          <th>Produto</th>
          <th>Qtd</th>
          <th>Total</th>
          <th>Data</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($compras as $c): ?>
          <?php foreach ($c['itens'] as $item): ?>
            <tr>
              <td><?= htmlspecialchars($c['nome_usuario']) ?></td>
              <td><?= htmlspecialchars($item['nome']) ?></td>
              <td><?= (int) $item['quantidade'] ?></td>
              <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
              <td><?= date("d/m/Y H:i", strtotime($c['data'])) ?></td>

              <td class="text-center">

                <!-- BOTÃO EDITAR -->
                <a href="editarCompra.php?id=<?= $c['id'] ?>&produto=<?= urlencode($item['nome']) ?>"
                   class="btn btn-primary btn-sm">
                  Editar
                </a>

                <!-- BOTÃO EXCLUIR -->
                <a href="lojaList.php?excluir=<?= $c['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Tem certeza que deseja excluir esta compra inteira?')">
                  Excluir
                </a>

              </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <?php include '../../footer.php'; ?>
</body>
</html>
