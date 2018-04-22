$(document).ready(function(){
    tipoBusca="<?= $tipoBusca ?>";
    $('.razaosocial').mouseover(function(){
        $(this).css('cursor','pointer')
        $(this).css('background','silver')
        $(this).mouseleave(function(){
            $('.razaosocial').css('background','white')
        })
        $(this).click(function(){
            var codigo_cliente=$(this).attr('linha');
            var razao=$(this).attr('razao');
            var cnpj_cpf=$(this).attr('cnpj_cpf');
            var contato=$(this).attr('contato');
            var email=$(this).attr('email');
            var endereco=$(this).attr('endereco');
            var numero=$(this).attr('numero');
            var bairro=$(this).attr('bairro');
            var cep=$(this).attr('cep');
            var cidade=$(this).attr('cidade');
            $(location).attr('href','../web/index.php?pagina=pedido&act=cad&codigo_cliente='+codigo_cliente+'&razao='+razao+'&cnpj_cpf='+cnpj_cpf+'&contato='+contato+'&email='+email+'&endereco='+endereco+'&endereco_numero='+numero+'&bairro='+bairro+'&cep='+cep+'&cidade='+cidade+'&origem=cliente')
        })
    })
    $('.pagina').text('CLIENTE')
    $(".procura2 input").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        if($('.tipoBusca :checked').val()){
            $(".listaCliente .tudo").filter(function(){
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }
    });
    $('button.paginacao').each(function(){
        $(this).css('cursor','pointer')
        $(this).css({
            border: 'none'
        })
        if($(this).text()==pagAtual){
            $(this).css({
                border: 'solid #767e7e'
            });
        }
    })
    $('button').focus(function(){
        pagAtual=$(this).text();
        $('button').each(function(){
            $(this).css({
                border: 'none'
            })
            if($(this).text()==pagAtual){
                $(this).css({
                    border: 'solid #767e7e'
                });
            }
        })
        var tags;
        var tipoBusca;
        $('input:checked').each(function(){
            if(!tags){
                tags = $(this).attr('name');
            }else{
                tags += ','+$(this).attr('name');
            }
            tipoBusca=$(':checked[name=tipoBusca]').val();
        })
        link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'';         
        $('.tudo').hide()
        $('.tituloProd').text('Aguarde...')
        $(location).attr('href',link)
    })

    $('.tituloProd').text('Páginas ');
    $('.total').text('Registros '+contador+' de '+total+'')

    $('.recarrega').css('cursor','pointer')
    $('.recarrega').click(function(){
        var tags;
        var buscaPor=$('.procura2 input').val();
        if(!buscaPor){
            $('input:checked').each(function(){
                if(!tags){
                    tags = $(this).attr('name');
                }else{
                    tags += ','+$(this).attr('name');
                }
                tipoBusca=$(':checked[name=tipoBusca]').val();
            })
        }
        link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'&buscaPor='+buscaPor+'';
        $('.tudo').hide()
        $('.tituloProd').text('Aguarde...')
        $(location).attr('href',link)     
    })
    $('.procura2 img').click(function(){
        if($(':checked[name=tipoBusca]').val()=='local'){
            if($('.procura2 input').val()){
                var tipoBusca;
                var buscaPor=$('.procura2 input').val();
                var tags;
                if(!buscaPor){
                    $('.filtroTag input:checked').each(function(){
                        if(!tags){
                            tags = $(this).attr('name');
                        }else{
                            tags += ','+$(this).attr('name');
                        }                            
                    })
                }
                $('input:checked').each(function(){
                    tipoBusca=$(':checked[name=tipoBusca]').val();
                })
                link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'&buscaPor='+buscaPor+'';
                $('.tituloProd').text('Aguarde...')
                $(location).attr('href',link)                        
            }else{
                var tags;
                var tipoBusca;
                $('input:checked').each(function(){
                    if(!tags){
                        tags = $(this).attr('name');
                    }else{
                        tags += ','+$(this).attr('name');
                    }
                    tipoBusca=$(':checked[name=tipoBusca]').val();
                })
                var buscaPor=$('.procura2 input').val();
                link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'&buscaPor='+buscaPor+'';
                $('.tituloProd').text('Aguarde...')
                $(location).attr('href',link)
            }
        }else if($('.procura2 input').val()){
            alert('Este tipo de pesquisa só em modo LOCAL.');
            $('.procura2 input[name=procura]').val('').focus();
            $('.listaCliente .tudo').hide()
        }else{
            var tags;
            var tipoBusca;
            $('input:checked').each(function(){
                if(!tags){
                    tags = $(this).attr('name');
                }else{
                    tags += ','+$(this).attr('name');
                }
                tipoBusca=$(':checked[name=tipoBusca]').val();
            })
            var buscaPor=$('.procura2 input').val();
            link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'&buscaPor='+buscaPor+'';
            $('.tituloProd').text('Aguarde...')
            $(location).attr('href',link)
        }
    })
    $(document).keydown(function(e){
        if(e.keyCode==13){
            $('.procura2 img').trigger('click')
        }
    })
    $('.tipoBusca input').click(function(){
        var tags;
        tipoBusca=$(this).val();
        $('input:checked').each(function(){
            if(!tags){
                tags = $(this).attr('name');
            }else{
                tags += ','+$(this).attr('name');
            }
            tipoBusca=$(':checked[name=tipoBusca]').val();
        })

        if(tipoBusca=='local'){
            $('.tudo, .paginacao').hide()                
        }else if(tipoBusca=='servidor'){
            pagAtual='';
            link='../web/index.php?pagina=cliente&act=list&seleciona=1&pagAtual='+pagAtual+'&tags='+tags+'&tipoBusca='+tipoBusca+'';
            $('.tudo').hide()
            $('.tituloProd').text('Aguarde...')
            $(location).attr('href',link)
        }
    })
})