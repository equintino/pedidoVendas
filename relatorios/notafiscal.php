<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            include 'NFConsultarJsonClient.php';
            include 'relatorio.php';
            include '../model/modelNota.php';
        ?>
    </head>
    <body>
        <?php
           $notaOmie=new NFConsultarJsonClient();
           $regPagina=1;
           $nfListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
           $dados=$notaOmie->ListarNF($nfListarRequest);
           $cont=0;
           foreach($dados->nfCadastro as $item_){
                $nota=new nota();
                if($cont==0){
                    foreach($item_ as $key => $item){
                         if($key=='compl'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='det'){
                             $campos[]=$key;
                             foreach($item[0] as $key2 => $item2){
                                 $campos[]=$key2;
                                 foreach($item2 as $key3 => $item3){
                                     $campos[]=$key3;
                                 }
                             }
                         }elseif($key=='ide'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='info'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='nfDestInt'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='nfEmitInt'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='pedido'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='titulos'){
                             $campos[]=$key;
                             foreach($item[0] as $key2 => $item2){
                                 $campos[]=$key2;
                             }
                         }elseif($key=='total'){
                             $campos[]=$key;
                             foreach($item as $key2 => $item2){
                                 $campos[]=$key2;
                                 foreach($item2 as $key3 => $item3){
                                     $campos[]=$key3;
                                 }
                             }
                         }
                    }
                    if(!file_exists('../dao/CRUDNota.php')){
                        include 'criaClasses5.php';
                        $arquivos=new criaClsses5();
                        $campos=array_unique($campos);
                        $arquivos->novoArquivo($campos);
                    }
                    include '../dao/CRUDNota.php';
                    $dao2=new CRUDNota();
                }
                $cont++;
                echo '<pre>';
                foreach($item_ as $key => $item){
                    if($key!='det' && $key!='titulos' && $key!='total'){
                        foreach($item as $key2 => $item2){
                            $classe='set'.$key2;
                            $nota->$classe($item2);
                        }
                    }elseif($key=='det'){
                        for($x=0;$x<count($item);$x++){
                            foreach($item[$x] as $key2 => $item2){
                                $classe='set'.$key2;
                                $nota->$classe($item2);
                            }
                        }
                    }
                }
                        print_r($nota);die;
                //echo '<pre>';print_r($item_);die;
                print_r($dao2->grava7($nota));die;
            }
           
           $tPaginas=$dados->total_de_paginas;
           for($x=2;$x<=$tPaginas;$x++){
               $nfListarRequest=array("pagina"=>$x,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
               $dados=$notaOmie->ListarNF($nfListarRequest);
               echo '<pre>';print_r($dados);
           }
        ?>
    </body>
</html>
