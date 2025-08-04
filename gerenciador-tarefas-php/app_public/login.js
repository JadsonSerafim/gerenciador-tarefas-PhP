$(document).ready(function() {
    const URL = 'http://localhost/gerenciador-tarefas-php/API';

$('.link').click(function(evento){
    evento.preventDefault

    let pagina = $(this).data('pagina')
   
    $('.conteudo').load(pagina)

    })


    //Criar um usuário 

$('#formRegistro').on('submit',function(evento){
    evento.preventDefault();

    let nome = $('#nomeRegistro').val();
    let email = $('#emailRegistro').val();
    let senha = $('#senhaRegistro').val();
    let form = $(this)
 let jsonDadosUsuario = {
        nome: nome,
        email: email,
        senha: senha
                      };

       $.ajax({
    url: URL + '/registro',
    type: 'POST',
    contentType: 'application/json',
    data:JSON.stringify(jsonDadosUsuario),
    dataType: 'json',
    success: function(data){
                $('#mensagem').css('color','green')
                $('#mensagem').text(data.mensagem)
                form.trigger("reset"); 

console.log(data.mensagem)
    },
    error: function(xhr,status,error){
                             $('#mensagem').css('color','red')
                            $('#mensagem').text(xhr.responseJSON['mensagem'])

                
            }
    
   })

})

//Fazer Login

$('#formLogin').on('submit', function(evento){
    evento.preventDefault()
    let email = $('#emailLogin').val();
    let senha = $('#senhaLogin').val();

    let jsonParaLogin = {
        email: email,
        senha: senha
    }

    $.ajax({
        url: URL + '/processa-login',
        type: 'POST',
        contentType: 'application/json',
        data:JSON.stringify(jsonParaLogin),
        dataType: 'json',
        success: function(data){

        window.location.href= '../index.php'

        },
        error: function(xml){
            $('#mensagemErro').text(xml.responseJSON['mensagem'])

    }
    })
})
$('#logout').on('click', function(evento){
    evento.preventDefault()

    $.ajax({
        url: URL + '/logout',
        type: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        success: function(){
            window.location.href = 'app_public/login.php'
        }
    })
})

})