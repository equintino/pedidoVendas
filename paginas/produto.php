<meta charset="utf-8" >
<?php
    @$excl=$_GET['excl'];
    if($excl==1){
        print_r($_GET);die;
    }
    if(array_key_exists('act', $_GET)){
        $act=$_GET['act'];
    }else{
       $act=null;
    }
    
    $produtos=new ProdutosCadastroJsonClient();
    //print_r($produtos);die;
    if(!isset($quant))
        $quant=0;
    
    if(@$_GET['gravado']){
        Flash::addFlash('Registro salvo com sucesso.');
    }
    
////////// Produtos ////////////
   if($act=='list'){
    //// Listar Produtos ////
    
    
   }elseif($act=='excl'){
    //// Excluir Cliente ////
    $clientes_cadastro_chave=array("codigo_cliente_omie"=>$_GET['codigo'],"codigo_cliente_integracao"=>"");
    $cliente->ExcluirCliente($clientes_cadastro_chave);
    header('Location:index.php?pagina=cliente&act=list');
   }
    
////////// Produtos ////////////  




    //print_r($dados);
    //die;
    
    /*
    $url = 'http://app.omie.com.br/api/v1/produtos/pedido/?JSON={%22call%22:%22ConsultarPedido%22,%22app_key%22:%221560731700%22,%22app_secret%22:%22226dcf372489bb45ceede61bfd98f0f1%22,%22param%22:[{%22codigo_pedido%22:25953530}]}';//'http://app.omie.com.br/api/v1/geral/clientes/?WSDL';
    $obj = json_decode(file_get_contents($url), true);
    echo '<pre>';
    print_r($obj);die;*/
?>
