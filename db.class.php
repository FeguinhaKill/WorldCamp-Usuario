<?php

class db
{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $dbname = "WorldCamp";

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

        $sql = "UPDATE listausuarios SET `nome` = ?, `telefone` = ?, `cpf` = ?, `email` = ? WHERE id = $id";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['email'],
        ]);
    }
    function checkLogin()
    {

        if (empty($_SESSION['nome'])) {
            session_destroy();
            header('Location: ../login.php?error=Sessao Expirada!');
        }
    }
}
