<?php


session_start();

if (!isset($_SESSION['user_id'])) {

    header('Location: app_public/login.php');
    exit();
}

$idDoUsuario = $_SESSION['user_id'];
$nomeDoUsuario = $_SESSION['nome'];

?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app_public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="app_public/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="app_public/login.js"></script>
    <link rel="icon" type="image/png" href="app_public/agenda.png">

    <title>Gerenciador de tarefas</title>

</head>
<header class="bg-primary">
     <!-- Sidebar feita com bootstrap -->
    <div class="sidebar d-flex flex-column p-3 bg-primary">
       <h5 class="hr mb-4">Olá, <?= $nomeDoUsuario ?></h5>
        <h4 class="text-center">Menu  </h4>
        <a href="#" id="tarefasGet">Tarefas pendentes <i class="bi bi-calendar3"></i></a>
        <a href="#" id="tarefasGetConcluidas">Tarefas concluidas  <i class="bi bi-calendar-check-fill"></i></a>
        <a href="#" id="logout">Logout <i class="bi bi-door-open-fill"></i></a>
    </div>
</header>
<body class="bg-dark">
    <h5 class=""></h5>
    <div class="content">
        <div>
            <p class="text-white h5"  id="data"></p>
             <p class="text-white"  id="contadorDeTarefasPendentes"></p>

        </div>
        <h3 class="text-center text-white mt-5">Adicione sua tarefa abaixo</h3>
             <!-- Formulário -->
        <form id="formTarefa">
            <div class="input-group mb-3 mt-5">
                <input type="text" id="titulo" class="form-control" placeholder="Digite um titulo para a terefa">
                <input type="text" id="descricao" class="form-control" placeholder="Descrição da tarefa(opcional)">
                <input type="date" id="data_vencimento" class="form-control" name="data_vencimento">
              <button type="submit" class="btn btn-primary" id="btnAdicionar">Adicionar</button>
            </div>
        </form>

        <div id="titulo-secao"></div>

        <div class="row" id="ContainerTarefas">
            </div>
    </div>
</body>
</html>

