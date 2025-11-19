<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db();
$db->checkLogin();

if (!empty($_GET['Id'])) {
    $db->deleteTrilha($_GET['Id']);
}

if (!empty($_POST)) {
    $agendamento = $db->searchTrilha($_POST);
} else {
    $agendamento = $db->allTrilhas();
}
?>

<style>
    .hero-trilhas-list {
        background: linear-gradient(135deg, #145a32, #27ae60);
        color: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
    }

    .hero-trilhas-list h2 {
        margin: 0;
        font-weight: 700;
    }

    .hero-trilhas-list p {
        margin: 0.4rem 0 0;
        opacity: 0.9;
    }

    .badge-trilha {
        font-size: 0.8rem;
        padding: 0.3rem 0.55rem;
        border-radius: 999px;
    }

    .badge-vale {
        background-color: #d4efdf;
        color: #145a32;
    }

    .badge-pedra {
        background-color: #fcf3cf;
        color: #7d6608;
    }

    .badge-pico {
        background-color: #f5b7b1;
        color: #922b21;
    }

    .table-inscricoes thead {
        background-color: #f8faf9;
    }

    .table-inscricoes tbody tr:hover {
        background-color: #f4fbf7;
    }
</style>

<div class="container my-4">

    <div class="hero-trilhas-list">
        <h2>Inscrições em Trilhas</h2>
        <p>Visualize, filtre e gerencie as inscrições realizadas nas trilhas do WorldCamp.</p>
    </div>

    <form action="./TrilhasList.php" method="post" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Campo</label>
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="data_realizacao">Data de realizacao</option>
                    <option value="trilha">Trilha</option>
                    <option value="numero_acompanhantes">Numero de Acompanhantes</option>
                </select>
            </div>

            <div class="col-md-5">
                <label class="form-label">Valor para pesquisa</label>
                <input type="text" name="valor" placeholder="Digite o termo para buscar" class="form-control">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary w-100 mt-4">Buscar</button>
                </div>
                <div>
                    <a href="./TrilhasForm.php" class="btn btn-success w-100 mt-4">Nova Inscrição</a>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-inscricoes align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de realizacao</th>
                    <th scope="col">Trilha</th>
                    <th scope="col">Numero de Acompanhantes</th>
                    <th scope="col" class="text-center">Editar</th>
                    <th scope="col" class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($agendamento)): ?>
                    <?php foreach ($agendamento as $item): ?>
                        <tr>
                            <th scope="row"><?= $item->Id ?></th>
                            <td><?= $item->nome_usuario ?></td>
                            <td><?= $item->data_realizacao ?></td>
                            <td><?= $item->trilha ?></td>
                            <td><?= $item->numero_acompanhantes ?></td>
                            <td>
                            </td>
                            <td class="text-center">
                                <a href="./TrilhasForm.php?Id=<?= $item->Id ?>">Editar</a>
                            </td>
                            <td class="text-center">
                                <a href="./TrilhasList.php?Id=<?= $item->Id ?>"
                                    onclick="return confirm('Deseja Excluir esta inscrição?')">Excluir</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            Nenhuma inscrição encontrada.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?php
include '../../footer.php';
?>