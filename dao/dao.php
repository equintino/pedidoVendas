<?php 
 class dao {
   private $db = null;
   public function __destruct(){
      $this->db = null;
   }
   public function encontre(ModelSearchCriteria $search = null){
            set_time_limit(3600);
            ini_set('memory_limit', '-1');
        $result = array();
        foreach ($this->query($this->getEncontreSql($search)) as $row){
            $model = new Model();
            modelMapper::map($model, $row);
            $result[$model->getid()] = $model;
        }
        return $result;
   }
   public function encontre2(ProdutoSearchCriteria $search = null){
            set_time_limit(3600);
            ini_set('memory_limit', '-1');
        $result = array();
        foreach ($this->query($this->getEncontreSql2($search)) as $row){
            $modelProduto = new modelProduto();
            ProdutoMapper::map($modelProduto, $row);
            $result[$modelProduto->getid()] = $modelProduto;
        }
        return $result;
   }
   public function encontrePorId(ModelSearchCriteria $search=null){
        if($search->getid() != null){
           $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" and id = ' . (int) $search->getid())->fetch();
        }else{ 
           $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0"')->fetchAll();
        }
        if (!$row) {
            return null;
        }
        $model = new Model();
        modelMapper::map($model, $row);
        return $model;
   }
   public function encontrePorTag(ModelSearchCriteria $search=null){
        $result = array();
        foreach($search->gettags() as $item){
            if($item != 'tipoBusca' && !$search->getnome_fantasia()){
                $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND tags like "%'.$item.'%"')->fetchAll();
            }elseif($search->getnome_fantasia()){
                $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND tags like "%'.$item.'%" AND nome_fantasia like "%'.$search->getnome_fantasia().'%" OR razao_social like "%'.$search->getnome_fantasia().'%" OR cnpj_cpf like "%'.$search->getnome_fantasia().'%"')->fetchAll();
            }
            if(@$row){
                foreach($row as $item){
                    $model = new Model();
                    modelMapper::map($model, $item);
                    $result[$model->getid()] = $model;
                }
            }
        }
        return $result;       
   }
   public function encontrePorLoja(ProdutoSearchCriteria $search=null){
        $result = array();
        if(!$search->getcodigo()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND `loja` like "%'.$search->getloja().'%"')->fetchAll();
        }else{
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND `loja` like "%'.$search->getloja().'%" AND codigo like "%'.$search->getcodigo().'%"')->fetchAll();
        }
        foreach($row as $item){
            $modelProduto = new modelProduto();
            ProdutoMapper::map($modelProduto, $item);
            $result[$modelProduto->getid()] = $modelProduto;
        }
        return $result;
   }
   public function encontrePorVendedor(ModelSearchCriteria $search=null){
        $result = array();
        $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ')->fetchAll();
        foreach($row as $item){
            $model = new Model();
            modelMapper::map($model, $item);
            $result[$model->getid()] = $model;
        }
        return $result;
   }
   public function encontrePorConta(ContaSearchCriteria $search=null){
        $result = array();
        $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND OMIE_APP_KEY = "'.$search->getOMIE_APP_KEY().'"')->fetchAll();
        foreach($row as $item){
            $conta = new conta();
            contaMapper::map($conta, $item);
            $result[$conta->getid()] = $conta;
        }
        return $result;
   }
   public function encontrePorPedido(PedidoSearchCriteria $search=null,$order=null){
        $row = $this->query('SHOW COLUMNS FROM tb_pedido')->fetchAll();
        foreach($row as $item){
            if($item['Field']=='codigo_pedido'){
                $coluna=1;
            }
        }
        if(!isset($coluna)){
            $sql = 'ALTER TABLE `tb_pedido` ADD `codigo_pedido` VARCHAR(100) NULL';
            $this->getDb()->prepare($sql)->execute();
        }
        if(!isset($order)){
            $order='DESC';
        }
        $result = array();
        if($search->getid()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND id = "'.$search->getid().'"')->fetchAll();
        }elseif($search->getcodigo_pedido_integracao()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo_pedido_integracao ='.$search->getcodigo_pedido_integracao().'')->fetchAll();
        }elseif($search->getpedido()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND pedido ='.$search->getpedido().'')->fetchAll();
        }elseif($search->getdSemana()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND dSemana ='.$search->getdSemana().'')->fetchAll();
        }else{
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo_pedido IS NOT null ORDER BY id '.$order)->fetchAll();
            //$row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND pedido IS NULL ORDER BY id DESC')->fetchAll();
        }
        foreach($row as $item){
            $pedido = new pedido();
            pedidoMapper::map($pedido, $item);
            $result[] = $pedido;
        }
        return $result;
   }
   public function encontrePorNota(NotaSearchCriteria $search=null){
        $result = array();
        if($search->getnIdPedido()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND nIdPedido = "'.$search->getnIdPedido().'"')->fetchAll();
        }elseif($search->getnIdNF()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND nIdNF = "'.$search->getnIdNF().'"')->fetchAll();
        }else{
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND nNF = "'.$search->getnNF().'"')->fetchAll();
        }
        foreach($row as $item){
            $nota = new nota();
            notaMapper::map($nota, $item);
            $result[$nota->getid()] = $nota;
        }
        return $result;
   }
   public function encontrePorStatus(StatusSearchCriteria $search=null){
        $result = array();
        if($search->getnumero_nfe('busca')){
            $row = $this->query("SELECT * FROM `tb_status` where `numero_nfe` is null");
        }elseif($search->getnumero_pedido()){
            $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND numero_pedido = "'.$search->getnumero_pedido().'"')->fetchAll();
        }else{
            //$row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ')->fetchAll();
            $row = $this->query("SELECT tb_pedido.id,tb_pedido.codigo_pedido,tb_status.codigo_pedido_integracao,numero_pedido,tb_status.etapa,valor_total_pedido,chave_nfe,danfe,data_emissao,status_nfe,dPrevisao,tb_pedido.dSemana,fPagamento,vendedor,numero_nfe FROM `tb_pedido` LEFT JOIN `tb_status` ON tb_pedido.codigo_pedido = tb_status.codigo_pedido AND 'tb_status.excluido' = 0 AND 'tb_pedido.codigo_pedido' IS NOT null");
        }
        foreach($row as $item){
            $status = new status();
            statusMapper::map($status, $item);
            $result[$status->getnumero_pedido()] = $status;
        }
        return $result;
   }
   public function totalLinhas(ModelSearchCriteria $search=null){
           $row = $this->query("SELECT id FROM `".$search->gettabela()."` WHERE `excluido` =  '0' ORDER BY id DESC ")->fetchAll();
        if (!$row) {
            return null;
        }
        return count($row);
   }
   public function totalLinhas2(ProdutoSearchCriteria $search=null){
        $row = $this->query("SELECT id FROM `".$search->gettabela()."` WHERE `excluido` =  '0' ORDER BY id DESC ")->fetchAll();
        if (!$row) {
            return null;
        }
        return count($row);
   }
   public function grava(Model $model){
        set_time_limit(3600);
        if ($model->getid() === null) {
            return $this->insert($model);
        }
        return $this->update($model);
   }
   public function grava2(modelProduto $modelProduto){
        set_time_limit(3600);
        if ($modelProduto->getid() === null) {
            return $this->insert($modelProduto);
        }
        return $this->update($modelProduto);
   }
   public function grava3(Model $model){
        set_time_limit(3600);
        if ($model->getid() === null) {
            return $this->insert3($model);
        }
        return $this->update3($model);
   }
   public function grava4(modelProduto $modelProduto){
        set_time_limit(3600);
        if ($modelProduto->getid() === null) {
            return $this->insert4($modelProduto);
        }
        return $this->update4($modelProduto);
   }
   public function grava5(conta $conta){
        set_time_limit(3600);
        if ($conta->getid() === null) {
            return $this->insert5($conta);
        }
        return $this->update5($conta);
   }
   public function grava6(pedido $pedido){
       if($pedido->getid() === null){
           return $this->insert6($pedido);
       }
       return $this->update6($pedido);
   }
   public function grava7(nota $nota){
       if($nota->getid() === null){
           return $this->insert7($nota);
       }
       return $this->update7($nota);
   }
   public function grava8(status $status){
       if($status->getid() === null){
           return $this->insert8($status);
       }
       return $this->update8($status);
   }
   public function gravaNumeroPedido($pedido){
       date_default_timezone_set("Brazil/East");
       $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
       $pedido->setmodificado($now);
       if($pedido->getcodigo_pedido()){
            $row = $this->query('SHOW COLUMNS FROM tb_pedido')->fetchAll();
            foreach($row as $item){
                if($item['Field']=='codigo_pedido'){
                    $coluna='existe';
                }
            }
            if(!isset($coluna)){
                $sql = 'ALTER TABLE `tb_pedido` ADD `codigo_pedido` VARCHAR(100) NULL';
                $this->getDb()->prepare($sql)->execute();
            }
            $sql = 'UPDATE `tb_pedido` SET pedido = '.$pedido->getpedido().', modificado = '.$pedido->getmodificado().',codigo_pedido = '.$pedido->getcodigo_pedido().', codigo_pedido_integracao = '.$pedido->getcodigo_pedido_integracao().' WHERE pedido = '.$pedido->getpedido().'';
       }else{
            $sql = 'UPDATE `tb_pedido` SET pedido = '.$pedido->getpedido().', modificado = '.$pedido->getmodificado().' WHERE codigo_pedido_integracao = '.$pedido->getcodigo_pedido_integracao().'';
       }
       $statement = $this->getDb()->prepare($sql)->execute();
       return $statement;
   }
   public function exclui($id) {
        $sql = 'delete from `'.$model->gettabela().'` WHERE id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(':id' => $id
        ));
        return $statement->rowCount() == 1;
   }
   public function drop($tabela){
        $sql = 'DROP TABLE `'.$tabela.'`';
        $statement = $this->getDb()->prepare($sql)->execute();
   }
   public function showTabela($tabela,$db=null){
        $sql = 'SHOW TABLES';
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC)->fetchAll();
        if(!$db){
            $db='db';
        }
        $config = Config::getConfig($db);
        $banco=strstr(substr(strstr($config['dsn'],'dbname=',false),'7'),';',true);
        foreach($statement as $key => $item){
            if(array_key_exists('Tables_in_'.$banco.'',$item)){
                if($item['Tables_in_'.$banco.'']==$tabela){
                    return 1;
                }
            }
        }
        return null;
   }
   public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        if(OMIE_APP_KEY=='2769656370'){
            $config = Config::getConfig("db");
        }elseif(OMIE_APP_KEY=='461893204773'){
           $config = Config::getConfig("db2");
        }else{
           $config = Config::getConfig("db3");            
        }
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));  
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
   }
   public function execute($sql,Model $model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($model));
        $search=new ModelSearchCriteria();        
        $search->settabela($model->gettabela());
        if (!$model->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $model;
   }
   public function execute2($sql,modelProduto $modelProduto){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($modelProduto));
        $search=new ModelSearchCriteria();        
        $search->settabela($modelProduto->gettabela());
        if (!$modelProduto->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $modelProduto;
   }
   public function execute3($sql,Model $model){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams3($model));
        $search=new ModelSearchCriteria();        
        $search->settabela($model->gettabela());
        if (!$model->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $model;
   }
   public function execute4($sql,modelProduto $modelProduto){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams4($modelProduto));
        $search=new ModelSearchCriteria();        
        $search->settabela($modelProduto->gettabela());
        if (!$modelProduto->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $modelProduto;
   }
   public function execute5($sql,conta $conta){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams5($conta));
        $search=new ContaSearchCriteria();        
        $search->settabela($conta->gettabela());
        if (!$conta->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $conta;
   }
   public function execute6($sql,pedido $pedido){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams6($pedido));
        $search=new PedidoSearchCriteria();        
        $search->settabela($pedido->gettabela());
        if (!$pedido->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $pedido;
   }
   public function execute7($sql,nota $nota){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams7($nota));
        $search=new NotaSearchCriteria();        
        $search->settabela($nota->gettabela());
        if (!$nota->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $nota;
   }
   public function execute8($sql,status $status){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams8($status));
        $search=new StatusSearchCriteria();        
        $search->settabela($status->gettabela());
        if (!$status->getid()) {
            /*return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));*/
        }
        return $status;
   }
   private function executeStatement(PDOStatement $statement, array $params){
        if (!$statement->execute($params)){
            self::throwDbError($this->getDb()->errorInfo());
        }
   }
   public function query($sql){
        set_time_limit(3600);
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
   }
   private static function throwDbError(array $errorInfo){
        /* TODO log error, send email, etc.);*/
        throw new Excecao('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
   }
   private function getEncontreSql(ModelSearchCriteria $search = null) {       
       if(preg_match('/[0-9]/',$search->getnome_fantasia())){
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND cnpj_cpf like "%'.$search->getnome_fantasia().'%"';
       }elseif(!preg_match('/[0-9]/',$search->getnome_fantasia()) || $search->getnome_fantasia()){
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND nome_fantasia like "%'.$search->getnome_fantasia().'%" OR razao_social like "%'.$search->getnome_fantasia().'%"';
       }else{
            $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ';
       }
        return $sql;
  }
    private function getEncontreSql2(ProdutoSearchCriteria $search = null){
        if($search->gettabela()=='tb_preco'){
            if($search->getid()){
                $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND id = "'.$search->getid().'"';
            }else{
                $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo = "'.$search->getcodigo().'"';
            }
            return $sql;
        }
        $codigo=str_replace(' ','%',$search->getcodigo());
        if($search->getcodigo_produto()){
            if($search->getloja()){
                $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo_produto = "'.$search->getcodigo_produto().'" AND loja like "%'.$search->getloja().'%" OR descricao like "%'.$search->getcodigo_produto().'%"';
                return $sql;
            }
            $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo_produto = "'.$search->getcodigo_produto().'" OR descricao like "%'.$search->getcodigo_produto().'%"';
        }elseif($codigo){
            if($search->getloja()){
                $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" AND loja like "%'.$search->getloja().'%" AND (codigo like "%'.$codigo.'%" OR descricao like "%'.$codigo.'%")';
                return $sql;
            }
            $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" AND (codigo like "%'.$codigo.'%" OR descricao like "%'.$codigo.'%")';
        }else{
            if($search->getloja()){
                $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" AND loja like "%'.$search->getloja().'%" ';
                return $sql;
            }
            $sql = 'SELECT `id`,`descricao`,`codigo`,`codigo_produto`,`valor_unitario`,`quantidade_estoque`,`cfop`,`ncm`,`ean`,`unidade` FROM `'.$search->gettabela().'` WHERE excluido = "0" ';
        }
        return $sql;
    }
}