<?php 
 class CRUD extends dao{
   public function insert(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
                $model->setid(null);
                $model->setexcluido(0);
                $model->setcriado($now);  
                $sql=$this->criaTabela('tb_cliente');
                $this->execute($sql, $model);
                $sql = 'INSERT INTO tb_cliente (`cod_API`,`bairro`,`cep`,`cidade`,`cidade_ibge`,`cnae`,`cnpj_cpf`,`codigo_cliente_integracao`,`codigo_cliente_omie`,`codigo_pais`,`complemento`,`email`,`endereco`,`endereco_numero`,`estado`,`exterior`,`inscricao_estadual`,`inscricao_municipal`,`nome_fantasia`,`pessoa_fisica`,`razao_social`,`telefone1_ddd`,`telefone1_numero`,`tipo_atividade`,`id`,`excluido`,`criado`) VALUES (:cod_API,:bairro,:cep,:cidade,:cidade_ibge,:cnae,:cnpj_cpf,:codigo_cliente_integracao,:codigo_cliente_omie,:codigo_pais,:complemento,:email,:endereco,:endereco_numero,:estado,:exterior,:inscricao_estadual,:inscricao_municipal,:nome_fantasia,:pessoa_fisica,:razao_social,:telefone1_ddd,:telefone1_numero,:tipo_atividade,:id,:excluido,:criado)';
	$search = new ModelSearchCriteria();
                $search->settabela($model->gettabela());
                return $this->execute($sql, $model);
                }
   public function update(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $model->setmodificado($now);
                $sql = 'UPDATE tb_cliente SET id=:id,criado=:criado,modificado=:modificado, cod_API = :cod_API, bairro = :bairro, cep = :cep, cidade = :cidade, cidade_ibge = :cidade_ibge, cnae = :cnae, cnpj_cpf = :cnpj_cpf, codigo_cliente_integracao = :codigo_cliente_integracao, codigo_cliente_omie = :codigo_cliente_omie, codigo_pais = :codigo_pais, complemento = :complemento, email = :email, endereco = :endereco, endereco_numero = :endereco_numero, estado = :estado, exterior = :exterior, inscricao_estadual = :inscricao_estadual, inscricao_municipal = :inscricao_municipal, nome_fantasia = :nome_fantasia, pessoa_fisica = :pessoa_fisica, razao_social = :razao_social, telefone1_ddd = :telefone1_ddd, telefone1_numero = :telefone1_numero, tipo_atividade = :tipo_atividade WHERE id = :id ';
                    return $this->execute($sql, $model);
           }
    public function criaTabela($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS tb_cliente ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`cod_API` INT (5) NULL,`bairro` varchar(100) NULL,`cep` varchar(100) NULL,`cidade` varchar(100) NULL,`cidade_ibge` varchar(100) NULL,`cnae` varchar(100) NULL,`cnpj_cpf` varchar(100) NULL,`codigo_cliente_integracao` varchar(100) NULL,`codigo_cliente_omie` varchar(100) NULL,`codigo_pais` varchar(100) NULL,`complemento` varchar(100) NULL,`email` varchar(100) NULL,`endereco` varchar(100) NULL,`endereco_numero` varchar(100) NULL,`estado` varchar(100) NULL,`exterior` varchar(100) NULL,`inscricao_estadual` varchar(100) NULL,`inscricao_municipal` varchar(100) NULL,`nome_fantasia` varchar(100) NULL,`pessoa_fisica` varchar(100) NULL,`razao_social` varchar(100) NULL,`telefone1_ddd` varchar(100) NULL,`telefone1_numero` varchar(100) NULL,`tipo_atividade` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams(Model $model){
        $params = array(':id'=>$model->getid(),':excluido'=>$model->getexcluido(),':criado'=>$model->getcriado(),':cod_API'=>$model->getcod_API(),':bairro'=>$model->getbairro(),':cep'=>$model->getcep(),':cidade'=>$model->getcidade(),':cidade_ibge'=>$model->getcidade_ibge(),':cnae'=>$model->getcnae(),':cnpj_cpf'=>$model->getcnpj_cpf(),':codigo_cliente_integracao'=>$model->getcodigo_cliente_integracao(),':codigo_cliente_omie'=>$model->getcodigo_cliente_omie(),':codigo_pais'=>$model->getcodigo_pais(),':complemento'=>$model->getcomplemento(),':email'=>$model->getemail(),':endereco'=>$model->getendereco(),':endereco_numero'=>$model->getendereco_numero(),':estado'=>$model->getestado(),':exterior'=>$model->getexterior(),':inscricao_estadual'=>$model->getinscricao_estadual(),':inscricao_municipal'=>$model->getinscricao_municipal(),':nome_fantasia'=>$model->getnome_fantasia(),':pessoa_fisica'=>$model->getpessoa_fisica(),':razao_social'=>$model->getrazao_social(),':telefone1_ddd'=>$model->gettelefone1_ddd(),':telefone1_numero'=>$model->gettelefone1_numero(),':tipo_atividade'=>$model->gettipo_atividade(), );
	 return $params;
   }
}