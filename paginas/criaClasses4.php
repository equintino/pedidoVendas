<?php
    class criaClsses4 {
        public $tabela='tb_pedido';
        private $filename1='../model/pedido.php';        
        private $filename2='../mapping/pedidoMapper.php';
        private $filename3='../dao/PedidoSearchCriteria.php';
        private $filename4='../dao/CRUDPedido.php';
        public function novoArquivo($variaveis){
            array_push($variaveis,"codigo_pedido","pedido","codigo_pedido_integracao","modificado","dSemana");
            $mode='w+';
            $handle = fopen($this->filename1, $mode); 
            $texto=$this->texto1($variaveis);
            fwrite($handle, $texto); 
            fclose($handle); 
            $handle = fopen($this->filename2, $mode); 
            $texto=$this->texto2($variaveis);
            fwrite($handle, $texto); 
            fclose($handle);
            $handle = fopen($this->filename3, $mode); 
            $texto=$this->texto3($variaveis);
            fwrite($handle, $texto); 
            fclose($handle);
            $handle = fopen($this->filename4, $mode); 
            $texto=$this->texto4($variaveis);
            fwrite($handle, $texto); 
            fclose($handle);
            
            return $variaveis;
        }
        private function padrao(){
            $padrao=array('id','tabela','excluido','criado');
            return $padrao;
        }
        private function texto1($variaveis){        
            $texto="<?php class pedido{";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .=" private $"."$pad; ";
                $texto .=" public function get".$pad."(){".
                        'return $this->'."$pad; }".
                        " public function set$pad(".'$'."$pad){".
                        '$this->'.$pad.'=$'."$pad; }"; 
            }
            foreach($variaveis as $key => $item){
                if($key === 'parcela' || $key === 'item'){
                    foreach($item as $item2){
                        $texto .=' private $'.$item2.';';
                        $texto .=  ' public function get'.$item2."(){".
                   'return $this->'.$item2."; }".
                   ' public function set'.$item2.'($'.$item2." ){".
                   '$this->'.$item2.'=$'.$item2."; }";
                    }
                }else{
                    $texto .=' private $'.$item.';';
                    $texto .=  ' public function get'.$item."(){".
                   'return $this->'.$item."; }".
                   ' public function set'.$item.'($'.$item." ){".
                   '$this->'.$item.'=$'.$item."; }";
                }
                
                 
            }
            $texto .=' }'; 
            return $texto;
        }
        private function texto2($variaveis){
            $texto="<?php class pedidoMapper{";
            $texto .= ' public static function map(pedido $pedido, array $properties){';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .='if (array_key_exists(\''.$pad.'\', $properties)){'.
                        '  $pedido->set'.$pad.'($properties[\''.$pad.'\']);'.
                        '}';                
            }
            foreach($variaveis as $key => $item){
                if($key==='item' || $key==='parcela'){
                    foreach($item as $item2){
                        $texto .='if (array_key_exists(\''.$item2.'\', $properties)){'.
                        '  $pedido->set'.$item2.'($properties[\''.$item2.'\']);'.
                        '}';
                    }
                }else{
                    $texto .='if (array_key_exists(\''.$item.'\', $properties)){'.
                        '  $pedido->set'.$item.'($properties[\''.$item.'\']);'.
                        '}';
                }
            }
            $texto .= '  }'." }";
            return $texto;
        }
        private function texto3($variaveis){
            $texto="<?php class PedidoSearchCriteria{";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
              $texto .= ' private $'.$pad.';'.
               'public function get'.$pad.'(){'.
                'return $this->'.$pad.';'.
              '}'.
              'public function set'.$pad.'($'.$pad.'){'.
                  '$this->'.$pad.'=$'.$pad.';'.
                  'return $this;'.
              '}';
            }
            foreach($variaveis as $key => $item){
                if($key==='item' || $key==='parcela'){
                    foreach($item as $item2){
                       $texto .= ' private $'.$item2.';'.
                    'public function get'.$item2.'(){'.
                     'return $this->'.$item2.';'.
                   ' }'.
                   'public function set'.$item2.'($'.$item2.'){'.
                       '$this->'.$item2.' = $'.$item2.';'.
                       'return $this;'.
                   '}';
                    }
                }else{
                    $texto .= ' private $'.$item.';'.
                    'public function get'.$item.'(){'.
                     'return $this->'.$item.';'.
                   '}'.
                   'public function set'.$item.'($'.$item.'){'.
                       '$this->'.$item.' = $'.$item.';'.
                       'return $this;'.
                   '}';
                }
            }
            $texto .= '}';
            return $texto;
        }
        private function texto4($variaveis){
            $texto="<?php class CRUDPedido extends Dao{";
            $texto .= ' public function insert6(pedido $pedido){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$pedido->setid(null);'.
                '$pedido->setexcluido(0);'.
                '$pedido->setcriado($now);'.
                '$sql=$this->criaTabela6(\''.$this->tabela.'\');'.
                '$this->execute6($sql, $pedido);'.
                //'$this->execute6(\'ALTER TABLE `tb_pedido` ADD UNIQUE(`codigo_pedido_integracao`)\', $pedido);'.
                '$sql = \'INSERT INTO '.$this->tabela.' (';
                  foreach($variaveis as $key => $item){
                    if($key==='item' || $key==='parcela'){
                       foreach($item as $item2){
                          $texto .= '`'.$item2.'`,'; 
                       }
                    }else{
                        $texto .= '`'.$item.'`,';
                    }
                  }
            $padrao=$this->padrao();
            $x='1';
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '`'.$pad.'`';
                    if(count($padrao)>$x){
                        $texto .= ',';
                    }
                }
                $x++;
            }
                $texto .= ') VALUES (';
                  foreach($variaveis as $key => $item){
                    if($key==='item' || $key==='parcela'){
                       foreach($item as $item2){
                            $texto .= ':'.$item2.',';
                       }
                    }else{
                        $texto .= ':'.$item.',';
                    }
                  }
            $padrao=$this->padrao();
            $x='1';
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= ':'.$pad;
                    if(count($padrao)>$x){
                        $texto .= ',';
                    }
                }
                $x++;
            }
            $texto .=  ')\';';
            $texto .= '$search = new PedidoSearchCriteria();'.
                '$search->settabela($pedido->gettabela());'.
                'return $this->execute6($sql, $pedido);'.
                '}';
            $texto .= ' public function update6(pedido $pedido){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '$pedido->setmodificado($now);'.
                '$sql = \'UPDATE '.$this->tabela.' SET id=:id,criado=:criado';
                   $x=1;
                    foreach($variaveis as $key => $item){
                        if($key==='item' || $key==='parcela'){
                            foreach($item as $item2){
                                $texto .= " $item2 = :$item2";
                                if(count($variaveis)>$x){
                                    $texto .= ',';
                                }
                            }
                        }else{
                            if($item != 'criado'){
                                $texto .= " $item = :$item";
                                if(count($variaveis)>$x){
                                    $texto .= ',';
                                }
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';'.
                    'return $this->execute6($sql, $pedido);'.
           '}';
                $texto .= ' public function criaTabela6($tabela){'.
                        '$sql="CREATE TABLE IF NOT EXISTS '.$this->tabela.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis as $key => $item){
                            if($key==='item' || $key==='parcela'){
                                foreach($item as $item2){
                                    $texto .= '`'.$item2.'`';
                                    $texto .=' varchar(150) NULL,';
                                }
                            }else{
                                $texto .= '`'.$item.'`';
                                $texto .=' varchar(150) NULL,';
                            }
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";'.
                'return $sql;'.
                '}';
            $texto .=' public function getParams6(pedido $pedido){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$pedido->get'.$pad.'(),';
                }
            }
                foreach($variaveis as $key => $item){
                    if($key==='item' || $key==='parcela'){
                        foreach($item as $item2){
                            $classe='get'.$item2;
                            $texto .='\':'.$item2.'\'=>$pedido->'.$classe.'(),';
                        }
                    }else{
                        $classe='get'.$item;
                        $texto .='\':'.$item.'\'=>$pedido->'.$classe.'(),';
                    }
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';
                $texto .= '}';    
                
            return $texto;
        }
    }
?>