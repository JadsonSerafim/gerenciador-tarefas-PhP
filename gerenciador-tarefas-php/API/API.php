<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 // Permite acesso das requisições do frontend, problemas se retirar!
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
require '../vendor/autoload.php';
require '../src/Conexao.php';
   session_start();


$conexao = new App\Conexao\Conexao();
$pdo = $conexao->conectar();
$router = new \Bramus\Router\Router();
// Garante a rota certa
$router->setBasePath('/gerenciador-tarefas-php/API');



// listar todas as tarefas pendentes
$router->get('/tarefas', function() use ($pdo) {
 
    try {
        $sql = "SELECT id, titulo, descricao, id_usuario, DATE_FORMAT(data_criacao, '%d/%m/%Y') as dataFormatada, DATE_FORMAT(data_vencimento, '%d/%m/%Y') as dataVencimento FROM tarefas WHERE concluida = 0 AND id_usuario = ? ORDER BY data_criacao DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tarefas);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao listar tarefas: ' . $e->getMessage()]);
    }
});
//listar todas as tarefas concluídas
$router->get('/tarefas/concluidas', function() use ($pdo) {
    try {
        $sql = "SELECT id, titulo, descricao, id_usuario, DATE_FORMAT(data_conclusao, '%d/%m/%Y') as dataConclusao FROM `tarefas` WHERE concluida = 1 AND id_usuario = ? ORDER BY data_criacao DESC";
       $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tarefas);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao listar tarefas: ' . $e->getMessage()]);
    }
});




// criar uma nova tarefa
$router->post('/tarefas/adicionar', function() use ($pdo) {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['erro' => 'Usuário não autorizado, faça login.']);
        return;
    }
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['titulo']) || empty($data['titulo'])) {
        http_response_code(400);
        echo json_encode(['erro' => 'O título é obrigatório.']);
        return;
    }

    try {
        $sql = 'INSERT INTO tarefas (titulo, descricao, id_usuario, data_vencimento) VALUES (:titulo, :descricao, :id_usuario, :data_vencimento)';
        $stmt = $pdo->prepare($sql);
        
        $titulo = $data['titulo'];
        $descricao = $data['descricao'] ?? null;
        $id_usuario = $_SESSION['user_id'] ?? null;
        $data_vencimento = $data['data_vencimento'] ?? null;
        

        

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':data_vencimento', $data_vencimento, PDO::PARAM_STR);
        $stmt->execute();
        
        http_response_code(201);
        echo json_encode(['mensagem' => 'Tarefa criada com sucesso', 'id' => $pdo->lastInsertId()]);

    } catch(\PDOException $e) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao criar tarefa: ' . $e->getMessage()]);
    }
});

//Tornar a tarefa como concluida
$router->put('/tarefas/(\d+)/concluir', function($id) use ($pdo) {
    try {
        $sql = 'UPDATE tarefas SET concluida = 1, data_conclusao = NOW() WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['mensagem' => 'Tarefa marcada como concluída.']);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Tarefa não encontrada ou tarefa já estava concluída.']);
        } 
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao atualizar tarefa: ' . $e->getMessage()]);
    }
});

//deletar uma tarefa
$router->delete('/tarefas/(\d+)', function($id) use ($pdo) {
    try {
        $sql = 'DELETE FROM tarefas WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['mensagem' => 'Tarefa excluída com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Tarefa não encontrada']);
        }
    } catch(\PDOException $e) {
        http_response_code(500);
        echo json_encode(['erro' => 'Erro ao excluir tarefa: ' . $e->getMessage()]);
    }
});


//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------//




//processa o login


$router->post('/processa-login', function() use ($pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? null;
    $senha = $data['senha'] ?? null;

    if (!$email || !$senha) {
        http_response_code(400); 
        echo json_encode(['sucesso' => false, 'mensagem' => 'Por favor, preencha todos os campos.']);
        return;
    }

    try {
        // Busca o usuário pelo e-mail
        $sql = 'SELECT * FROM `login` WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Verifica se o usuário existe e se a senha (usando password_verify) confere
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            http_response_code(200);
            echo json_encode(['sucesso' => true, 'mensagem' => 'Login realizado com sucesso.']);
        } else {
            http_response_code(401); 
            echo json_encode(['sucesso' => false, 'mensagem' => 'E-mail ou senha inválidos.']);
        }
    } catch (\PDOException $e) {
        http_response_code(500);
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro no servidor ao processar o login.']);
    }
});

// Processar o registro 
$router->post('/registro', function() use ($pdo) {

    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'] ?? null;
    $email = $data['email'] ?? null;
    $senha = $data['senha'] ?? null;
    
    if (!$nome || !$email || !$senha) {
        http_response_code(400); 
        echo json_encode(['sucesso' => false, 'mensagem' => 'Por favor, preencha todos os campos.']);
        return;
    };

    try{
        // Verifica se o e-mail já existe
        $sql = 'SELECT email from `login` where email = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            http_response_code(409); // Conflict - mais apropriado que 400
            echo json_encode(['sucesso' => false, 'mensagem' => 'E-mail já cadastrado.']);
            return;
        };

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO `login` (nome, email, senha) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senhaHash]);
        
        http_response_code(201);
        echo json_encode(['sucesso' => true, 'mensagem' => 'Cadastro realizado com sucesso!']);

    } catch (\PDOException $e) {
        http_response_code(500);
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro no servidor ao processar o registro.']);
    }
});

$router->get('/logout', function() {
    session_destroy();
    http_response_code(200);
    echo json_encode(['sucesso' => true, 'mensagem' => 'Logout realizado com sucesso.']);
});

// Executa o roteador
$router->run();