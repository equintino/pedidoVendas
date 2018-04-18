<?php 
 class CRUDConta extends Dao{
   public function insert5(conta $conta){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
                $conta->setid(null);
                $conta->setexcluido(0);
                $conta->setcriado($now);  
                $sql=$this->criaTabela5('tb_conta');
                $this->execute5($sql, $conta);  
                $this->execute5('ALTER TABLE `tb_conta` ADD UNIQUE(`nCodCC`)', $conta);
                $sql = 'INSERT INTO tb_conta (`bol_instr1`,`bol_sn`,`cobr_sn`,`codigo_agencia`,`codigo_banco`,`data_alt`,`data_inc`,`descricao`,`dias_rcomp`,`hora_alt`,`hora_inc`,`nCodCC`,`nao_fluxo`,`nao_resumo`,`numero_conta_corrente`,`pdv_categoria`,`pdv_cod_adm`,`pdv_dias_venc`,`pdv_enviar`,`pdv_limite_pacelas`,`pdv_num_parcelas`,`pdv_sincr_analitica`,`pdv_taxa_adm`,`pdv_taxa_loja`,`pdv_tipo_tef`,`per_juros`,`per_multa`,`saldo_inicial`,`tipo`,`tipo_conta_corrente`,`user_alt`,`user_inc`,`valor_limite`,`OMIE_APP_KEY`,`id`,`excluido`,`criado`) VALUES (:bol_instr1,:bol_sn,:cobr_sn,:codigo_agencia,:codigo_banco,:data_alt,:data_inc,:descricao,:dias_rcomp,:hora_alt,:hora_inc,:nCodCC,:nao_fluxo,:nao_resumo,:numero_conta_corrente,:pdv_categoria,:pdv_cod_adm,:pdv_dias_venc,:pdv_enviar,:pdv_limite_pacelas,:pdv_num_parcelas,:pdv_sincr_analitica,:pdv_taxa_adm,:pdv_taxa_loja,:pdv_tipo_tef,:per_juros,:per_multa,:saldo_inicial,:tipo,:tipo_conta_corrente,:user_alt,:user_inc,:valor_limite,:OMIE_APP_KEY,:id,:excluido,:criado)';
	$search = new ContaSearchCriteria();
                $search->settabela($conta->gettabela());
                return $this->execute5($sql, $conta);
                }
   public function update5(conta $conta){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $conta->setmodificado($now);
                $sql = 'UPDATE tb_conta SET id=:id,criado=:criado,modificado=:modificado, bol_instr1 = :bol_instr1, bol_sn = :bol_sn, cobr_sn = :cobr_sn, codigo_agencia = :codigo_agencia, codigo_banco = :codigo_banco, data_alt = :data_alt, data_inc = :data_inc, descricao = :descricao, dias_rcomp = :dias_rcomp, hora_alt = :hora_alt, hora_inc = :hora_inc, nCodCC = :nCodCC, nao_fluxo = :nao_fluxo, nao_resumo = :nao_resumo, numero_conta_corrente = :numero_conta_corrente, pdv_categoria = :pdv_categoria, pdv_cod_adm = :pdv_cod_adm, pdv_dias_venc = :pdv_dias_venc, pdv_enviar = :pdv_enviar, pdv_limite_pacelas = :pdv_limite_pacelas, pdv_num_parcelas = :pdv_num_parcelas, pdv_sincr_analitica = :pdv_sincr_analitica, pdv_taxa_adm = :pdv_taxa_adm, pdv_taxa_loja = :pdv_taxa_loja, pdv_tipo_tef = :pdv_tipo_tef, per_juros = :per_juros, per_multa = :per_multa, saldo_inicial = :saldo_inicial, tipo = :tipo, tipo_conta_corrente = :tipo_conta_corrente, user_alt = :user_alt, user_inc = :user_inc, valor_limite = :valor_limite, OMIE_APP_KEY = :OMIE_APP_KEY WHERE id = :id ';
                    return $this->execute5($sql, $conta);
           }
    public function criaTabela5($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS tb_conta ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`bol_instr1` varchar(100) NULL,`bol_sn` varchar(100) NULL,`cobr_sn` varchar(100) NULL,`codigo_agencia` varchar(100) NULL,`codigo_banco` varchar(100) NULL,`data_alt` varchar(100) NULL,`data_inc` varchar(100) NULL,`descricao` varchar(100) NULL,`dias_rcomp` varchar(100) NULL,`hora_alt` varchar(100) NULL,`hora_inc` varchar(100) NULL,`nCodCC` varchar(100) NULL,`nao_fluxo` varchar(100) NULL,`nao_resumo` varchar(100) NULL,`numero_conta_corrente` varchar(100) NULL,`pdv_categoria` varchar(100) NULL,`pdv_cod_adm` varchar(100) NULL,`pdv_dias_venc` varchar(100) NULL,`pdv_enviar` varchar(100) NULL,`pdv_limite_pacelas` varchar(100) NULL,`pdv_num_parcelas` varchar(100) NULL,`pdv_sincr_analitica` varchar(100) NULL,`pdv_taxa_adm` varchar(100) NULL,`pdv_taxa_loja` varchar(100) NULL,`pdv_tipo_tef` varchar(100) NULL,`per_juros` varchar(100) NULL,`per_multa` varchar(100) NULL,`saldo_inicial` varchar(100) NULL,`tipo` varchar(100) NULL,`tipo_conta_corrente` varchar(100) NULL,`user_alt` varchar(100) NULL,`user_inc` varchar(100) NULL,`valor_limite` varchar(100) NULL,`OMIE_APP_KEY` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams5(conta $conta){
        $params = array(':id'=>$conta->getid(),':excluido'=>$conta->getexcluido(),':criado'=>$conta->getcriado(),':bol_instr1'=>$conta->getbol_instr1(),':bol_sn'=>$conta->getbol_sn(),':cobr_sn'=>$conta->getcobr_sn(),':codigo_agencia'=>$conta->getcodigo_agencia(),':codigo_banco'=>$conta->getcodigo_banco(),':data_alt'=>$conta->getdata_alt(),':data_inc'=>$conta->getdata_inc(),':descricao'=>$conta->getdescricao(),':dias_rcomp'=>$conta->getdias_rcomp(),':hora_alt'=>$conta->gethora_alt(),':hora_inc'=>$conta->gethora_inc(),':nCodCC'=>$conta->getnCodCC(),':nao_fluxo'=>$conta->getnao_fluxo(),':nao_resumo'=>$conta->getnao_resumo(),':numero_conta_corrente'=>$conta->getnumero_conta_corrente(),':pdv_categoria'=>$conta->getpdv_categoria(),':pdv_cod_adm'=>$conta->getpdv_cod_adm(),':pdv_dias_venc'=>$conta->getpdv_dias_venc(),':pdv_enviar'=>$conta->getpdv_enviar(),':pdv_limite_pacelas'=>$conta->getpdv_limite_pacelas(),':pdv_num_parcelas'=>$conta->getpdv_num_parcelas(),':pdv_sincr_analitica'=>$conta->getpdv_sincr_analitica(),':pdv_taxa_adm'=>$conta->getpdv_taxa_adm(),':pdv_taxa_loja'=>$conta->getpdv_taxa_loja(),':pdv_tipo_tef'=>$conta->getpdv_tipo_tef(),':per_juros'=>$conta->getper_juros(),':per_multa'=>$conta->getper_multa(),':saldo_inicial'=>$conta->getsaldo_inicial(),':tipo'=>$conta->gettipo(),':tipo_conta_corrente'=>$conta->gettipo_conta_corrente(),':user_alt'=>$conta->getuser_alt(),':user_inc'=>$conta->getuser_inc(),':valor_limite'=>$conta->getvalor_limite(),':OMIE_APP_KEY'=>$conta->getOMIE_APP_KEY(), );
	 return $params;
   }
}