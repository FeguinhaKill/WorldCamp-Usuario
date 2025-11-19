<?php

class db
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $dbname = "WorldCamp";

    public function query($sql, $params = [])
    {
        $conn = $this->conn();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function conn()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => " SET NAMES utf8"
                ]
            );

            return $conn;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function store($dados)
    {
        $conn = $this->conn();

        $sql = "INSERT INTO `listausuarios` (`Nome`, `Email`, `cpf`, `telefone`, `senha`) 
                VALUES (?, ?, ?, ?, ?);";
        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['email'],
            $dados['cpf'],
            $dados['telefone'],
            $dados['senha'],
        ]);
    }

    public function all()
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM listausuarios";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function destroy($id)
    {
        $conn = $this->conn();

        $sql = "DELETE FROM listausuarios WHERE id = ?";

        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function find($id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM listausuarios WHERE id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetchObject();
    }

    public function update($dados)
    {
        $id = $dados['id'];
        $conn = $this->conn();

        $sql = "UPDATE listausuarios 
                   SET `nome` = ?, `telefone` = ?, `cpf` = ?, `email` = ? 
                 WHERE id = $id";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['email'],
        ]);
    }

    public function storeReserva($dados)
    {
        $conn = $this->conn();

        $sql = "INSERT INTO `agendardormitorio` 
                (`nome-usuario`, `check-in`, `check-out`, `dormitorio`) 
                VALUES (?, ?, ?, ?)";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome-usuario'],
            $dados['check-in'],
            $dados['check-out'],
            $dados['dormitorio'],
        ]);
    }

    public function updateReserva($dados)
    {
        $conn = $this->conn();

        $sql = "UPDATE `agendardormitorio`
                   SET `nome-usuario` = ?, 
                       `check-in` = ?, 
                       `check-out` = ?, 
                       `dormitorio` = ?
                 WHERE Id = ?";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome-usuario'],
            $dados['check-in'],
            $dados['check-out'],
            $dados['dormitorio'],
            $dados['Id']
        ]);
    }

    public function allReserva()
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM agendardormitorio";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function destroyReserva($id)
    {
        $conn = $this->conn();

        $sql = "DELETE FROM agendardormitorio WHERE Id = ?";

        $st = $conn->prepare($sql);
        $st->execute([$id]);
    }

    public function findReserva($id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM agendardormitorio WHERE Id = ?";
        $st = $conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetchObject();
    }

    function checkLogin()
    {
        if (empty($_SESSION['nome'])) {
            session_destroy();
            header('Location: ../login.php?error=Sessao Expirada!');
        }
    }

    public function getCompras()
    {
        $conn = $this->conn();

        $sql = "SELECT * FROM compras_realizadas ORDER BY data_compra DESC";
        $st = $conn->prepare($sql);
        $st->execute();

        $comprasBD = $st->fetchAll(PDO::FETCH_ASSOC);

        $compras = [];

        foreach ($comprasBD as $c) {
            $compras[] = [
                'id'           => $c['id'],
                'nome_usuario' => $c['nome_usuario'],
                'data'         => $c['data_compra'],
                'itens'        => json_decode($c['produtos_json'], true)
            ];
        }

        return $compras;
    }

    public function getProdutos()
    {
        $conn = $this->conn();

        $sql = "SELECT * FROM produtos";
        $st = $conn->prepare($sql);
        $st->execute();
        $produtosBD = $st->fetchAll(PDO::FETCH_ASSOC);

        $produtos = [];

        foreach ($produtosBD as $p) {
            $sqlDescricao = "SELECT descricao FROM produtos_descricao WHERE product_id = ?";
            $stDesc = $conn->prepare($sqlDescricao);
            $stDesc->execute([$p['id']]);
            $descricaosBD = $stDesc->fetchAll(PDO::FETCH_ASSOC);

            $listaDescricoes = [];
            foreach ($descricaosBD as $f) {
                $listaDescricoes[] = $f['descricao'];
            }
            $produtos[$p['id']] = [
                'id'         => $p['id'],
                'nome'       => $p['nome'],
                'categoria'  => $p['categoria'],
                'preco'      => $p['preco'],
                'imagem'     => $p['imagem_path'],
                'descricaos' => $listaDescricoes
            ];
        }

        return $produtos;
    }
}
?>
