<?php
    class criaClsses {
        public $POST;
        public $tabela;
        public $tabela3='tb_vendedor';
        private $filename1='../model/model.php';        
        private $filename2='../mapping/modelMapper.php';
        private $filename3='../dao/ModelSearchCriteria.php';
        private $filename4='../dao/CRUD.php';
        public function novoArquivo($campos){
            $variaveis=array('modificado','inscricao_suframa','produtor_rural','recomendacao_atraso','logradouro','importado_api','bloqueado','codInt','comissao','fatura_pedido','visualiza_pedido','nome','inativo','codigo');
            $mode='w+';
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
            $texto="<?php class Model{ ";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .=" private $"."$pad; ";
                $texto .=" public function get".$pad."(){".
                        'return $this->'."$pad; }".
                        " public function set$pad(".'$'."$pad){".
                        '$this->'.$pad.'=$'."$pad;}"; 
            }
            foreach($variaveis as $item){
              $texto .=' private $'.$item.';';
              $texto .=  ' public function get'.$item."(){".
                   'return $this->'.$item."; }".
                   ' public function set'.$item.'($'.$item." ){".
                   '$this->'.$item.'=$'.$item."; }";     
            }
            $texto .=' }'; 
            return $texto;
        }
        private function texto2($variaveis){
            $texto="<?php class modelMapper{";
            $texto .= '  public static function map(Model $model, array $properties){';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .='if (array_key_exists(\''.$pad.'\', $properties)){'.
                        '  $model->set'.$pad.'($properties[\''.$pad.'\']);'.
                        '}';                
            }
            foreach($variaveis as $item){
                $texto .='if (array_key_exists(\''.$item.'\', $properties)){'.
                        '  $model->set'.$item.'($properties[\''.$item.'\']);'.
                        '}';
            }
            $texto .= '  } }'; 
            return $texto;
        }
        private function texto3($variaveis){
            $texto="<?php class ModelSearchCriteria{";
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
            $variaveis3=array('codigo','codInt','nome','inativo','comissao','email','fatura_pedido','visualiza_pedido');
            $texto="<?php class CRUD extends Dao{";
            $texto .= ' public function insert(Model $model){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$model->setid(null);'.
                '$model->setexcluido(0);'.
                '$model->setcriado($now);'.
                '$sql=$this->criaTabela(\''.$this->tabela.'\');'.
                '$this->execute($sql, $model);'.
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
            $texto .= '$search = new ModelSearchCriteria();'.
                '$search->settabela($model->gettabela());'.
                'return $this->execute($sql, $model);'.
                '}';
            $texto .= ' public function update(Model $model){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '$model->setmodificado($now);'.
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
                    'return $this->execute($sql, $model);'.
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
            $texto .=' public function getParams(Model $model){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$model->get'.$pad.'(),';
                }
            }
                foreach($variaveis as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$model->'.$classe.'(),';
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';
            $texto .= ' public function insert3(Model $model){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$model->setid(null);'.
                '$model->setexcluido(0);'.
                '$model->setcriado($now);'.
                '$sql=$this->criaTabela3(\''.$this->tabela3.'\');'.
                '$this->execute3($sql, $model);'.
                '$sql = \'INSERT INTO '.$this->tabela3.' (';
                  foreach($variaveis3 as $item){
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
                  foreach($variaveis3 as $item){
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
            $texto .= '$search = new ModelSearchCriteria();'.
                '$search->settabela($model->gettabela());'.
                'return $this->execute3($sql, $model);'.
                '}';
            $texto .= ' public function update3(Model $model){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '$model->setmodificado($now);'.
                '$sql = \'UPDATE '.$this->tabela3.' SET id=:id,criado=:criado,modificado=:modificado,';
                   $x=1;
                    foreach($variaveis3 as $item){
                        if($item != 'criado'){
                            $texto .= " $item = :$item";
                            if(count($variaveis3)>$x){
                                $texto .= ',';
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';'.
                    'return $this->execute3($sql, $model);'.
           '}';
                $texto .= ' public function criaTabela3($tabela){'.
                        '$sql="CREATE TABLE IF NOT EXISTS '.$this->tabela3.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis3 as $item){
                            $texto .= '`'.$item.'`';
                            $texto .=' varchar(100) NULL,';
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";'.
                'return $sql;'.
                '}'."\r\n";
            $texto .=' public function getParams3(Model $model){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$model->get'.$pad.'(),';
                }
            }
                foreach($variaveis3 as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$model->'.$classe.'(),';
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';      
                $texto .= '}';    
                
            return $texto;
        }
    }
?>