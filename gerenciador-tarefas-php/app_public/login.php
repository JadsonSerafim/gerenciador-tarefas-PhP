<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="login.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <link rel="icon" type="image/png" href="app_public/agenda.png">

    <title>Login</title>
</head>
<body class="bg-primary conteudo" >
<div class="container bg-dark pt-5 mb-5">
    <h1 class="text-center text-white">Gerenciador de Tarefas</h1>
    <p class="text-center text-white">Seu assistente para gerenciar tarefas e rotinas.</p>

    <div class=" bg-dark">
    <form class="form" id="formLogin">
        <label class="text-white" for="">E-mail:</label>
        <input name='email' type="email" id="emailLogin" class="form-control" placeholder="Digite seu e-mail">
        <label class="text-white" for="">Senha:</label>
        <input name="senha" type="password" id="senhaLogin" class="form-control" placeholder="Digite sua senha">
        <button type="submit" class="btn btn-primary mt-3 form-control" id="btnLogin">Entrar</button>
        <p id="mensagemErro"></p>
    </form>
    <div>
        <p class="text-white text-center mt-3">Não tem uma conta? <a href="#" data-pagina="registro.php" class="text-decoration-none link">Cadastre-se</a></p>

    </div>
    </div>
    </div>


    
    
</body>

</html>