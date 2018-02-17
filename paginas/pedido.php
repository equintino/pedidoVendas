<meta charset="utf-8" >
<?php
    include '../paginas/janela.php';

    @$excl=$_GET['excl'];
    if(array_key_exists('razao', $_GET)){
        $razao=$_GET['razao'];
    }else{
        $razao=null;
    }
    if(array_key_exists('codigo', $_GET)){
        $codigo_cliente=$_GET['codigo'];
    }else{
        $produto_cliente=null;
    }
    if(array_key_exists('cnpj_cpf', $_GET)){
        $cnpj_cpf=$_GET['cnpj_cpf'];
    }else{
        $cnpj_cpf=null;
    }
    if(array_key_exists('contato', $_GET)){
        $contato=$_GET['contato'];
    }else{
        $contato=null;
    }
    if($excl==1){
        print_r($_GET);die;
    }
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    
    $pedido=new PedidoVendaProdutoJsonClient();
    $cliente=new ClientesCadastroJsonClient();
    if(!isset($quant))
        $quant=0;
    
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
////////// Produtos ////////////
   if($act=='excl'){
    $produto_servico_cadastro_chave = array("codigo_produto" => $_GET['codigo'], "codigo_cliente_integracao" => "", "codigo" => "");
    $produtos->ExcluirProduto($produto_servico_cadastro_chave);
    header('Location:index.php?pagina=produto&act=list');
   }
?>
