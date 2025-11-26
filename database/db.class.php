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

    public function conn()
    {
        try {
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );

            return $conn;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            exit;
        }
    }

 

    public function store($dados)
    {
        $conn = $this->conn();

        $sql = "INSERT INTO `usuarios` (`Nome`, `Email`, `cpf`, `telefone`, `senha`) 
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
        $sql = "SELECT * FROM usuarios";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    public function find($id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM usuarios WHERE id = ?";
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
        $sql = "SELECT * FROM agendardormitorio ORDER BY Id DESC";
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
public function getComprasFiltradas($post)
{
    if (!empty($post["valor"])) {
        return $this->searchCompras($post);
    }
    return $this->getCompras();
}
public function processarUpdateCompra()
{
    if (!isset($_POST['salvar'])) {
        return;
    }

    $id = intval($_POST['id']);
    $qtd = intval($_POST['quantidade']);
    $itemIndex = intval($_POST['itemIndex']);

    if ($qtd > 0 && $this->updateCompra($id, $itemIndex, $qtd)) {
        echo "<script>alert('Quantidade alterada!');window.location='lojaList.php';</script>";
        exit;
    }

    header('Location: lojaList.php');
    exit;
}
public function processarExclusaoCompra()
{
    if (!isset($_GET['excluir'])) {
        return;
    }

    $id = intval($_GET['excluir']);

    if ($this->deleteCompra($id)) {
        echo "<script>alert('Compra excluída com sucesso!');window.location='lojaList.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao excluir');</script>";
}
public function getReservasFiltradas($post)
{
    if (!empty($post)) {
        return $this->searchReserva($post);
    }
    return $this->allReservas();
}
public function processarExclusaoReserva()
{
    if (!isset($_GET['Id'])) {
        return;
    }

    $id = intval($_GET['Id']);

    if ($this->deleteReserva($id)) {
        echo "<script>alert('Reserva excluída!');window.location='ReservasList.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao excluir reserva');</script>";
}
public function processarExclusaoTrilha()
{
    if (!isset($_GET['Id'])) {
        return;
    }

    $id = intval($_GET['Id']);

    if ($this->deleteTrilha($id)) {
        echo "<script>alert('Agendamento excluído!');window.location='trilhasList.php';</script>";
        exit;
    }

    echo "<script>alert('Erro ao excluir agendamento');</script>";
}
public function getTrilhasFiltradas($post)
{
    if (!empty($post)) {
        return $this->searchTrilha($post);
    }
    return $this->allTrilhas();
}



    public function searchReserva($dados)
    {
        $tipo  = $dados["tipo"];  
        $valor = $dados["valor"];

        
        $colunasValidas = ["nome-usuario", "check-in", "check-out", "dormitorio"];

        if (!in_array($tipo, $colunasValidas)) {
            return [];
        }

      
        $sql = "SELECT * FROM agendardormitorio 
                WHERE `$tipo` LIKE :valor
                ORDER BY Id DESC";

        $stmt = $this->conn()->prepare($sql);
        $stmt->bindValue(':valor', '%' . $valor . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
public function searchCompras($dados)
{
    $tipo  = $dados["tipo"];
    $valor = strtolower($dados["valor"]);

    $todas = $this->getCompras();
    $resultado = [];

    foreach ($todas as $compra) {

        $match = false;
        $itensFiltrados = [];

        foreach ($compra['itens'] as $item) {

            if ($tipo == "produto" && str_contains(strtolower($item['nome']), $valor)) {
                $match = true;
                $itensFiltrados[] = $item;
            }
        }

        if ($tipo == "usuario" && str_contains(strtolower($compra['nome_usuario']), $valor)) {
            $match = true;
            $itensFiltrados = $compra['itens']; // mantém todos
        }

        if ($tipo == "data" && str_contains(strtolower($compra['data']), $valor)) {
            $match = true;
            $itensFiltrados = $compra['itens'];
        }

        if ($match)
            $resultado[] = [
                "id"           => $compra['id'],
                "nome_usuario" => $compra['nome_usuario'],
                "data"         => $compra['data'],
                "itens"        => $itensFiltrados
            ];
    }
    return $resultado;
}


    public function allReservas()
    {
       
        return $this->allReserva();
    }

    public function deleteReserva($id)
    {
        return $this->destroyReserva($id);
    }



    public function storeTrilha($dados)
    {
        $conn = $this->conn();

        $sql = "INSERT INTO `agendartrilhas` 
                (`nome_usuario`, `trilha`, `data_realizacao`, `numero_acompanhantes`) 
                VALUES (?, ?, ?, ?)";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome_usuario'],
            $dados['trilha'],
            $dados['data_realizacao'],
            $dados['numero_acompanhantes'],
        ]);
    }

    public function updateTrilha($dados)
    {
        $conn = $this->conn();

        $sql = "UPDATE `agendartrilhas`
                   SET `nome_usuario` = ?, 
                       `trilha` = ?, 
                       `data_realizacao` = ?, 
                       `numero_acompanhantes` = ?
                 WHERE Id = ?";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome_usuario'],
            $dados['trilha'],
            $dados['data_realizacao'],
            $dados['numero_acompanhantes'],
            $dados['Id']
        ]);
    }

    public function searchTrilha($dados)
    {
        $tipo  = $dados["tipo"];   
        $valor = $dados["valor"];

        $mapaColunas = [
            "nome"                => "nome_usuario",
            "data_realizacao"     => "data_realizacao",
            "trilha"              => "trilha",
            "numero_acompanhantes"=> "numero_acompanhantes"
        ];

        if (!isset($mapaColunas[$tipo])) {
            return [];
        }

        $coluna = $mapaColunas[$tipo];

        $sql = "SELECT * FROM agendartrilhas 
                WHERE $coluna LIKE :valor
                ORDER BY Id DESC";

        $stmt = $this->conn()->prepare($sql);
        $stmt->bindValue(':valor', '%' . $valor . '%', PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   
    public function allTrilhas()
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM agendartrilhas ORDER BY Id DESC";
        $st = $conn->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_OBJ);
    }

    public function findTrilha($Id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM agendartrilhas WHERE Id = :Id";
        $st = $conn->prepare($sql);
        $st->bindValue(':Id', $Id, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_OBJ);
    }

    public function deleteTrilha($Id)
    {
        $conn = $this->conn();
        $sql = "DELETE FROM agendartrilhas WHERE Id = :Id";
        $st = $conn->prepare($sql);
        $st->bindValue(':Id', $Id, PDO::PARAM_INT);
        return $st->execute();
    }

public function updateCompra($id, $itemIndex, $qtd)
{
    $compra = $this->query("SELECT produtos_json FROM compras_realizadas WHERE id=?", [$id]);
    if (!$compra) return false;

    $lista = json_decode($compra[0]['produtos_json'], true);

    if (isset($lista[$itemIndex])) {
        $lista[$itemIndex]['quantidade'] = $qtd;
    }

    $json = json_encode($lista, JSON_UNESCAPED_UNICODE);

    return $this->query("UPDATE compras_realizadas SET produtos_json=? WHERE id=?", [$json, $id]);
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

    public function deleteCompra($id)
    {
        $sql = "DELETE FROM compras_realizadas WHERE id = ?";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$id]);
    }


public function checkLogin()
{
    if (empty($_SESSION['nome'])) {
        session_destroy();
     
        header('Location: ../localhost/WorldCamp-Usuario/usuario/login.php');
        exit;
    }
}


    
}

?>
