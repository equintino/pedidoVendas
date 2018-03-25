<html>
<head>
<script>
    $(document).ready(function() {
        $('.btn-theme').click(function(){
            //$('#aguarde, #blanket').css('display','none');
        });
    });
    function carregando(){
        document.getElementById('blanket').style.display = 'block';document.getElementById('aguarde').style.display = 'block';
    }
</script>
<style>
    #blanket,#aguarde {
    position: fixed;
    }
    #blanket {
        left: 0;
        top: 0;
        background-color: #f0f0f0;
        filter: alpha(opacity =         65);
        height: 100%;
        width: 100%;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
        opacity: 0.65;
        z-index: 9998;
    }
    #aguarde {
        width: auto;
        height: 30px;
        top: 40%;
        left: 45%;
        background: url('http://i.imgur.com/SpJvla7.gif') no-repeat 0 50%; // o gif que desejar, eu geralmente uso um 20x20
        line-height: 30px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        z-index: 9999;
        padding-left: 27px;
    }
</style>
<?php
    function redirecionar($tempo,$url, $mensagem){
        header("Refresh: $tempo; url=$url"); 
    }
    redirecionar('5','../web/index.php?pagina=cliente&act=atualiza&seleciona=1','mensagem a mostrar');
    
?>
</head>
<body onload="carregando()">
    <div id="blanket"></div>
    <div id="aguarde">Aguarde... <br>Atualizando Tabela de Clientes.</div> 
</body>
</html>