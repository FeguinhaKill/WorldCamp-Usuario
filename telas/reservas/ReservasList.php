<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db();
$db->checkLogin();

if (!empty($_GET['Id'])) {
    $db->destroyReserva($_GET['Id']);
}

$dados = $db->allReserva();
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
    .table-reservas thead { background-color: #f8faf9; }
    .table-reservas tbody tr:hover { background-color: #f4fbf7; }
</style>

<div class="container my-4">

    <div class="hero-reservas-list">
        <h2>Reservas de Dormitórios</h2>
        <p>Visualize e gerencie as reservas registradas no sistema.</p>
    </div>

    <div class="mb-3">
        <a href="./ReservasForm.php" class="btn btn-success">Nova Reserva</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-reservas align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do usuário</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Dormitório</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dados)) : ?>
                    <?php foreach ($dados as $item) : ?>
                        <tr>
                            <td><?= $item->Id ?></td>
                            <td><?= $item->{'nome-usuario'} ?></td>
                            <td><?= $item->{'check-in'} ?></td>
                            <td><?= $item->{'check-out'} ?></td>
                            <td><?= $item->dormitorio ?></td>
                            <td class="text-center">
                                <a href="./ReservasForm.php?Id=<?= $item->Id ?>">Editar</a>
                            </td>
                            <td class="text-center">
                                <a href="./ReservasList.php?Id=<?= $item->Id ?>"
                                   onclick="return confirm('Deseja Excluir?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">
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
