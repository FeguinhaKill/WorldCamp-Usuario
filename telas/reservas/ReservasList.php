<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db(); 
$db->checkLogin();

if (!empty($_GET['Id'])) {
    $db->deleteReserva($_GET['Id']);
}


if (!empty($_POST)) {
    $reservas = $db->searchReserva($_POST);
} else {
    $reservas = $db->allReservas();
}
?>

<style>
    .hero-reservas-list {
        background: linear-gradient(135deg, #146c43, #198754);
        color: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
    }

    .hero-reservas-list h2 {
        margin: 0;
        font-weight: 700;
    }

    .hero-reservas-list p {
        margin: 0.4rem 0 0;
        opacity: 0.9;
    }

    .table-reservas thead {
        background-color: #f8faf9;
    }

    .table-reservas tbody tr:hover {
        background-color: #f4fbf7;
    }
</style>

<div class="container my-4">

    <div class="hero-reservas-list">
        <h2>Reservas de Hospedagem</h2>
        <p>Visualize, filtre e gerencie as reservas realizadas no WorldCamp.</p>
    </div>

    <form action="./ReservasList.php" method="post" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Campo</label>
                <select name="tipo" class="form-select">
                    <option value="nome-usuario">Nome do hóspede</option>
                    <option value="check-in">Check-in</option>
                    <option value="check-out">Check-out</option>
                    <option value="dormitorio">Dormitório (quantidade)</option>
                </select>
            </div>

            <div class="col-md-5">
                <label class="form-label">Valor para pesquisa</label>
                <input type="text" name="valor" placeholder="Digite o termo para buscar" class="form-control">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <div class="me-2">
                    <button type="submit" class="btn btn-primary w-100 mt-4">
                        Buscar
                    </button>
                </div>
                <div>
                    <a href="./ReservasForm.php" class="btn btn-success w-100 mt-4">
                        Nova Reserva
                    </a>
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
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Dormitório</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reservas)): ?>
                    <?php foreach ($reservas as $item): ?>
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
                                   onclick="return confirm('Deseja excluir esta reserva?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
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
