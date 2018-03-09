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
                $sql = 'INSERT INTO tb_cliente (`cod_API`,`codigo_cliente_integracao`,`razao_social`,`nome_fantasia`,`cnpj_cpf`,`telefone1_ddd`,`telefone1_numero`,`email`,`contato`,`endereco`,`endereco_numero`,`bairro`,`complemento`,`estado`,`cidade`,`cep`,`telefone2_ddd`,`telefone2_numero`,`fax_ddd`,`fax_numero`,`homepage`,`inscricao_estadual`,`inscricao_municipal`,`inscricao_suframa`,`produtor_rural`,`contribuinte`,`observacao`,`recomendacao_atraso`,`id`,`excluido`,`criado`,`cidade_ibge`,`codigo_cliente_omie`,`codigo_pais`,`exterior`,`pessoa_fisica`,`tipo_atividade`) VALUES (:cod_API,:codigo_cliente_integracao,:razao_social,:nome_fantasia,:cnpj_cpf,:telefone1_ddd,:telefone1_numero,:email,:contato,:endereco,:endereco_numero,:bairro,:complemento,:estado,:cidade,:cep,:telefone2_ddd,:telefone2_numero,:fax_ddd,:fax_numero,:homepage,:inscricao_estadual,:inscricao_municipal,:inscricao_suframa,:produtor_rural,:contribuinte,:observacao,:recomendacao_atraso,:id,:excluido,:criado,:cidade_ibge,:cnae,:codigo_cliente_omie,:codigo_pais,:exterior,:pessoa_fisica,:tipo_atividade)';
	$search = new ModelSearchCriteria();
                $search->settabela($model->gettabela());
                return $this->execute($sql, $model);
                }
   public function update(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $model->setmodificado($now);
                $sql = 'UPDATE tb_cliente SET id=:id,criado=:criado,modificado=:modificado, cod_API = :cod_API, codigo_cliente_integracao = :codigo_cliente_integracao, razao_social = :razao_social, nome_fantasia = :nome_fantasia, cnpj_cpf = :cnpj_cpf, telefone1_ddd = :telefone1_ddd, telefone1_numero = :telefone1_numero, email = :email, contato = :contato, endereco = :endereco, endereco_numero = :endereco_numero, bairro = :bairro, complemento = :complemento, estado = :estado, cidade = :cidade, cep = :cep, telefone2_ddd = :telefone2_ddd, telefone2_numero = :telefone2_numero, fax_ddd = :fax_ddd, fax_numero = :fax_numero, homepage = :homepage, inscricao_estadual = :inscricao_estadual, inscricao_municipal = :inscricao_municipal, inscricao_suframa = :inscricao_suframa, produtor_rural = :produtor_rural, contribuinte = :contribuinte, observacao = :observacao, recomendacao_atraso = :recomendacao_atraso, cidade_ibge = :cidade_ibge, cnae = :cnae, codigo_cliente_omie = :codigo_cliente_omie, codigo_pais = :codigo_pais, exterior = :exterior, pessoa_fisica = :pessoa_fisica, tipo_atividade = :tipo_atividade WHERE id = :id ';
                    return $this->execute($sql, $model);
           }
    public function criaTabela($tabela=null){
                        $sql="CREATE TABLE IF NOT EXISTS `tb_cliente` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`cod_API` INT (5) NULL,`codigo_cliente_integracao` varchar(100) NULL,`razao_social` varchar(100) NULL,`nome_fantasia` varchar(100) NULL,`cnpj_cpf` varchar(100) NULL,`telefone1_ddd` varchar(100) NULL,`telefone1_numero` varchar(100) NULL,`email` varchar(100) NULL,`contato` varchar(100) NULL,`endereco` varchar(100) NULL,`endereco_numero` varchar(100) NULL,`bairro` varchar(100) NULL,`complemento` varchar(100) NULL,`estado` varchar(100) NULL,`cidade` varchar(100) NULL,`cep` varchar(100) NULL,`telefone2_ddd` varchar(100) NULL,`telefone2_numero` varchar(100) NULL,`fax_ddd` varchar(100) NULL,`fax_numero` varchar(100) NULL,`homepage` varchar(100) NULL,`inscricao_estadual` varchar(100) NULL,`inscricao_municipal` varchar(100) NULL,`inscricao_suframa` varchar(100) NULL,`produtor_rural` varchar(100) NULL,`contribuinte` varchar(100) NULL,`observacao` varchar(100) NULL,`recomendacao_atraso` varchar(100) NULL,`cidade_ibge` varchar(100) NULL,`cnae` varchar(100) NULL,`codigo_cliente_omie` varchar(100) NULL,`codigo_pais` varchar(100) NULL, `exterior` varchar(100) NULL, `pessoa_fisica` varchar(100) NULL, `tipo_atividade` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams(Model $model){
        $params = array(':id'=>$model->getid(),':excluido'=>$model->getexcluido(),':criado'=>$model->getcriado(),':cod_API'=>$model->getcod_API(),':codigo_cliente_integracao'=>$model->getcodigo_cliente_integracao(),':razao_social'=>$model->getrazao_social(),':nome_fantasia'=>$model->getnome_fantasia(),':cnpj_cpf'=>$model->getcnpj_cpf(),':telefone1_ddd'=>$model->gettelefone1_ddd(),':telefone1_numero'=>$model->gettelefone1_numero(),':email'=>$model->getemail(),':contato'=>$model->getcontato(),':endereco'=>$model->getendereco(),':endereco_numero'=>$model->getendereco_numero(),':bairro'=>$model->getbairro(),':complemento'=>$model->getcomplemento(),':estado'=>$model->getestado(),':cidade'=>$model->getcidade(),':cep'=>$model->getcep(),':telefone2_ddd'=>$model->gettelefone2_ddd(),':telefone2_numero'=>$model->gettelefone2_numero(),':fax_ddd'=>$model->getfax_ddd(),':fax_numero'=>$model->getfax_numero(),':homepage'=>$model->gethomepage(),':inscricao_estadual'=>$model->getinscricao_estadual(),':inscricao_municipal'=>$model->getinscricao_municipal(),':inscricao_suframa'=>$model->getinscricao_suframa(),':produtor_rural'=>$model->getprodutor_rural(),':contribuinte'=>$model->getcontribuinte(),':observacao'=>$model->getobservacao(),':recomendacao_atraso'=>$model->getrecomendacao_atraso(),':cidade_ibge'=>$model->getcidade_ibge(),':cnae'=>$model->getcnae(),':codigo_cliente_omie'=>$model->getcodigo_cliente_omie(),':codigo_pais'=>$model->getcodigo_pais(),':exterior'=>$model->getexterior(),':pessoa_fisica'=>$model->getpessoa_fisica(),':tipo_atividade'=>$model->gettipo_atividade() );
	 return $params;
   }
}