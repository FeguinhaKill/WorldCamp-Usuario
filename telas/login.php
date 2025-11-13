<?php
include '../db.class.php';
$db = new db();

$dados = $db->all();


session_start(); //caso uma sessao ja esteja iniciada, pula para a tela do usuario
$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//if para verificação do usuario
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?: '';
    $senha = $_POST['senha'] ?? '';

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Informe um email válido.';
    }
    if (empty($senha)) {
        $errors[] = 'Informe a senha.';
    }
    if (empty($errors)) {
        foreach ($dados as $item) {

            if (empty($errors)) {
                $encontrou = false;
                foreach ($dados as $item) {
                    if ($email === $item->email && $senha === $item->senha) {
                        $GLOBALS[$item->nome] ;
                        $_SESSION['user_id'] = $item->id;
                        session_name($item->nome);
                        header('Location: dashboard.php');
                        exit;
                    }
                }
                $encontrou = false;
                echo "<script>alert('Email ou senha inválidos.');</script>";
            }
        }
        $errors[] = 'Email ou senha inválidos.';
    }
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - WorldCamp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f5f7fb;
        }

        .auth-card {
            max-width: 420px;
            margin: 6vh auto;
            padding: 28px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(20, 20, 50, 0.08);
        }

        .logo {
            font-weight: 700;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="logo h1">WorldCamp</div>
            </div>

            <form method="post">
                <input type="hidden" name="csrf" value="">

                <div class="mb-3">
                    <label for="email" class="form-label small">Email</label>
                    <input id="email" name="email" type="email" class="form-control" required
                        value="" placeholder="seuemail@gmail.com">
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label small">Senha</label>
                    <input id="senha" name="senha" type="password" class="form-control" required placeholder="senha..">
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="/telas/recuperar_senha.php" class="small">Esqueci minha senha...</a>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

                <div class="text-center small">
                    <a href="/telas/criar.php">Não tenho uma conta '-'</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>