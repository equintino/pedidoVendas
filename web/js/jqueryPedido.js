$(document).ready(function(){
    if(enviado){
        alert('Pedido de Venda Enviado.');
    }
    $('.botao input').mouseover(function(){
        $(this).css('cursor','pointer');
    });

    $('#botoes .bnt,.outrosItens span').mouseover(function(){
        $(this).css('cursor','pointer');
    });
    var item=1;
    var conf=null;
    var conf2=null;
    $('#botoes .bnt').click(function(){
        if(!$('.razao input').val()){
            alert('Preenche campo "CLIENTE"');
            $('.razao input').focus();
            return false;
        }else if(!$('.cnpj input').val()){
            alert('Preenche campo "CNPJ/CPF"');
            $('.cnpj input').focus();
            return false;
        }            
        if($(this).text()=='Novo Ítem'){
            if(!$('#pnl1 table input[name=codigo_produto'+item+']').val()){
                $('#pnl1 table input[name=codigo_produto'+item+']').css('background','rgba(216, 0, 0,0.1)').focus();
                busca();
                $('#pnl1 table tr .lupa img[busca='+item+']').trigger('click');
                die;
            }
            item++;
               $('#pnl1 table').append('<tr id=item'+item+'><span class=novo><td class="lupa" ></td><td class=item>'+item+'</td><td><input type="text" size=10px name="codigo_produto'+item+'" autocomplete="off" linha='+item+' required/></td><td><input type="text" name="descricao'+item+'" autocomplete="off" required /></td><td><input type="text" size=2px name="quantidade'+item+'" autocomplete="off" required linha='+item+' /></td><td><input type="text" size=8px name="vUnitarioItem'+item+'" autocomplete="off" required /></td><td><input type="text" size=8px name="vTotalItem'+item+'" linha='+item+' disabled /></td><td><input type="text" size=2px name="pDescontoItem'+item+'" autocomplete="off" linha='+item+' /></td><td><textarea cols=25 rows=1 name="obs_item'+item+'" linha='+item+' /></textares></td><td><input type="hidden" name="cfop'+item+'" linha='+item+' /></td><td><input type="hidden" name="ncm'+item+'" linha='+item+' /></td><td><input type="hidden" name="ean'+item+'" linha='+item+' /></td><td><input type="hidden" name="unidade'+item+'" linha='+item+' /></td><td><input type="hidden" name="vTotalItem'+item+'" linha='+item+' /></td><td><input type="hidden" name="pTabela'+item+'" linha=1 /></td><input type=hidden name="cOmie'+item+'" /></span></tr>');
                itemExclusao();
                busca();
                $('#pnl1 table input[name=codigo_produto'+item+']').trigger('focus');
        }else if($(this).text()=='Excluir Ítem'){
            if($('#pnl1 table input').val()){
                alert('Clique no Nº do Ítem para excluir.');
                if(!conf){
                    itemExclusao();
                }
            }
        }
    });
    busca();
    $('.outrosItens span').click(function(){
        $(this).css({
            position: 'relative',
            top: '1px',
            boxShadow: 'none',
            background: '#b1aea1',
            color: 'white',
            textShadow: '2px 2px 2px black'
        });
        var bntAtual=$(this).attr('class');
        $('.outrosItens span').each(function(){
            if(!$(this).hasClass(bntAtual)){
                $(this).css({
                    position: 'relative',
                    top: '-1px',
                    background: '#d4d2c1',
                    boxShadow: '0 2px 0 gray',
                    textShadow: '2px 2px 2px white',
                    color: 'black'
                });
            }
        });
        $('#pnl1, #pnl2, #pnl3, #pnl4, #pnl5, #pnl6').css('display','none');
        if($(this).text() === 'Itens de Venda'){
            $('#pnl1').css('display','block');
        }else if($(this).text() === 'Frete/Despesas'){
            $('#pnl2').css('display','block');
        }else if($(this).text() === 'Informações Adcionais'){
            $('#pnl3').css('display','block');
        }else if($(this).text() === 'Parcelas'){
            $('#pnl4').css('display','block');
            $('.tabela select[name=parcela]').removeAttr('disabled');
        }else if($(this).text() === 'E-mail para Cliente'){
            $('#pnl5').css('display','block');
        }
    });
    $('table.tabela .razao img').click(function(){
        if($('div#pnl1 input').val()){
            var resp=confirm('Você já adcionou itens a este pedido, estes dados serão descartados. Deseja continuar?');
            if(resp){
                $(location).attr('href','index.php?pagina=cliente&act=list&seleciona=1&tags=undefined');
            }else{
                return false;
            }
        }else{
            $(location).attr('href','index.php?pagina=cliente&act=list&seleciona=1&tags=undefined');
        }
    })
    $(document).keydown(function(e){
        if(e.which==113){
            if($('form').hasClass('#pnl1') || $('#pnl1 input').val()){
                var resp=confirm('Você já adcionou itens a este pedido, estes dados serão descartados. Deseja continuar?');
                if(resp){
                    $(location).attr('href','index.php?pagina=cliente&act=list&seleciona=1&tags=undefined');
                }else{
                    return false;
                }
            }else{
                $(location).attr('href','index.php?pagina=cliente&act=list&seleciona=1&tags=undefined');
            }
        }else if(e.which==112 || e.which==114 || e.which==116 || e.which==123){
            return false;
        }else if(e.which==115){
            $('.bnt').each(function(){
                if($(this).text()=='Novo Ítem'){
                    $(this).trigger('click');
                }
            })
        }else if(e.which==27){
            $("#mascara").hide();
            $(".window").hide();
        }else if(e.which==119){
            $('.procura img').trigger('click');
            return false;
        }
    });
    $('.tabela td select[name=parcela]').change(function(){
        $('.outrosItens span').each(function(){
            if($(this).text()=='Parcelas'){
                $(this).trigger('click');
            }
        });
        var numParc=$('.tabela select[name=parcela] :selected').val();
        var formPag=$('.tabela td select[name=fPagamento] :selected').val();
        if(formPag=='debito' || formPag=='dinheiro'){
            if(numParc != 'A Vista,000,0'){
                $('.tabela select[name=parcela] option').each(function(){
                    $(this).removeAttr('selected');
                    if($(this).val()=='A Vista,000,0'){
                        $(this).attr('selected','selected');
                    }
                });    
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                $('#pnl4 .novo4 input[name=numero_parcela1]').val(0);
                $('#pnl4 .novo4 input[name=data_vencimento1]').val($('.previsao input[name=dPrevisao]:hidden').val());
                $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }
        }else if(formPag=='credito'){
            if(numParc=='A Vista,000,0' || numParc==''){
                $('.tabela select[name=parcela] option').each(function(){
                    $(this).removeAttr('selected');
                    if($(this).val()=='1 Parcela,001,1'){
                        $(this).attr('selected','selected');
                    }
                });
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                $('#pnl4 .novo4 input[name=numero_parcela1]').val(1);
                $('#pnl4 .novo4 input[name=data_vencimento1]').val(data(1));
                $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }else{
                var selecao=$(this).val().substr(0,2);
                if(selecao=='1 '){
                    $('#pnl4 .novo4').each(function(){
                        if($(this).attr('linha')>1){
                            $(this).remove();
                        }
                    });
                    $('#pnl4 .novo4 input[name=numero_parcela1]').val(1);
                    $('#pnl4 .novo4 input[name=data_vencimento1]').val(data(1));
                    $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                    $('#pnl4 .novo4 input[name=percentual1]').val(100);
                }else{
                    $('#pnl4 .novo4').each(function(){
                        if($(this).attr('linha')>1){
                            $(this).remove();
                        }
                    });
                    var percent=100/selecao;
                    for(var x=1;x<parseInt(selecao)+1;x++){
                        if(x!=1){
                            $('#pnl4 table').append($('<tr linha='+x+' class=novo4><td><input size=1px type=text name=numero_parcela'+x+' /></td><td><input size=10px type=text name=data_vencimento'+x+' /></td><td><input size=10px type=text name=valor'+x+' /></td><td><input size=10px type=text name=percentual'+x+' /></td>'));
                        }
                        $('#pnl4 .novo4 input[name=numero_parcela'+x+']').val(x);
                        $('#pnl4 .novo4 input[name=data_vencimento'+x+']').val(data(x));
                        $('#pnl4 .novo4 input[name=valor'+x+']').val(calcula('/',$('.autoQuadro td[nome=vPedido]').text(),selecao));
                        $('#pnl4 .novo4 input[name=percentual'+x+']').val(percent);
                    }
                }
            }
        }else{
            var selecao=$(this).val().substr(0,2);
            if(selecao=='A '){
                $('.tabela select[name=parcela] option').each(function(){
                        $(this).removeAttr('selected');
                        if($(this).val()=='1 Parcela,001,1'){
                            $(this).attr('selected','selected');
                        }
                    });
                    $('#pnl4 .novo4').each(function(){
                        if($(this).attr('linha')>1){
                            $(this).remove();
                        }
                    });
                    $('#pnl4 .novo4 input[name=numero_parcela1]').val(1);
                    $('#pnl4 .novo4 input[name=data_vencimento1]').val(data(1));
                    $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                    $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }else if(selecao=='1 '){
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                $('#pnl4 .novo4 input[name=numero_parcela1]').val(1);
                $('#pnl4 .novo4 input[name=data_vencimento1]').val(data(1));
                $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }else{
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                var percent=100/selecao;
                for(var x=1;x<parseInt(selecao)+1;x++){
                    if(x!=1){
                        $('#pnl4 table').append($('<tr linha='+x+' class=novo4><td><input size=1px type=text name=numero_parcela'+x+' /></td><td><input size=10px type=text name=data_vencimento'+x+' /></td><td><input size=10px type=text name=valor'+x+' /></td><td><input size=10px type=text name=percentual'+x+' /></td>'));
                    };
                    $('#pnl4 .novo4 input[name=numero_parcela'+x+']').val(x);
                    $('#pnl4 .novo4 input[name=data_vencimento'+x+']').val(data(x));
                    $('#pnl4 .novo4 input[name=valor'+x+']').val(calcula('/',$('.autoQuadro td[nome=vPedido]').text(),selecao));
                    $('#pnl4 .novo4 input[name=percentual'+x+']').val(percent);
                }
            }
            alert('Defina a forma de pagamento.');
            $('.tabela td select[name=fPagamento]').css('background','rgba(216, 0, 0,0.1)').focus();
        }
    });
    $('#dados').on("submit", function(event){
        var vendedor=$('.tabela .vendedor :selected').text();
        $('.vendedor input[name=vendedor]').val(vendedor);
        var numParc=$('.tabela select[name=parcela] :selected').val();
        var formPag=$('.tabela td select[name=fPagamento] :selected').val();

        if(formPag=='credito' || formPag == 'debito'){
            if($('#pnl3 tr.dados_adcionais_nf td textarea').val()==''){
                var dados=confirm('Não foi inserido o número do documento referente ao cartão. Deseja continuar assim mesmo?');
                if(!dados){
                    $('.doc input').css('background','rgba(216, 0, 0,0.1)').focus();
                    return false;
                }
            }
        }
        var campo=0;
        $('#pnl1 textarea').each(function(event){
            campo++;
            perg=null;
            if(!$(this).val()||$(this).val()==' '){
                var linha=$(this).attr('linha');
                var codProd=$('#pnl1 input[name=codigo_produto'+linha+']').val();
                perg=confirm('Não foi inserido o serial para o ítem '+codProd+'. Deseja continuar assim mesmo?');
                if(!perg){
                    $('.outrosItens span').each(function(){
                        if($(this).text()=='Itens de Venda'){
                            $(this).trigger('click');
                        }
                    });
                    $(this).css('background','rgba(216, 0, 0,0.1)').focus();
                    return false;
                }
            }else{
                if(item==campo){
                    perg=true;
                    return false;
                }
            }
        });
        if(perg){
            $('.tabela select[name=parcela]').removeAttr('disabled');
            if(formPag=='dinheiro' || formPag=='debito'){
                if(numParc != 'A Vista,000,0'){
                    alert('A forma de pagamento não condiz com parcelas.');
                    $('.outrosItens span').each(function(){
                        if($(this).text()=='Parcelas'){
                            $(this).trigger('click');
                        }
                    });
                    $(this).focus();
                    return false;
                }
            }else if(formPag=='credito'){
                if(numParc == 'A Vista,000,0' || numParc ==''){
                    alert('A forma de pagamento não condiz com parcelas.');
                    return false;
                }
            }
            $(location).attr('href','index.php?pagina=pedido&act=cad&enviado=1');
        }else{
            return false;
        }
    });
    $('.tabela td select[name=fPagamento]').change(function(){
        var formPag=$('.tabela td select[name=fPagamento] :selected').val();
        if(formPag == 'credito' || formPag == 'debito'){
            $('.doc').show();
            $('.doc').keyup(function(){
                var doc=$('.doc input').val();
                $('#pnl3 tr.dados_adcionais_nf td textarea').val(doc);
            });
        }else if(formPag == 'dinheiro' || formPag == ''){
            $('.doc').hide();
            $('.doc input').val('');
            $('#pnl3 tr.dados_adcionais_nf td textarea').val('');
        }
        if(formPag == 'debito' || formPag == 'dinheiro'){
            if($('.tabela select[name=parcela] :selected').val() != 'A Vista,000,0'){
                $('.tabela select[name=parcela] option').each(function(){
                    if($(this).val()=='A Vista,000,0'){
                        $(this).attr('selected','selected');
                    }
                });
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                $('#pnl4 .novo4 input[name=numero_parcela1]').val(0);
                $('#pnl4 .novo4 input[name=data_vencimento1]').val($('.previsao input[name=dPrevisao]:hidden').val());
                $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }
        }else if(formPag == 'credito'){
            numParc=$('.tabela select[name=parcela] :selected').val();
            if(numParc == 'A Vista,000,0' || numParc == ''){
                $('.tabela select[name=parcela] option').each(function(){
                    $(this).removeAttr('selected');
                    if($(this).val()=='1 Parcela,001,1'){
                        $(this).attr('selected','selected');
                    }
                });
                $('#pnl4 .novo4').each(function(){
                    if($(this).attr('linha')>1){
                        $(this).remove();
                    }
                });
                $('#pnl4 .novo4 input[name=numero_parcela1]').val(1);
                $('#pnl4 .novo4 input[name=data_vencimento1]').val(data(1));
                $('#pnl4 .novo4 input[name=valor1]').val($('.autoQuadro td[nome=vPedido]').text());
                $('#pnl4 .novo4 input[name=percentual1]').val(100);
            }
        }
    });
    $('.pagina').text('PRÉ-VENDA');
    $('#novoPedido').click(function(){
        if(!confirm('O formulário será limpo.')){
            return false;
        }
    });
    var codigo_categoria=$('.novo3 :selected').attr('codigo_categoria');
    $('.novo3 :hidden[name=codigo_categoria]').val(codigo_categoria);
    $('.novo3 :disabled[name=codigo_categoria]').val(codigo_categoria);
    $('.novo3 select[name=codigo_conta_corrente]').change(function(){
        var selecao=$(this).val();
        $('.novo3 select[name=codigo_conta_corrente] option').each(function(){
            if($(this).val()==selecao){
                var codigo_categoria=$(this).attr('codigo_categoria');
                $('.novo3 :hidden[name=codigo_categoria]').val(codigo_categoria);
                $('.novo3 :disabled[name=codigo_categoria]').val(codigo_categoria);
            }
        });
    });
    if(funcao=='administrador'){
        $('.mGeral').append($('<ul><li class=tabela>ATUALIZA TABELA CLIENTE</li></ul>'));
        $('.mGeral ul li.tabela').click(function(){
            var tab=$('.mGeral ul li.tabela').text().split(' ').slice('2');
            if(tab=='CLIENTE'){
                window.location.assign('index.php?pagina=cliente&act=atualiza&seleciona=0');
            }else if(tab=='PRODUTO'){
                window.location.assign('index.php?pagina=produto&act=atualiza&seleciona=0');
            }else if(tab=='PREÇO'){
                window.location.assign('index.php?pagina=produto&act=atualizaTabela&seleciona=0');
            }
        });
        $('.vaivem').append($('<img title="Trocar tabela" src="../web/img/vaivem.png" height=20px/>'));
        var s=0;
        $('.vaivem img').click(function(){
            if(s==2){
                s=0; 
            }else{
                s++;
            }
            switch(s){
                case 0:
                    $('.mGeral ul li.tabela').text('ATUALIZA TABELA CLIENTE');
                    break;
                case 1:
                    $('.mGeral ul li.tabela').text('ATUALIZA TABELA PRODUTO');
                    break;
                case 2:
                    $('.mGeral ul li.tabela').text('ATUALIZA TABELA PREÇO');
                    break;
            }
        });
        $('.opcaoTransp button').click(function(){
            var transpSelecionada=$('.opcaoTransp :selected').val();
            window.location.assign('index.php?pagina=pedido&act=cad&transpSelecionada='+transpSelecionada+'');
        });
        $('.novo3 img').click(function(){
            window.location.assign('index.php?pagina=pedido&act=cad&contaAtualiza=1');
        });
    }
    ///// funcoes ////
    function itemExclusao(){
        var corItem='rgba(255,0,0,0.7)';
        $('#pnl1 table .item').wrap('<span></span>');
        $('#pnl1 table span').css({
                background: corItem,
                borderRadius: '10px',
                boxShadow: '2px 2px 2px gray',
                color: 'white',
                textShadow: '1px 1px 1px black',
                fontWeight: '700'
        }).mouseover(function(){
            $(this).css({
                cursor: 'pointer',
                background: '#ccc'
            });
            $(this).mouseleave(function(){
                $(this).css({
                    background: corItem                                
                });
            });
            $(this).mousedown(function(){
                $(this).css({
                    position: 'relative',
                    top: '2px',
                    boxShadow: 'none'
                }).bind('mouseout mouseup', function(){
                    $(this).css({
                        position: 'relative',
                        top: '-1px',
                        boxShadow: '2px 2px 2px gray'
                    });
                }).mouseup(function(){
                    if(!conf2 && $('#pnl1 table span').length != 1 && $('#pnl1 table input').val().length != 0){
                        if(confirm('Confirma a exclusão do ítem '+$(this).text()+'?')){
                            $('#item'+$(this).text()).remove();
                            $('.autoQuadro td').each(function(){
                                if($(this).attr('nome')=='tItem'){
                                    $(this).text(item-1);  
                                }
                            });
                            var z=1;
                            var w=0;
                            $('#pnl1 table .item').each(function(){
                                $(this).text(z)
                                z++;
                            });
                            $('#pnl1 table tr').each(function(){
                               $(this).attr('id','item'+w)
                               w++;
                            });
                            var z=1;
                            var verifica=($('#pnl1 input').attr('name').substr(-1,1));
                            $('#pnl1 input[name]').each(function(){
                                nome=$(this).attr('name');
                                if(nome.substr(-1,1)==verifica){
                                    nome_=nome.substr(0,nome.length-1)+z;
                                    $(this).attr('name',nome_);
                                    $(this).attr('linha',z);
                                }else{
                                    verifica=nome.substr(-1,1);
                                    z++;
                                    $(this).attr('name',nome.substr(0,nome.length-1)+z);
                                    $(this).attr('linha',z);
                                }
                            });
                            z=1;
                            $('#pnl1 textarea').each(function(){
                                nome=$(this).attr('name');
                                $(this).attr('name',nome.substr(0,nome.length-1)+z);
                                z++;
                            });
                            item=$('#pnl1 table .item').length;
                            conf2=null;
                            $('#pnl1 td input[name=quantidade1]').trigger('click')
                            die;
                        }else{
                            die;
                        }
                    }else if($('#pnl1 table .item').length==1 && $('#pnl1 table input').val().length != 0){
                        if(confirm('Confirma a exclusão do ítem '+$(this).text()+'?')){
                            $('#pnl1 td input').each(function(){
                                $(this).val('')
                            });
                            die;;
                        }
                    }
                });
            });
        });
        conf=1;
    }
        /* Cria Busca */
    function busca(){ 
        $('#pnl1 input').focus(function(){
            var str=$(this).attr('name');
            if(str.substr(0,str.length-1)=='codigo_produto'){
                $('#pnl1 table .item').each(function(){
                    j=$(this).text();
                });
                $('#pnl1 table tr .lupa img').remove();
                if(!$('#pnl1 table tr .lupa img').attr('src')){
                    $('#pnl1 table tr .lupa').append('<img title="Pesquisar ítem" height=15px src="../web/img/lupa.png" busca='+j+' /> ');
                }
            }
        });
        $('#pnl1 table input[name=codigo_produto'+item+']').trigger('focus');
        $('#pnl1 table tr .lupa img[busca='+j+']').trigger('click');
        quadroInferior();
    }
        /* quadro inferior */
    function quadroInferior(){
        $('#pnl1 td input').each(function(){
            var str=$(this).attr('name');
            if(str.substr(0,str.length-1)=='quantidade'){
                $(this).mask('0000000');
                $(this).bind('keyup click', function(){
                    pedLinha=$(this).attr('linha');
                    quantidade=$(this).val();
                    vUnitarioItem=($('#pnl1 tr[id=item'+pedLinha+'] input[name=vUnitarioItem'+pedLinha+']').val());
                    vTotalItem=calcula('*',vUnitarioItem,quantidade);
                    $($('#pnl1 tr[id=item'+pedLinha+'] input[name=vTotalItem'+pedLinha+  ']')).val(numeroParaMoeda(vTotalItem));
                    qEstoque=$(this).attr('qestoque');
                    preencheTotais();
                });
            }else if(str.substr(0,str.length-1)=='pDescontoItem'){
                $(this).mask('000');
                $(this).bind('keyup click', function(){
                    if($(this).val()>100){
                        $(this).val(100);
                    }
                    preencheTotais(); 
                });
            }else if(str.substr(0,str.length-1)=='vUnitarioItem'){
                $(this).mask('#.###.###,##', {reverse: true});
                $(this).focus(function(){
                    var vlItem=$(this).attr('name');
                    var nBusca=vlItem.substr(vlItem.length-1);
                    var pTabela=$('#pnl1 td input[name=pTabela'+nBusca+']').val();
                    var pMinimo=$('#pnl1 td input[name=vUnitarioItem'+nBusca+']').val();
                    $(document).keydown(function(e){
                        if(e.keyCode==13){
                            return false;
                        }
                    });
                    $(this).blur(function(){
                        var pInserido=$(this).val();
                        var vInserido=pInserido.replace(',','.');
                        var vTabela=pTabela.replace(',','.');
                        var vMinimo=pMinimo.replace(',','.');
                        if(pTabela == 'Não Definido' && vInserido < vMinimo){
                            alert('Valor mínimo permitido '+pMinimo+'');
                            $(this).val(pMinimo);
                            $('#pnl1 td input[name=quantidade'+nBusca+']').trigger('click');
                        }else if(vInserido < vTabela && pTabela != 'Não Definido'){
                            alert('Valor mínimo permitido '+pTabela+'');
                            $(this).val(pTabela);
                            $('#pnl1 td input[name=quantidade'+nBusca+']').trigger('click');
                        }
                    });
                });
                $(this).bind('keyup click', function(){
                    var vlItem=$(this).attr('name');
                    var nBusca=vlItem.substr(vlItem.length-1);
                    $('#pnl1 td input[name=quantidade'+nBusca+']').trigger('click');
                });
            }
        });
        $('#pnl1 textarea').focus(function(){
            linhaSerial=$(this).attr('linha');
            $('#serial').show();
            $('#serial textarea').focus();
            $('#serial textarea').blur(function(){
                if($(this).val()!=''){
                    var msg=confirm('Transfere o serial para campo?');
                    if(msg){
                        $('#pnl1 textarea[linha='+linhaSerial+']').val($(this).val())
                    }
                    $(this).val('');
                }
                $('#serial').hide();
                die;
            });
            die;
        });
    }
    function preencheTotais(){/* preencher quadro com valores Totais */
            mercadoriaTotal=0;
            vDescontoTotal=0;
            var qVol=0;
            for(var h=1;h<parseInt(item)+1;h++){
                qVol +=parseInt($('#pnl1 input[name=quantidade'+h+']').val());
            }
            $('#pnl2 .novo2 input[name=qvolume]').val(qVol);
            $('.autoQuadro input[name=tItem]').val(item);
            $('.autoQuadro td[nome=tItem]').text(item)/* Rotal de Ítens */
            for(var i=1;i<item+1;i++){
                    mercadoria=$('#pnl1 tr[id=item'+i+'] input[name=vTotalItem'+i+']').val();
                if(mercadoriaTotal==0){
                    if(mercadoria.charAt(mercadoria.length-3)!='.'){
                        mercadoria=mercadoria.replace('.','');
                    }
                    if(mercadoria.charAt(mercadoria.length-3)==','){
                        mercadoria=mercadoria.replace(',','.');
                    }
                    mercadoriaTotal=mercadoria;
                }else{
                    mercadoriaTotal=calcula('+',mercadoriaTotal,mercadoria);
                }
                var temDesconto=0;
                $('#pnl1 tr input').each(function(){
                    var h=$(this).attr('name');
                    if(h.substr(0,h.length-1)=='pDescontoItem'){
                        if($(this).val()!=0)temDesconto=1;
                    }
                });
                if(temDesconto != 0){
                    mercadoria=$('#pnl1 tr[id=item'+i+'] input[name=vTotalItem'+i+']').val();
                    vDescontoItem=calcula('%',mercadoria,$('#pnl1 tr[id=item'+i+'] input[name=pDescontoItem'+i+']').val());
                    if(vDescontoItem != 'NaN'){
                        vDescontoTotal += parseFloat(vDescontoItem);
                    }
                }
            }
            if(mercadoriaTotal){
                $('.autoQuadro input[name=mercadorias]').val(numeroParaMoeda(mercadoriaTotal));
                $('.autoQuadro td[nome=mercadorias]').text(numeroParaMoeda(mercadoriaTotal)); /* mercadorias */
            }
            if(vDescontoTotal){
                $('.autoQuadro input[name=vDesconto]').val(numeroParaMoeda(vDescontoTotal));
                $('.autoQuadro td[nome=vDesconto]').text(numeroParaMoeda(vDescontoTotal)); /* Desconto */
            }else{
                $('.autoQuadro input[name=vDesconto]').val(numeroParaMoeda('0,00'));
                $('.autoQuadro td[nome=vDesconto]').text(numeroParaMoeda('0,00'));
            }
            var vPedido=calcula('-',$('.autoQuadro td[nome=mercadorias]').text(),$('.autoQuadro td[nome=vDesconto]').text());
            $('.autoQuadro input[name=vPedido]').val(numeroParaMoeda(vPedido));
            $('.autoQuadro td[nome=vPedido]').text(numeroParaMoeda(vPedido)); /* Valor do Pedido */
            var comissao=$('.vendedor :selected').attr('comissao')*vPedido/100;
            $('.valorPedido').text("Valor do Pedido R$"+numeroParaMoeda(vPedido)).show();
            $('.valorPedido').append('<div><font color="blue">Comissão R$ '+numeroParaMoeda(comissao)+'</font></div>');
    }
    $('.vendedor select').change(function(){
        var vPedido=calcula('-',$('.autoQuadro td[nome=mercadorias]').text(),$('.autoQuadro td[nome=vDesconto]').text());
        var comissao=$('.vendedor :selected').attr('comissao')*vPedido/100;
        $('.valorPedido div font').text('Comissão R$ '+numeroParaMoeda(comissao));
    });
});
function numeroParaMoeda(n, c, d, t){
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");    
}
function calcula(ope,vl1,vl2){
    if(vl1.charAt(vl1.length-3)!='.'){
        vl1=vl1.replace('.','');
    }
    if(vl2.charAt(vl2.length-3)!='.'){
        vl2=vl2.replace('.','');
    }
    if(vl1.charAt(vl1.length-3)==','){
        vl1=vl1.replace(',','.');
    }
    if(vl2.charAt(vl2.length-3)==','){
        vl2=vl2.replace(',','.');
    }
    switch(ope){
        case '+':
            result=parseFloat(vl1)+parseFloat(vl2);
            break;
        case '-':
            result=parseFloat(vl1)-parseFloat(vl2);
            break;
        case '*':
            result=parseFloat(vl1)*parseFloat(vl2);
            break;
        case '/':
            result=parseFloat(vl1)/parseFloat(vl2);
            break;
        case '%':
            result=parseFloat(vl1)*parseFloat(vl2)/100;
            break;
    }
    return result.toFixed('2');
}
function data(fator){
    var fator;
    var now=new Date();
    var numeroMes=new Array('01','02','03','04','05','06','07','08','09','10','11','12');
    m=now.getMonth()+parseInt(fator);
    if(m > '11'){
        m = m - 12;
        var a=now.getFullYear()+1;
    }else{
        a=now.getFullYear();   
    }
    return now.getDate()+'/'+numeroMes[m]+'/'+a;
}