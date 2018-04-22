<html>
<head>
<title>Busca de Produtos</title>
<script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
	$("a[rel=modal]").click( function(ev){
            ev.preventDefault();
            var id = '.window';
            var alturaTela = $(document).height();
            var larguraTela = $(window).width();
            //colocando o fundo preto
            $('#mascara').css({'width':larguraTela,'height':alturaTela});
            $('#mascara').fadeIn(1000);	
            //$('#mascara').fadeTo("slow",0.8);
            //var left = ($(window).width() / 8);// - ( $(id).width() / 1 );
            var top = ($(window).height() / 16);// - ( $(id).height() / 1 );
            //var meio=$(document).width()/2;
            //alert([left,top]);
            //alert($(document).width(meio));
            $(id).css({
                top: top,
                left: '50px',
                margin: 'auto',
                width: '1010px',
                //border: 'solid blue'
            });			
            //inserido 
            href = $(this).attr("href");
            $('.window').load(href);
            $(id).show()
        });              
        $('#pnl1 table').on('click',function(){
            $('#pnl1 table tr').click('each',function(){
                    linha=$(this).attr('id');
                    $('#'+linha+' input').each(function(){
                        var str=$(this).attr('name');
                        if(str.substr(0,str.length-1)=='codigo_produto'){
                            codigo_produto=$(this).val().replace(/^\s+|\s+$/g,"");
                        }
                    })
            })
            $('#pnl1 table tr .lupa img').click(function(){
                var pagAtual;
                //$('.tudo').hide();
                //$('.tituloProd').text('Aguarde...');
                /*if(!pagAtual){
                    var pagAtual=1;
                }*/
                link='../paginas/formItem.php?codigo_produto='+codigo_produto+'&pagAtual='+pagAtual+'';
                $('a[rel=modal]').attr('href',link);
                $("a[rel=modal]").trigger("click")
            })
        })
        $("#mascara").click( function(){
            $(this).hide();
            $(".window").hide();
        });
        $('.fechar').click(function(ev){
            ev.preventDefault();
            $("#mascara").hide();
            $(".window").hide();
        });
        $('.vendedor img').click(function(){
            alert('Será necessário resetar o formulário.');
            $(location).attr('href','index.php?pagina=pedido&act=cad&vendedorAtualiza=1')
        })     
                
        /// janema modal 2 ///
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
        $('#mask2').css({'width':maskWidth,'height':maskHeight});

        $('#mask2').fadeIn(1000);	
        $('#mask2').fadeTo("slow",0.8);

        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        $('#dialog2').css('top',  winH/2-$('#dialog2').height()/2);
        $('#dialog2').css('left', winW/2-$('#dialog2').width()/2);

        $('#dialog2').fadeIn(2000); 
	
	$('.window2 .close2').click(function (e) {
		e.preventDefault();
		
		$('#mask2').hide();
		$('.window2').hide();
	});		
	
	$('#mask2').click(function () {
		$(this).hide();
		$('.window2').hide();
	});
        
        
                
                
                
            });
	</script>
        <style type="text/css">
            .window{
		display:none;
		width:90%;
		height:620px;
		position:absolute;
		left:0;
                //overflow: scroll;
		//top:0;
                //margin: auto;
		background:#FFF;
		z-index:9900;
		padding:10px;
		border-radius:10px;
            }
            #mascara{
		position:absolute;
  		left:0;
  		top:0;
  		z-index:9000;
  		background-color:#000;
  		display:none;
                //border: solid yellow;
            }
            .fechar{
                display:block; 
                text-align:right;
            }
            a{
                /*display: none;*/
            }
            
    #mask2 {
        position:absolute;
        left:0;
        top:0;
        z-index:9990;
        background-color:transparent;
        display:none;
    }
    #boxes .window2 {
        position:absolute;
        left:200;
        top:200;
        width:440px;
        height:200px;
        display:none;
        z-index:9999;
        padding:20px;
    }
    #boxes #dialog2 {
        background: transparent; 
        //width:650px;
        //margin:0 auto;
        //margin-top:-160px;
    }
    .close{
        display:block; 
        text-align:right;
    }
	</style>
    </head>
    <body>
	<a href='#' rel="modal"></a>
	<div class="window" id="janela1">Aguarde...</div>
	<!-- mascara para cobrir o site -->	
	<div id="mascara"></div>
    </body>
</html>