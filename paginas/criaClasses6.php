<?php
    class criaClasses6 {
        public $tabela='tb_status';
        private $filename1='../model/modelStatus.php';        
        private $filename2='../mapping/statusMapper.php';
        private $filename3='../dao/StatusSearchCriteria.php';
        private $filename4='../dao/CRUDStatus.php';
        public function novoArquivo($variaveis){
            array_push($variaveis,"modificado","dSemana");
            $variaveis2=$variaveis;
            array_push($variaveis,"dPrevisao","fPagamento","vendedor");
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
            $texto=$this->texto4($variaveis2);
            fwrite($handle, $texto); 
            fclose($handle);
            
            return $variaveis;
        }
        private function padrao(){
            $padrao=array('id','tabela','excluido','criado');
            return $padrao;
        }
        private function texto1($variaveis){        
            $texto="<?php class status{";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .=" private $"."$pad; ";
                $texto .=" public function get".$pad."(){".
                        'return $this->'."$pad; }".
                        " public function set$pad(".'$'."$pad){".
                        '$this->'.$pad.'=$'."$pad; }"; 
            }
            foreach($variaveis as $key => $item){
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
            $texto="<?php class statusMapper{";
            $texto .= ' public static function map(status $status, array $properties){';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .='if (array_key_exists(\''.$pad.'\', $properties)){'.
                        '  $status->set'.$pad.'($properties[\''.$pad.'\']);'.
                        '}';                
            }
            foreach($variaveis as $key => $item){
                $texto .='if (array_key_exists(\''.$item.'\', $properties)){'.
                    '  $status->set'.$item.'($properties[\''.$item.'\']);'.
                    '}';
            }
            $texto .= '  }'." }";
            return $texto;
        }
        private function texto3($variaveis){
            $texto="<?php class StatusSearchCriteria{";
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
            $texto="<?php class CRUDStatus extends Dao{";
            $texto .= ' public function insert8(status $status){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));'.
                '$status->setid(null);'.
                '$status->setexcluido(0);'.
                '$status->setcriado($now);'.
                '$sql=$this->criaTabela8(\''.$this->tabela.'\');'.
                '$this->execute8($sql, $status);'.
                '$sql = \'INSERT INTO '.$this->tabela.' (';
                    foreach($variaveis as $key => $item){
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
                    foreach($variaveis as $key => $item){
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
            $texto .= '$search = new StatusSearchCriteria();'.
                '$search->settabela($status->gettabela());'.
                'return $this->execute8($sql, $status);'.
                '}';
            $texto .= ' public function update8(status $status){'.
                'date_default_timezone_set("Brazil/East");'.
                '$now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));'.
                '$status->setmodificado($now);'.
                '$sql = \'UPDATE '.$this->tabela.' SET id=:id,criado=:criado';
                   $x=1;
                    foreach($variaveis as $key => $item){
                        if($item != 'criado'){
                            $texto .= " $item = :$item";
                            if(count($variaveis)>$x){
                                $texto .= ',';
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';'.
                    'return $this->execute8($sql, $status);'.
           '}';
                $texto .= ' public function criaTabela8($tabela){'.
                        '$sql="CREATE TABLE IF NOT EXISTS '.$this->tabela.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis as $key => $item){
                            $texto .= '`'.$item.'`';
                            $texto .=' varchar(250) NULL,';
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";'.
                'return $sql;'.
                '}';
            $texto .=' public function getParams8(status $status){'.
        '$params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$status->get'.$pad.'(),';
                }
            }
                foreach($variaveis as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$status->'.$classe.'(),';
                }    
                $texto .=' );'.
	 'return $params;'.
   '}';
                $texto .= '}';    
                
            return $texto;
        }
    }
?>