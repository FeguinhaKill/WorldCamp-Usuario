<?php
session_start();
include '../header.php';
include '../db.class.php';
$db = new db();

$db->checkLogin();
?>
<link rel="stylesheet" href="../css/styles.css">
<div class="container">
    <Title>Dashboard do Usuário</Title>
    <h1>Dashboard</h1>
    <?php echo("Bem-vindo! " . $_SESSION["nome"]); ?>
</div>
<div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="background-img-loja">
                <div class="card-body">
                    <a href="lojaProdutos.php" class="btn btn-primary mt-2">Ir para Loja</a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="background-img-reservas">
                <div class="card-body">
                        <a href="Reservas.php" class="btn btn-success mt-2">Fazer Reservas</a>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="background-img-trilhas">
                <div class="card-body">
                    <a href="agendarTrilhas.php" class="btn btn-info mt-2">Agendar Trilhas</a>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include '../footer.php';
?>