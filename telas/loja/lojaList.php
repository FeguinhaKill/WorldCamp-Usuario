<?php
session_start();
include '../../database/db.class.php';
$db = new db();

$db->checkLogin();
include '../../header.php';
$db->processarUpdateCompra();
$db->processarExclusaoCompra();
$compras = $db->getComprasFiltradas($_POST);
?>


<style>
    .hero-compras {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
    }
    .hero-compras h2 { margin: 0; font-weight: 700; }
    .hero-compras p { margin: 0.4rem 0 0; opacity: 0.9; }

    .table-reservas thead {
        background-color: #f8faf9;
    }

    .table-reservas tbody tr:hover {
        background-color: #f4fbf7;
    }
</style>

<div class="container my-4">

    <div class="hero-compras">
        <h2>Compras da Loja</h2>
        <p>Visualize, filtre e gerencie as compras realizadas no sistema.</p>
    </div>

    <form action="lojaList.php" method="POST" class="mb-4">
    <div class="row g-2 align-items-end">

        <div class="col-md-3">
            <label class="form-label">Pesquisar por</label>
            <select name="tipo" class="form-select">
                <option value="usuario">Usuário</option>
                <option value="produto">Produto</option>
                <option value="data">Data</option>
            </select>
        </div>

        <div class="col-md-5">
            <label class="form-label">Valor para pesquisa</label>
            <input type="text" name="valor" class="form-control" placeholder="Digite o termo buscado">
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary w-100 mt-4">Buscar</button>
            <a href="lojaList.php" class="btn btn-secondary w-100 mt-4">Limpar</a>

            <a href="./lojaForm.php" class="btn btn-success w-100 mt-4">
                Nova Compra
            </a>
        </div>

    </div>
</form>


    <div class="mb-5 table-responsive">
        <table class="table table-striped table-hover table-reservas align-middle">
            <thead>
            <tr>
                <th>Usuário</th>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Total</th>
                <th>Data</th>
                <th>Edit.</th>
                <th>Excluir</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($compras as $c): ?>
                <?php foreach ($c['itens'] as $i => $item): ?>
                    <tr>
                        <form method="POST">

                            <td><?= $c['nome_usuario'] ?></td>
                            <td><?= $item['nome'] ?></td>

                            <td>
                                <?php if (isset($_GET['editar']) && $_GET['editar'] == $c['id'] && $_GET['item'] == $i): ?>
                                    <input type="number" name="quantidade" class="form-control" value="<?= $item['quantidade'] ?>">
                                    <input type="hidden" name="itemIndex" value="<?= $i ?>">
                                <?php else: ?>
                                    <?= $item['quantidade'] ?>
                                <?php endif; ?>
                            </td>

                            <td>R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ",", ".") ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($c['data'])) ?></td>

                            <td class="text-center">
                                <?php if (isset($_GET['editar']) && $_GET['editar'] == $c['id'] && $_GET['item'] == $i): ?>
                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                    <button name="salvar" class="btn btn-success btn-sm">Salvar</button>
                                    <a href="lojaList.php" class="btn btn-secondary btn-sm">Cancelar</a>
                                <?php else: ?>
                                    <a href="lojaList.php?editar=<?= $c['id'] ?>&item=<?= $i ?>" class="btn btn-primary btn-sm">Editar</a>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <a href="lojaList.php?excluir=<?= $c['id'] ?>"
                                   onclick="return confirm('Excluir compra inteira?')"
                                   class="btn btn-danger btn-sm">
                                    Excluir
                                </a>
                            </td>

                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../footer.php'; ?>
