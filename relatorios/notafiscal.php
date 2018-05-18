<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php 
            include '../model/NFConsultarJsonClient.php';
            include 'relatorio.php';
            include '../model/modelNota.php';
            include '../dao/NotaSearchCriteria.php';
        ?>
    </head>
    <body>
        <?php
            $notaOmie=new NFConsultarJsonClient();
            $regPagina=1;
            $nfListarRequest=array("pagina"=>1,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
            $dados=$notaOmie->ListarNF($nfListarRequest);
            
            
            if(file_exists('../dao/CRUDNota.php')){
            }
           
            gravaDados($dados,0);
            $tPaginas=$dados->total_de_paginas;
            for($x=2;$x<=$tPaginas;$x++){
                $nfListarRequest=array("pagina"=>$x,"registros_por_pagina"=>$regPagina,"apenas_importado_api"=>"N","ordenar_por"=>"CODIGO");
                $dados=$notaOmie->ListarNF($nfListarRequest);
                gravaDados($dados,1);
            }
            function gravaDados($dados,$cont=null){
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
                                 $campos[]=trim($key);
                                 foreach($item as $key2 => $item2){
                                     $campos[]=trim($key2);
                                     foreach($item2 as $key3 => $item3){
                                         $campos[]=trim($key3);
                                     }
                                 }
                             }
                        }
                        if(!file_exists('../dao/CRUDNota.php')){
                            include '../paginas/criaClasses5.php';
                            $arquivos=new criaClsses5();
                            $campos=array_unique($campos);
                            $arquivos->novoArquivo($campos);
                        }
                        include '../dao/CRUDNota.php';
                        include '../mapping/notaMapper.php';
                        $dao2=new CRUDNota();
                    }
                    $cont++;
                    foreach($item_ as $key => $item){
                        if($key!='det' && $key!='titulos' && $key!='total'){
                            foreach($item as $key2 => $item2){
                                $classe='set'.$key2;
                                $nota->$classe($item2);
                            }
                        }elseif($key=='det'){
                            for($x=0;$x<count($item);$x++){
                                foreach($item[$x] as $key2 => $item2){
                                    foreach($item[$x]->$key2 as $key3 => $item3){
                                        if($x==0){
                                            $$key3=null;
                                        }
                                        $$key3 .=$item3.'*/*';
                                    }
                                }
                            }
                            foreach($item[0] as $key2 => $item2){
                                foreach($item[0]->$key2 as $key3 => $item3){
                                    $classe='set'.$key3;
                                    $nota->$classe($$key3);
                                }
                            }           
                        }elseif($key=='titulos'){
                            for($x=0;$x<count($item);$x++){
                                foreach($item[$x] as $key2 => $item2){
                                    if($x==0){
                                        $$key2=null;
                                    }
                                    $$key2 .=$item2.'*/*';
                                }
                            }
                                if(isset($item[0])){
                                    foreach($item[0] as $key2 => $item2){
                                        $classe='set'.$key2;
                                        $nota->$classe($$key2);
                                    }
                                }

                        }elseif($key=='total'){
                            foreach($item as $key2 => $item2){
                                foreach($item->$key2 as $key3 => $item3){
                                    $classe='set'.trim($key3);
                                    $nota->$classe($item3);
                                }
                            }
                        }
                    }
                    //include '../dao/CRUDNota.php';
                    $search=new NotaSearchCriteria();
                    $search->settabela('tb_nf');
                    $search->setnNF($nota->getnNF());
                    if(OMIE_APP_KEY=='2769656370'){
                        $db='db';
                    }elseif(OMIE_APP_KEY=='461893204773'){
                        $db='db2';
                    }else{
                        $db='db3';
                    }
                    if($dao2->showTabela('tb_nf',$db)){
                        if(!$dao2->encontrePorNota($search)){
                            $dao2->grava7($nota);
                        }
                    }else{
                        $dao2->grava7($nota);
                    }
                }
            }
        ?>
    </body>
</html>
