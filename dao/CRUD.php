<?php 
 class CRUD extends Dao{
   public function insert(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
                $model->setid(null);
                $model->setexcluido(0);
                $model->setcriado($now);  
                $sql=$this->criaTabela('tb_cliente');
                $this->execute($sql, $model);   
                //$this->execute('ALTER TABLE `tb_cliente` ADD UNIQUE(`cnpj_cpf`)', $model);
                $sql = 'INSERT INTO tb_cliente (`modificado`,`inscricao_suframa`,`produtor_rural`,`recomendacao_atraso`,`logradouro`,`importado_api`,`bloqueado`,`codInt`,`comissao`,`fatura_pedido`,`visualiza_pedido`,`nome`,`inativo`,`codigo`,`bairro`,`cep`,`cidade`,`cidade_ibge`,`cnae`,`cnpj_cpf`,`codigo_cliente_integracao`,`codigo_cliente_omie`,`codigo_pais`,`complemento`,`email`,`endereco`,`endereco_numero`,`estado`,`exterior`,`cImpAPI`,`dAlt`,`dInc`,`hAlt`,`hInc`,`uAlt`,`uInc`,`info`,`inscricao_estadual`,`inscricao_municipal`,`nome_fantasia`,`pessoa_fisica`,`razao_social`,`tags`,`telefone1_ddd`,`telefone1_numero`,`tipo_atividade`,`cod_API`,`contato`,`optante_simples_nacional`,`telefone2_ddd`,`telefone2_numero`,`fax_ddd`,`fax_numero`,`homepage`,`observacao`,`contribuinte`,`id`,`excluido`,`criado`) VALUES (:modificado,:inscricao_suframa,:produtor_rural,:recomendacao_atraso,:logradouro,:importado_api,:bloqueado,:codInt,:comissao,:fatura_pedido,:visualiza_pedido,:nome,:inativo,:codigo,:bairro,:cep,:cidade,:cidade_ibge,:cnae,:cnpj_cpf,:codigo_cliente_integracao,:codigo_cliente_omie,:codigo_pais,:complemento,:email,:endereco,:endereco_numero,:estado,:exterior,:cImpAPI,:dAlt,:dInc,:hAlt,:hInc,:uAlt,:uInc,:info,:inscricao_estadual,:inscricao_municipal,:nome_fantasia,:pessoa_fisica,:razao_social,:tags,:telefone1_ddd,:telefone1_numero,:tipo_atividade,:cod_API,:contato,:optante_simples_nacional,:telefone2_ddd,:telefone2_numero,:fax_ddd,:fax_numero,:homepage,:observacao,:contribuinte,:id,:excluido,:criado)';
	$search = new ModelSearchCriteria();
                $search->settabela($model->gettabela());
                return $this->execute($sql, $model);
                }
   public function update(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $model->setmodificado($now);
                $sql = 'UPDATE tb_cliente SET id=:id,criado=:criado,modificado=:modificado, modificado = :modificado, inscricao_suframa = :inscricao_suframa, produtor_rural = :produtor_rural, recomendacao_atraso = :recomendacao_atraso, logradouro = :logradouro, importado_api = :importado_api, bloqueado = :bloqueado, codInt = :codInt, comissao = :comissao, fatura_pedido = :fatura_pedido, visualiza_pedido = :visualiza_pedido, nome = :nome, inativo = :inativo, codigo = :codigo, bairro = :bairro, cep = :cep, cidade = :cidade, cidade_ibge = :cidade_ibge, cnae = :cnae, cnpj_cpf = :cnpj_cpf, codigo_cliente_integracao = :codigo_cliente_integracao, codigo_cliente_omie = :codigo_cliente_omie, codigo_pais = :codigo_pais, complemento = :complemento, email = :email, endereco = :endereco, endereco_numero = :endereco_numero, estado = :estado, exterior = :exterior, cImpAPI = :cImpAPI, dAlt = :dAlt, dInc = :dInc, hAlt = :hAlt, hInc = :hInc, uAlt = :uAlt, uInc = :uInc, info = :info, inscricao_estadual = :inscricao_estadual, inscricao_municipal = :inscricao_municipal, nome_fantasia = :nome_fantasia, pessoa_fisica = :pessoa_fisica, razao_social = :razao_social, tags = :tags, telefone1_ddd = :telefone1_ddd, telefone1_numero = :telefone1_numero, tipo_atividade = :tipo_atividade, cod_API = :cod_API, contato = :contato, optante_simples_nacional = :optante_simples_nacional, telefone2_ddd = :telefone2_ddd, telefone2_numero = :telefone2_numero, fax_ddd = :fax_ddd, fax_numero = :fax_numero, homepage = :homepage, observacao = :observacao, contribuinte = :contribuinte WHERE id = :id ';
                    return $this->execute($sql, $model);
           }
    public function criaTabela($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS tb_cliente ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`modificado` varchar(100) NULL,`inscricao_suframa` varchar(100) NULL,`produtor_rural` varchar(100) NULL,`recomendacao_atraso` varchar(100) NULL,`logradouro` varchar(100) NULL,`importado_api` varchar(100) NULL,`bloqueado` varchar(100) NULL,`codInt` varchar(100) NULL,`comissao` varchar(100) NULL,`fatura_pedido` varchar(100) NULL,`visualiza_pedido` varchar(100) NULL,`nome` varchar(100) NULL,`inativo` varchar(100) NULL,`codigo` varchar(100) NULL,`bairro` varchar(100) NULL,`cep` varchar(100) NULL,`cidade` varchar(100) NULL,`cidade_ibge` varchar(100) NULL,`cnae` varchar(100) NULL,`cnpj_cpf` varchar(100) NULL,`codigo_cliente_integracao` varchar(100) NULL,`codigo_cliente_omie` varchar(100) NULL,`codigo_pais` varchar(100) NULL,`complemento` varchar(100) NULL,`email` varchar(100) NULL,`endereco` varchar(100) NULL,`endereco_numero` varchar(100) NULL,`estado` varchar(100) NULL,`exterior` varchar(100) NULL,`cImpAPI` varchar(100) NULL,`dAlt` varchar(100) NULL,`dInc` varchar(100) NULL,`hAlt` varchar(100) NULL,`hInc` varchar(100) NULL,`uAlt` varchar(100) NULL,`uInc` varchar(100) NULL,`info` varchar(100) NULL,`inscricao_estadual` varchar(100) NULL,`inscricao_municipal` varchar(100) NULL,`nome_fantasia` varchar(100) NULL,`pessoa_fisica` varchar(100) NULL,`razao_social` varchar(100) NULL,`tags` varchar(100) NULL,`telefone1_ddd` varchar(100) NULL,`telefone1_numero` varchar(100) NULL,`tipo_atividade` varchar(100) NULL,`cod_API` INT (5) NULL,`contato` varchar(100) NULL,`optante_simples_nacional` varchar(100) NULL,`telefone2_ddd` varchar(100) NULL,`telefone2_numero` varchar(100) NULL,`fax_ddd` varchar(100) NULL,`fax_numero` varchar(100) NULL,`homepage` varchar(100) NULL,`observacao` varchar(100) NULL,`contribuinte` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams(Model $model){
        $params = array(':id'=>$model->getid(),':excluido'=>$model->getexcluido(),':criado'=>$model->getcriado(),':modificado'=>$model->getmodificado(),':inscricao_suframa'=>$model->getinscricao_suframa(),':produtor_rural'=>$model->getprodutor_rural(),':recomendacao_atraso'=>$model->getrecomendacao_atraso(),':logradouro'=>$model->getlogradouro(),':importado_api'=>$model->getimportado_api(),':bloqueado'=>$model->getbloqueado(),':codInt'=>$model->getcodInt(),':comissao'=>$model->getcomissao(),':fatura_pedido'=>$model->getfatura_pedido(),':visualiza_pedido'=>$model->getvisualiza_pedido(),':nome'=>$model->getnome(),':inativo'=>$model->getinativo(),':codigo'=>$model->getcodigo(),':bairro'=>$model->getbairro(),':cep'=>$model->getcep(),':cidade'=>$model->getcidade(),':cidade_ibge'=>$model->getcidade_ibge(),':cnae'=>$model->getcnae(),':cnpj_cpf'=>$model->getcnpj_cpf(),':codigo_cliente_integracao'=>$model->getcodigo_cliente_integracao(),':codigo_cliente_omie'=>$model->getcodigo_cliente_omie(),':codigo_pais'=>$model->getcodigo_pais(),':complemento'=>$model->getcomplemento(),':email'=>$model->getemail(),':endereco'=>$model->getendereco(),':endereco_numero'=>$model->getendereco_numero(),':estado'=>$model->getestado(),':exterior'=>$model->getexterior(),':cImpAPI'=>$model->getcImpAPI(),':dAlt'=>$model->getdAlt(),':dInc'=>$model->getdInc(),':hAlt'=>$model->gethAlt(),':hInc'=>$model->gethInc(),':uAlt'=>$model->getuAlt(),':uInc'=>$model->getuInc(),':info'=>$model->getinfo(),':inscricao_estadual'=>$model->getinscricao_estadual(),':inscricao_municipal'=>$model->getinscricao_municipal(),':nome_fantasia'=>$model->getnome_fantasia(),':pessoa_fisica'=>$model->getpessoa_fisica(),':razao_social'=>$model->getrazao_social(),':tags'=>$model->gettags(),':telefone1_ddd'=>$model->gettelefone1_ddd(),':telefone1_numero'=>$model->gettelefone1_numero(),':tipo_atividade'=>$model->gettipo_atividade(),':cod_API'=>$model->getcod_API(),':contato'=>$model->getcontato(),':optante_simples_nacional'=>$model->getoptante_simples_nacional(),':telefone2_ddd'=>$model->gettelefone2_ddd(),':telefone2_numero'=>$model->gettelefone2_numero(),':fax_ddd'=>$model->getfax_ddd(),':fax_numero'=>$model->getfax_numero(),':homepage'=>$model->gethomepage(),':observacao'=>$model->getobservacao(),':contribuinte'=>$model->getcontribuinte(), );
	 return $params;
   }
   public function insert3(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
                $model->setid(null);
                $model->setexcluido(0);
                $model->setcriado($now);  
                $sql=$this->criaTabela3('tb_vendedor');
                $this->execute3($sql, $model);
                $sql = 'INSERT INTO tb_vendedor (`codigo`,`codInt`,`nome`,`inativo`,`comissao`,`email`,`fatura_pedido`,`visualiza_pedido`,`id`,`excluido`,`criado`) VALUES (:codigo,:codInt,:nome,:inativo,:comissao,:email,:fatura_pedido,:visualiza_pedido,:id,:excluido,:criado)';
	$search = new ModelSearchCriteria();
                $search->settabela($model->gettabela());
                return $this->execute3($sql, $model);
                }
   public function update3(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $model->setmodificado($now);
                $sql = 'UPDATE tb_vendedor SET id=:id,criado=:criado,modificado=:modificado, codigo = :codigo, codInt = :codInt, nome = :nome, inativo = :inativo, comissao = :comissao, email = :email, fatura_pedido = :fatura_pedido, visualiza_pedido = :visualiza_pedido WHERE id = :id ';
                    return $this->execute3($sql, $model);
           }
    public function criaTabela3($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS tb_vendedor ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`codigo` varchar(100) NULL,`codInt` varchar(100) NULL,`nome` varchar(100) NULL,`inativo` varchar(100) NULL,`comissao` varchar(100) NULL,`email` varchar(100) NULL,`fatura_pedido` varchar(100) NULL,`visualiza_pedido` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams3(Model $model){
        $params = array(':id'=>$model->getid(),':excluido'=>$model->getexcluido(),':criado'=>$model->getcriado(),':codigo'=>$model->getcodigo(),':codInt'=>$model->getcodInt(),':nome'=>$model->getnome(),':inativo'=>$model->getinativo(),':comissao'=>$model->getcomissao(),':email'=>$model->getemail(),':fatura_pedido'=>$model->getfatura_pedido(),':visualiza_pedido'=>$model->getvisualiza_pedido(), );
	 return $params;
   }
}