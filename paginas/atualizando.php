<html>
<head>
    <script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            if(codTabela=='nenhum'){
                $(location).attr('href',''+pagina+'.php?act='+act+'&seleciona=2');
                die;
            }else if(codTabela=='acertaTabela'){
                $(location).attr('href',''+pagina+'.php?seleciona=2&acertaTabela=1');
                die;
            }
            $(location).attr('href','../web/index.php?pagina='+pagina+'&act='+act+'&seleciona=2&codTabela='+codTabela+'');
        });
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
        background: url('http://i.imgur.com/SpJvla7.gif') no-repeat 0 50%; 
        line-height: 30px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        z-index: 9999;
        padding-left: 27px;
    }
</style>
</head>
<body>
    <?php $tabelaAtualizando? $tabelaAtualizando=$tabelaAtualizando: $tabelaAtualizando='aguarde..'; ?>
    <div id="aguarde">Atualizando Tabela de <?= $tabelaAtualizando ?>.<div id="cont"></div></div> 
</body>
</html>