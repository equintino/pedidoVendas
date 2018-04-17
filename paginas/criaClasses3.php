<?php
    class criaClsses3 {
        public $tabela='tb_conta';
        private $filename1='../model/conta.php';        
        private $filename2='../mapping/contaMapper.php';
        private $filename3='../dao/ContaSearchCriteria.php';
        private $filename4='../dao/CRUDConta.php';
        public function novoArquivo(){
            $variavelConta=array('bol_instr1','bol_sn','cobr_sn','codigo_agencia','codigo_banco','data_alt','data_inc','descricao','dias_rcomp','hora_alt','hora_inc','nCodCC','nao_fluxo','nao_resumo','numero_conta_corrente','pdv_cod_adm','pdv_dias_venc','pdv_enviar','pdv_limite_pacelas','pdv_num_parcelas','pdv_sincr_analitica','pdv_taxa_adm','pdv_taxa_loja','pdv_tipo_tef','per_juros','per_multa','saldo_inicial','tipo','tipo_conta_corrente','user_alt','user_inc','valor_limite','OMIE_APP_KEY');
            $mode='w+';
            /*foreach($campos as $item){
                $variavelConta[] = $item;
            }*/
            $handle = fopen($this->filename1, $mode); 
            $texto=$this->texto1($variavelConta);
            fwrite($handle, $texto); 
            fclose($handle); 
            $handle = fopen($this->filename2, $mode); 
            $texto=$this->texto2($variavelConta);
            fwrite($handle, $texto); 
            fclose($handle);
            $handle = fopen($this->filename3, $mode); 
            $texto=$this->texto3($variavelConta);
            fwrite($handle, $texto); 
            fclose($handle);
            $handle = fopen($this->filename4, $mode); 
            $texto=$this->texto4($variavelConta);
            fwrite($handle, $texto); 
            fclose($handle);
            
            return $variavelConta;
        }
        private function padrao(){
            $padrao=array('id','tabela','excluido','criado');
            return $padrao;
        }
        private function texto1($variavelConta){         
            $texto="<?php \r\n class conta{\r\n";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                $texto .="\t private $"."$pad; \r\n";
                $texto .="\t public function get".$pad."(){\r\n".
                        "\t\t ".'return $this->'."$pad; \r\n \t}\r\n".
                        "\t public function set$pad(".'$'."$pad){\r\n".
                        "\t\t".'$this->'.$pad.'=$'."$pad;\r\n \t}\r\n"; 
            }
            foreach($variavelConta as $item){
              $texto .=' private $'.$item.';'."\r\n";
              $texto .=  ' public function get'.$item."(){\r\n".
                   "\t".'return $this->'.$item.";\r\n"." }\r\n".
                   ' public function set'.$item.'($'.$item." ){\r\n".
                   "\t".'$this->'.$item.'=$'.$item.";\r\n }\r\n";     
            }
            $texto .=' }'; 
            return $texto;
        }
        private function texto2($variavelConta){
            $texto="<?php \r\n class contaMapper{\r\n";
            $texto .= '  public static function map(conta $conta, array $properties){'."\r\n";
            $padrao=$this->padrao();
            foreach($padrao as $pad){
            $texto .="\t".'if (array_key_exists(\''.$pad.'\', $properties)){'."\r\n".
                        "\t".'  $conta->set'.$pad.'($properties[\''.$pad.'\']);'."\r\n".
                        "\t".'}'."\r\n";                
            }
            foreach($variavelConta as $item){
                $texto .="\t".'if (array_key_exists(\''.$item.'\', $properties)){'."\r\n".
                        "\t".'  $conta->set'.$item.'($properties[\''.$item.'\']);'."\r\n".
                        "\t".'}'."\r\n";
            }
            $texto .= '  }'." \r\n }"; 
            return $texto;
        }
        private function texto3($variavelConta){
            $texto="<?php \r\n class ContaSearchCriteria{\r\n";
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
            foreach($variavelConta as $item){
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
        private function texto4($variavelConta){
            //$variaveis3=array('codigo','codInt','nome','inativo','comissao','email','fatura_pedido','visualiza_pedido');
            $texto="<?php \r\n class CRUDConta extends Dao{\r\n";
            $texto .= '   public function insert5(conta $conta){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date(\'H\'), date(\'i\'), date(\'s\'), date("m")  , date("d"), date("Y"));
                $conta->setid(null);
                $conta->setexcluido(0);
                $conta->setcriado($now);  
                $sql=$this->criaTabela5(\''.$this->tabela.'\');
                $this->execute5($sql, $conta);  
                $this->execute5(\'ALTER TABLE `tb_conta` ADD UNIQUE(`nCodCC`)\', $conta);
                $sql = \'INSERT INTO '.$this->tabela.' (';
                  foreach($variavelConta as $item){
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
                  foreach($variavelConta as $item){
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
            $texto .= "\t".'$search = new ContaSearchCriteria();
                $search->settabela($conta->gettabela());
                return $this->execute5($sql, $conta);
                }'."\r\n";
            $texto .= '   public function update5(conta $conta){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $conta->setmodificado($now);
                $sql = \'UPDATE '.$this->tabela.' SET id=:id,criado=:criado,modificado=:modificado,';
                   $x=1;
                    foreach($variavelConta as $item){
                        if($item != 'criado'){
                            $texto .= " $item = :$item";
                            if(count($variavelConta)>$x){
                                $texto .= ',';
                            }
                        }
                        $x++;
                    }
                $texto .= ' WHERE id = :id \';
                    return $this->execute5($sql, $conta);
           }'."\r\n";
                $texto .= '    public function criaTabela5($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS '.$this->tabela.' ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,';
                        foreach($variavelConta as $item){
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
            $texto .='  public function getParams5(conta $conta){
        $params = array(';
            $padrao=$this->padrao();
            foreach($padrao as $pad){
                if($pad!='tabela'){
                    $texto .= '\':'.$pad.'\'=>$conta->get'.$pad.'(),';
                }
            }
                foreach($variavelConta as $key => $item){
                    $classe='get'.$item;
                    $texto .='\':'.$item.'\'=>$conta->'.$classe.'(),';
                }    
                $texto .=' );
	 return $params;
   }'."\r\n";
                $texto .= '}';    
                
            return $texto;
        }
    }
?>