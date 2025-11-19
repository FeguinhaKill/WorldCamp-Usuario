<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';

$db = new db('agendardormitorio');
$db->checkLogin();
$data = null;

if (!empty($_POST)) {
    try {
        if (empty($_POST['Id'])) {
            $db->storeReserva([
                "nome-usuario" => $_POST['nome-usuario'],
                "check-in"     => $_POST['check-in'],
                "check-out"    => $_POST['check-out'],
                "dormitorio"   => $_POST['dormitorio'],
            ]);

            echo "Reserva criada com sucesso!";
        } else {
            $db->updateReserva([
                "Id"           => $_POST['Id'],
                "nome-usuario" => $_POST['nome-usuario'],
                "check-in"     => $_POST['check-in'],
                "check-out"    => $_POST['check-out'],
                "dormitorio"   => $_POST['dormitorio'],
            ]);

            echo "Reserva atualizada com sucesso!";
        }

        echo "<script>
                setTimeout(() => window.location.href = 'ReservasList.php', 800);
             </script>";
    } catch (Exception $e) {
        var_dump($e->getMessage());
        exit();
    }
}

if (!empty($_GET['Id'])) {
    $data = $db->findReserva($_GET['Id']);
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
        :root { --verde:#198754; --verde-escuro:#146c43; --texto:#212529; }
        body { margin:0; background:#f5f8f6; color:var(--texto); }
        .btn-success { background:var(--verde); border-color:var(--verde-escuro); }
        .btn-success:hover { background:var(--verde-escuro); }
        .hero-reservas {
            background:linear-gradient(rgba(0,0,0,.45),rgba(0,0,0,.55)),
            url("https://images.unsplash.com/photo-1523419409543-3e4f83b9b4c9?auto=format&fit=crop&w=1600&q=80")
            center/cover no-repeat;
            color:white;
            text-align:center;
            padding:5rem 2rem;
            border-radius:10px;
            margin-top:2rem;
        }
        .hero-reservas h1 { font-size:2.8rem; font-weight:700; }
        .resumo-total { font-size:0.9rem; color:#6c757d; }
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

    <section id="form-reserva" class="mb-5">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h3 class="mb-3"><i class="fa-solid fa-pen-to-square"></i> Solicitar reserva</h3>

                        <form action="" method="post" id="formReserva">
                            <input type="hidden" name="Id" value="<?= $data->Id ?? '' ?>">

                            <div class="mb-3">
                                <label class="form-label">Nome completo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nome-usuario"
                                    value="<?= $data->{'nome-usuario'} ?? '' ?>"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo de acomodação</label>
                                <select class="form-select" name="tipo_acomodacao" id="tipo_acomodacao">
                                    <option value="">Selecione uma opção</option>
                                    <option value="cabana">Cabana na Floresta</option>
                                    <option value="dormitorio">Dormitórios Compartilhados</option>
                                    <option value="voluntariado">Programa de Voluntariado</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-in</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="checkin"
                                        name="check-in"
                                        value="<?= $data->{'check-in'} ?? '' ?>"
                                        required
                                    >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-out</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="checkout"
                                        name="check-out"
                                        value="<?= $data->{'check-out'} ?? '' ?>"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Valor total estimado</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="valor_total"
                                    readonly
                                    placeholder="R$ 0,00"
                                >
                                <div class="resumo-total mt-1" id="resumo_diarias"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dormitório (quantidade)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="dormitorio"
                                    min="1"
                                    value="<?= $data->dormitorio ?? '' ?>"
                                    required
                                >
                            </div>

                            <button type="button" onclick="agendarreserva()" class="btn btn-success w-100">
                                <i class="fa-solid fa-paper-plane"></i> Salvar reserva
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    function agendarreserva() {
        document.getElementById('formReserva').submit();
    }

    const campoTipo = document.getElementById('tipo_acomodacao');
    const campoCheckin = document.getElementById('checkin');
    const campoCheckout = document.getElementById('checkout');
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
        const diff = (dataOut - dataIn) / (1000 * 60 * 60 * 24);

        if (isNaN(diff) || diff <= 0) {
            campoValorTotal.value = '';
            resumoDiarias.textContent = 'Check-out deve ser depois do check-in.';
            return;
        }

        const diaria = valoresDiaria[tipo] ?? 0;

        if (tipo === 'voluntariado') {
            campoValorTotal.value = 'R$ 0,00';
            resumoDiarias.textContent = 'Programa de voluntariado: sem cobrança de diária.';
            return;
        }

        const total = diaria * diff;

        campoValorTotal.value = total.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

        resumoDiarias.textContent =
            `Cálculo: ${diff} diária(s) × ` +
            diaria.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) +
            ` = ${campoValorTotal.value}`;
    }

    campoTipo.addEventListener('change', calcularTotal);
    campoCheckin.addEventListener('change', calcularTotal);
    campoCheckout.addEventListener('change', calcularTotal);
</script>

<?php include '../../footer.php'; ?>
</body>
</html>
