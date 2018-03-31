<script type="text/javascript" src="../web/js/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){        
        $(location).attr('href','../web/index.php?pagina=pedido&act=cad&codigo_cliente='+codigo_cliente+'&razao='+razao+'&cnpj_cpf='+cnpj_cpf+'&contato='+contato+'&email='+email+'&endereco='+endereco+'&endereco_numero='+numero+'&bairro='+bairro+'&cep='+cep+'&cidade='+cidade+'')
    })
</script>
<?php
    echo '<script>
        var codigo_cliente="'.$_GET['codigo_cliente'].'";
        var razao="'.$_GET['razao'].'";
        var cnpj_cpf="'.$_GET['cnpj_cpf'].'";
        var contato="'.$_GET['contato'].'";
        var email="'.$_GET['email'].'";
        var endereco="'.$_GET['endereco'].'";
        var endereco_numero="'.$_GET['endereco_numero'].'";
        var bairro="'.$_GET['bairro'].'";
        var cep="'.$_GET['cep'].'";
        var cidade="'.$_GET['cidade'].'";
    </script>';
    
    function execInBackground($cmd){
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd, "r"));
        }else{
            exec($cmd . " > /dev/null &");
        }
    }
    
    execInBackground('php -f ../paginas/segundoPlanoCliente.php >> ../paginas/segundoPlanoIndex.txt &');
?>