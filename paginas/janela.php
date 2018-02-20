<html>
    <head>
        <title>Janela modal</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
	<script type="text/javascript">
            $(document).ready(function(){
		$("a[rel=modal]").click( function(ev){
                    ev.preventDefault();
                    //alterado
                    var id = '.window';
                    var alturaTela = $(document).height();
                    var larguraTela = $(window).width();
                    //colocando o fundo preto
                    $('#mascara').css({'width':larguraTela,'height':alturaTela});
                    $('#mascara').fadeIn(1000);	
                    $('#mascara').fadeTo("slow",0.8);
                    //var left = ($(window).width() /2) - ( $(id).width() / 1 );
                    //var top = ($(window).height() / 2) - ( $(id).height() / 1 );
					
                    $(id).css({
                        top: '50px',
                        left:'80px'
                        //margin: auto;
                    });			
                    //inserido 
                    href = $(this).attr("href");
                    $('.window').load(href);
                    $(id).show();	
 		});              
                $('.novo input').click(function(){
                    //alert($(this).attr('name'));
                    if($(this).attr('name')=='cProduto'){
                        $("a[rel=modal]").trigger("click")
                    }
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
            });
	</script>
        <style type="text/css">
            .window{
		display:none;
		width:80%;
		height:600px;
		position:absolute;
		left:0;
		top:0;
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
            }
            .fechar{
                display:block; 
                text-align:right;
            }
            a{
                /*display: none;*/
            }
	</style>
    </head>
    <body>
	<a href="../paginas/formItem.php" rel="modal">
        </a>
	<div class="window" id="janela1">Aguarde...</div>
	<!-- mascara para cobrir o site -->	
	<div id="mascara"></div>
    </body>
</html> 
