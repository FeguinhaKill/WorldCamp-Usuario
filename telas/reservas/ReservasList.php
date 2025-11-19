<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db('agendardormitorio');
$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<style>
    .hero-reservas-list {
        background: linear-gradient(135deg, #145a32, #27ae60);
        color: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    }
    .hero-reservas-list h2 { margin: 0; font-weight: 700; }
    .hero-reservas-list p { margin: 0.4rem 0 0; opacity: 0.9; }
    .badge-tipo { font-size: 0.8rem; padding: 0.3rem 0.55rem; border-radius: 999px; }
    .badge-cabana { background-color: #d4efdf; color: #145a32; }
    .badge-dormi { background-color: #fcf3cf; color: #7d6608; }
    .badge-volun { background-color: #f5b7b1; color: #922b21; }
    .table-reservas thead { background-color: #f8faf9; }
    .table-reservas tbody tr:hover { background-color: #f4fbf7; }
</style>

<div class="container my-4">

    <div class="hero-reservas-list">
        <h2>Reservas de Dormitórios</h2>
        <p>Visualize e gerencie as reservas registradas no sistema.</p>
    </div>

    <form action="./ReservasList.php" method="post" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Campo</label>
                <select name="tipo" class="form-select">
                    <option value="nome_completo">Nome</option>
                    <option value="email">Email</option>
                    <option value="tipo_acomodacao">Tipo de acomodação</option>
                    <option value="data_checkin">Data check-in</option>
                    <option value="data_checkout">Data check-out</option>
                </select>
            </div>

            <div class="col-md-5">
                <label class="form-label">Valor para pesquisa</label>
                <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary w-100 mt-4">Buscar</button>
                </div>
                <div>
                    <a href="./ReservasForm.php" class="btn btn-success w-100 mt-4">Nova Reserva</a>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-reservas align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Hóspedes</th>
                    <th>Email</th>
                    <th>Valor total</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dados)) : ?>
                    <?php foreach ($dados as $item) : ?>
                        <?php
                            $tipoNome = '';
                            $badgeClass = '';

                            switch ($item->tipo_acomodacao) {
                                case 'cabana':
                                    $tipoNome = 'Cabana na Floresta';
                                    $badgeClass = 'badge-cabana';
                                    break;
                                case 'dormitorio':
                                    $tipoNome = 'Dormitório Compartilhado';
                                    $badgeClass = 'badge-dormi';
                                    break;
                                case 'voluntariado':
                                    $tipoNome = 'Programa de Voluntariado';
                                    $badgeClass = 'badge-volun';
                                    break;
                                default:
                                    $tipoNome = $item->tipo_acomodacao;
                                    $badgeClass = 'badge-secondary';
                                    break;
                            }
                        ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->nome_completo ?></td>
                            <td>
                                <span class="badge badge-tipo <?= $badgeClass ?>">
                                    <?= $tipoNome ?>
                                </span>
                            </td>
                            <td><?= $item->data_checkin ?></td>
                            <td><?= $item->data_checkout ?></td>
                            <td><?= $item->qtd_hospedes ?></td>
                            <td><?= $item->email ?></td>
                            <td><?= $item->valor_total ?></td>
                            <td class="text-center">
                                <a href="./ReservasForm.php?id=<?= $item->id ?>">Editar</a>
                            </td>
                            <td class="text-center">
                                <a href="./ReservasList.php?id=<?= $item->id ?>"
                                   onclick="return confirm('Deseja Excluir?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            Nenhuma reserva encontrada.
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

