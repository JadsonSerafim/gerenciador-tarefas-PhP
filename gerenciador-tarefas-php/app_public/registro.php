<?php

?>

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
        <link rel="icon" type="image/png" href="agenda.png">

    <title>Registre-se</title>
</head>
<body class="bg-primary conteudo">
<div class="container bg-dark pt-5 mb-5">
    <h1 class="text-center text-white">Registre-se</h1>
    <p class="text-center text-white">Por favor, preencha todos os campos</p>

    <div class=" bg-dark">
     <form class="form" id="formRegistro">
            <label class="text-white" for="">Nome:</label>
        <input name="nome" type="text" id="nomeRegistro" class="form-control" placeholder="Como devemos te chamar?">
        <label class="text-white" for="">E-mail:</label>
        <input name="email" type="email" id="emailRegistro" class="form-control" placeholder="Digite seu e-mail">
        <label class="text-white" for="">Senha:</label>
        <input name="senha" type="password" id="senhaRegistro" class="form-control" placeholder="Digite sua senha">
        <button type="submit" class="btn btn-primary mt-3 form-control" id="btnCadastrar">Cadastrar-se</button>
         <p id="mensagem"></p>

    </form>
    <div>
        <p class="text-white text-center mt-3">Já tem uma conta? <a href="#" data-pagina="login.php" class=" text-decoration-none link">Clique aqui</a></p>
    </div>
    </div>
    </div>

   
    
    
</body>

</html>