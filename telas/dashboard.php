<?php
session_start();
include '../header.php';
include '../db.class.php';
$db = new db();
?>

<div class="container">
    <h1>Dashboard</h1>
    <p>Bem-vindo, <?= $_SESSION['nome'] ?>!</p>
</div>
<div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="background-img-fogueira">
                     <div class="card-body">
                        <a href="lojaProdutos.php" class="btn btn-primary mt-2">Ir para Loja</a>
                    </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="card-body">
                        <a href="Reservas.php" class="btn btn-success mt-2">Fazer Reservas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="card-body">
                        <a href="agendarTrilhas.php" class="btn btn-info mt-2">Agendar Trilhas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>