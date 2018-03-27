<?php
    class criaClsses2 {
        public $POST;
        public $tabela;
        private $filename1='../model/modelProduto.php';        
        private $filename2='../mapping/ProdutoMapper.php';
        private $filename3='../dao/ProdutoSearchCriteria.php';
        private $filename4='../dao/CRUDProduto.php';
        public function novoArquivo($campos){
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
            $texto="<?php \r\n class modelProduto{\r\n";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .="\t private $"."$pad; \r\n";
                $texto .="\t public function get".$pad."(){\r\n".
                        "\t\t ".'return $this->'."$pad; \r\n \t}\r\n".
                        "\t public function set$pad(".'$'."$pad){\r\n".
                        "\t\t".'$this->'.$pad.'=$'."$pad;\r\n \t}\r\n"; 
            }
            foreach($variaveis as $item){
              $texto .=' private $'.$item.';'."\r\n";
              $texto .=  ' public function get'.$item."(){\r\n".
                   "\t".'return $this->'.$item.";\r\n"." }\r\n".
                   ' public function set'.$item.'($'.$item." ){\r\n".
                   "\t".'$this->'.$item.'=$'.$item.";\r\n }\r\n";     
            }
            $texto .=' }'; 
            return $texto;
        }
        private function texto2($variaveis){
            $texto="<?php \r\n class ProdutoMapper{\r\n";
            $texto .= '  public static function map(modelProduto $modelProduto, array $properties){'."\r\n";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .="\t".'if (array_key_exists(\''.$pad.'\', $properties)){'."\r\n".
                        "\t".'  $modelProduto->set'.$pad.'($properties[\''.$pad.'\']);'."\r\n".
                        "\t".'}'."\r\n";                
            }
            foreach($variaveis as $item){
                $texto .="\t".'if (array_key_exists(\''.$item.'\', $properties)){'."\r\n".
                        "\t".'  $modelProduto->set'.$item.'($properties[\''.$item.'\']);'."\r\n".
                        "\t".'}'."\r\n";
            }
            $texto .= '  }'." \r\n }"; 
            return $texto;
        }
        private function texto3($variaveis){
            $texto="<?php \r\n class ProdutoSearchCriteria{\r\n";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
              $texto .= '   private $'.$pad.';
               public function get'.$pad.'(){
                return $this->'.$pad.';
              }
              public function set'.$pad.'($'.$pad.'){
                  $this->'.$pad.'=$'.$pad.';
                  return $this;
              }'."\r\n";
            }
            foreach($variaveis as $item){
              $texto .= '   private $'.$item.';
               public function get'.$item.'(){
                return $this->'.$item.';
              }
              public function set'.$item.'($'.$item.'){
                  $this->'.$item.' = $'.$item.';
                  return $this;
              }'."\r\n";
            }
            $texto .= '}';
            return $texto;
        }
        private function texto4($variaveis){
            $texto="<?php \r\n class CRUDProduto extends Dao{\r\n";
            $texto .= '   public function insert(modelProduto $modelProduto){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));
                $modelProduto->setid(null);
                $modelProduto->setexcluido(0);
                $modelProduto->setcriado($now);  
                $sql=$this->criaTabela(\''.$this->tabela.'\');
                $this->execute2($sql, $modelProduto);   
                //$this->execute2(\'ALTER TABLE `tb_cliente` ADD UNIQUE(`cnpj_cpf`)\', $modelProduto);
                $sql = \'INSERT INTO '.$this->tabela.' (';
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
            $texto .=  ')\';'."\r\n";
            $texto .= "\t".'$search = new ProdutoSearchCriteria();
                $search->settabela($modelProduto->gettabela());
                return $this->execute2($sql, $modelProduto);
                }'."\r\n";
            $texto .= '   public function update(modelProduto $modelProduto){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $modelProduto->setmodificado($now);
                $sql = \'UPDATE '.$this->tabela.' SET id=:id,criado=:criado,modificado=:modificado,';
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
                $texto .= ' WHERE id = :id \';
                    return $this->execute2($sql, $modelProduto);
           }'."\r\n";
                $texto .= '    public function criaTabela($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS '.$this->tabela.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variaveis as $item){
                            $texto .= '`'.$item.'`';
                            if($item=='cod_API'){
                                $texto .=' INT (5) NULL,';
                            /*}elseif($item=='entrada'||$item=='saida'){
                                $texto .=' DATETIME DEFAULT NULL,';
                            }elseif($item=='descricao'){
                                $texto .=' TEXT NULL,';*/
                            }else{
                                $texto .=' varchar(100) NULL,';
                            }
                        }
                        $texto .=' `excluido` ENUM(\'0\',\'1\') NOT NULL DEFAULT \'0\', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }'."\r\n";
            $texto .='  public function getParams(modelProduto $modelProduto){
        $params = array(';
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
                $texto .=' );
	 return $params;
   }'."\r\n";
                        
                $texto .= '}';
            return $texto;
        }
    }
?>