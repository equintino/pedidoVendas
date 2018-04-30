<?php
    class criaClsses2 {
        public $POST;
        public $tabela;
        public $tabela2='tb_preco';
        private $filename1='../model/modelProduto.php';        
        private $filename2='../mapping/ProdutoMapper.php';
        private $filename3='../dao/ProdutoSearchCriteria.php';
        private $filename4='../dao/CRUDProduto.php';
        public function novoArquivo($campos){
            $mode='w+';
            $variaveis=array('loja','videos','modificado','pOriginal','pTabela','nTabela');
            foreach($campos as $item){
                $variaveis[] = $item;
            }
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
            $texto="<?php class modelProduto{";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .=" private $"."$pad; ";
                $texto .=" public function get".$pad."(){".
                        'return $this->'."$pad; }".
                        " public function set$pad(".'$'."$pad){".
                        '$this->'.$pad.'=$'."$pad; }"; 
            }
            foreach($variaveis as $item){
              $texto .=' private $'.$item.';';
              $texto .=  ' public function get'.$item."(){".
                   'return $this->'.$item.";"." }".
                   ' public function set'.$item.'($'.$item." ){".
                   '$this->'.$item.'=$'.$item."; }";     
            }
            $texto .=' }'; 
            return $texto;
        }
        private function texto2($variaveis){
            $texto="<?php class ProdutoMapper{";
            $texto .= '  public static function map(modelProduto $modelProduto, array $properties){';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .='if (array_key_exists(\''.$pad.'\', $properties)){'.
                        '  $modelProduto->set'.$pad.'($properties[\''.$pad.'\']);'.
                        '}';
            }
            foreach($variaveis as $item){
                $texto .='if (array_key_exists(\''.$item.'\', $properties)){'.
                        '  $modelProduto->set'.$item.'($properties[\''.$item.'\']);'.
                        '}';
            }
            $texto .= '  } }'; 
            return $texto;
        }
        private function texto3($variaveis){
            $texto="<?php class ProdutoSearchCriteria{";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
              $texto .= ' private $'.$pad.';'.
               'public function get'.$pad.'(){'.
                'return $this->'.$pad.';'.
              ' }'.
              'public function set'.$pad.'($'.$pad.'){'.
                  '$this->'.$pad.'=$'.$pad.';'.
                  'return $this;'.
              '}';
            }
            foreach($variaveis as $item){
              $texto .= ' private $'.$item.';'.
               'public function get'.$item.'(){'.
                'return $this->'.$item.';'.
              '}'.
              'public function set'.$item.'($'.$item.'){'.
                  '$this->'.$item.' = $'.$item.';'.
                  'return $this;'.
              '}';
            }
            $texto .= '}';
            return $texto;
        }
        private function texto4($variaveis){
            $variaveis=array_diff($variaveis,['pOriginal','pTabela','nTabela']);
            $variaveis2=array('modificado','codigo','pOriginal','pTabela','nTabela');
            $texto="<?php class CRUDProduto extends Dao{";
            $texto .= ' public function insert(modelProduto $modelProduto){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$modelProduto->setid(null);'.
                '$modelProduto->setexcluido(0);'.
                '$modelProduto->setcriado($now);'.
                '$sql=$this->criaTabela(\''.$this->tabela.'\');'.
                '$this->execute2($sql, $modelProduto);'.
                '$sql = \'INSERT INTO '.$this->tabela.' (';
                  foreach($variaveis as $item){
                    $texto .= '`'.$item.'`,';
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
                  foreach($variaveis as $item){
                    $texto .= ':'.$item.',';
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
            $texto .= '$search = new ProdutoSearchCriteria();'.
                '$search->settabela($modelProduto->gettabela());'.
                'return $this->execute2($sql, $modelProduto);'.
                '}';
            $texto .= ' public function update(modelProduto $modelProduto){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '$modelProduto->setmodificado($now);'.
                '$sql = \'UPDATE '.$this->tabela.' SET id=:id,criado=:criado,modificado=:modificado,';
                   $x=1;
                    foreach($variaveis as $item){
                        if($item != 'criado'){
                            $texto .= " $item = :$item";
                            if(count($variaveis)>$x){
                                $texto .= ',';
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';'.
                    'return $this->execute2($sql, $modelProduto);'.
           '}';
                $texto .= ' public function criaTabela($tabela){'.
                        '$sql="CREATE TABLE IF NOT EXISTS '.$this->tabela.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis as $item){
                            $texto .= '`'.$item.'`';
                            if($item=='cod_API'){
                                $texto .=' INT (5) NULL,';
                            }else{
                                $texto .=' varchar(100) NULL,';
                            }
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";'.
                'return $sql;'.
                '}';
                        
                $texto .= ' public function insert4(modelProduto $modelProduto){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$modelProduto->setid(null);'.
                '$modelProduto->setexcluido(0);'.
                '$modelProduto->setcriado($now);'.
                '$sql=$this->criaTabela4(\''.$this->tabela2.'\');'.
                '$this->execute4($sql, $modelProduto);'.
                '$sql = \'INSERT INTO '.$this->tabela2.' (';
                  foreach($variaveis2 as $item){
                    $texto .= '`'.$item.'`,';
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
                  foreach($variaveis2 as $item){
                    $texto .= ':'.$item.',';
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
            $texto .= '$search = new ProdutoSearchCriteria();'.
                '$search->settabela($modelProduto->gettabela());'.
                'return $this->execute4($sql, $modelProduto);'.
                '}';
            $texto .= ' public function update4(modelProduto $modelProduto){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '/*$modelProduto->setmodificado($now);*/'.
                '$sql = \'UPDATE '.$this->tabela2.' SET id=:id,criado=:criado,modificado=:modificado,';
                   $x=1;
                    foreach($variaveis2 as $item){
                        if($item != 'criado'){
                            $texto .= " $item = :$item";
                            if(count($variaveis)>$x){
                                $texto .= ',';
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';'.
                    'return $this->execute4($sql, $modelProduto);'.
           '}';
                        
                $texto .= ' public function criaTabela4($tabela){'.
                        '$sql="CREATE TABLE IF NOT EXISTS '.$this->tabela2.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis2 as $item){
                            $texto .= '`'.$item.'`';
                            if($item=='cod_API'){
                                $texto .=' INT (5) NULL,';
                            }elseif($item=='codigo'){
                                $texto .=' varchar(100) NOT NULL,';
                            }else{
                                $texto .=' varchar(100) NULL,';
                            }
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";'.
                'return $sql;'.
                '}';        
                        
            $texto .=' public function getParams(modelProduto $modelProduto){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$modelProduto->get'.$pad.'(),';
                }
            }
                foreach($variaveis as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$modelProduto->'.$classe.'(),';
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';
                
            $texto .=' public function getParams4(modelProduto $modelProduto){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$modelProduto->get'.$pad.'(),';
                }
            }
                foreach($variaveis2 as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$modelProduto->'.$classe.'(),';
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';
                        
                $texto .= '}';
            return $texto;
        }
    }
?>