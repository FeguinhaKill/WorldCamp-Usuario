<?php
include '../header.php';
include '../db.class.php';
$db = new db();
if (!empty($_POST)) {

    try {
        if (empty($_POST['id'])) {
            $db->store([
                "id" => $_POST['id'],
                "nome" => $_POST['nome'],
                "telefone" => $_POST['telefone'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email'],
                "senha" => $_POST['senha'],
            ]);
        echo "Usuario criado com sucesso";
        } else {
            $db->update([
                "id" => $_POST['id'],
                "nome" => $_POST['nome'],
                "telefone" => $_POST['telefone'],
                "cpf" => $_POST['cpf'],
                "email" => $_POST['email'],
                "senha" => $_POST['senha'],
            ]);
        echo "Usuario editado com sucesso";
        }
        echo "<script>
        setTimeout(
        ()=>window.location.href = 'pagina.php', 6900);
        </script>";
    } catch (Exception $e) {
        var_dump("Erro ao criar usuário: " . $e->getMessage());
        exit;
    }
}
if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

?>

<h3>Isso será o começo de algo belo, primeiro vamos criar sua conta!</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
    <div class="row">
        <div class="col-0">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $data->nome ?? '' ?>" required>
        </div>
        <div class="col-0">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $data->email ?? '' ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $data->cpf ?? '' ?>" required>
        </div>
        <div class="col">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $data->telefone ?? '' ?>" required>
        </div>
        <div class="row">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" value="<?= $data->senha ?? '' ?>" required>
        </div>
        <div class="row">
            <label for="senha" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="c_senha" name="c_senha" required>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        <a href="./pagina.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</form>


<?php
include '../footer.php';
?>