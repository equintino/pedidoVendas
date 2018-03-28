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
            if($item != 'tipoBusca'){
                $row = $this->query('SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND tags like "%'.$item.'%"')->fetchAll();
                foreach($row as $item){
                    $model = new Model();
                    modelMapper::map($model, $item);
                    $result[$model->getid()] = $model;
                }
            }
        }
        return $result;       
   }
   public function totalLinhas(ModelSearchCriteria $search=null){
           $row = $this->query("SELECT id FROM `".$search->gettabela()."` WHERE `excluido` =  '0' ORDER BY id DESC ")->fetch();
        if (!$row) {
            return null;
        }
        return $row;
   }
   public function totalLinhas2(ProdutoSearchCriteria $search=null){
        $row = $this->query("SELECT id FROM `".$search->gettabela()."` WHERE `excluido` =  '0' ORDER BY id DESC ")->fetch();
        if (!$row) {
            return null;
        }
        return $row;
   }
   public function grava(Model $model){
        set_time_limit(3600);
        if ($model->getid() === null) {
            return $this->insert($model);
        }
        return $this->update($model);
   }
   public function grava2(modelProduto $modelProduto){
        //echo '<pre>';print_r($modelProduto);
        set_time_limit(3600);
        if ($modelProduto->getid() === null) {
            return $this->insert($modelProduto);
        }
        return $this->update($modelProduto);
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
   public function showTabela($tabela){
        $sql = 'SHOW TABLES';
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC)->fetchAll();
        foreach($statement as $key => $item){
            if($item['Tables_in_pedidovendas']==$tabela){
                return 1;
            }
        }
        return null;
   }
   public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
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
            //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $model;
   }
   public function execute2($sql,modelProduto $modelProduto){
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($modelProduto));
        $search=new ModelSearchCriteria();        
        $search->settabela($modelProduto->gettabela());
        if (!$modelProduto->getid()) {
            //return $this->encontrePorId($search->setid($this->getDb()->lastInsertId()));
        }
        return $modelProduto;
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
        // TODO log error, send email, etc.);
        throw new Excecao('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
   }
   private function getEncontreSql(ModelSearchCriteria $search = null) {        
       if(preg_match('/[0-9]/',$search->getrazao_social())){
           //echo 'contem número';
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND cnpj_cpf like "%'.$search->getrazao_social().'%"';
       }elseif(!preg_match('/[0-9]/',$search->getrazao_social())){
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND razao_social like "%'.$search->getrazao_social().'%"';
           //echo 'não contém número';
       }else{
            $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ';
       }
        return $sql;
  }
   private function getEncontreSql2(ProdutoSearchCriteria $search = null){
       $codigo=str_replace(' ','%',$search->getcodigo());
       if(preg_match('/[0-9]/',$codigo)){
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND codigo like "%'.$codigo.'%"';
       }elseif(!preg_match('/[0-9]/',$codigo)){
           $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" AND descricao like "%'.$codigo.'%"';
       }else{
            $sql = 'SELECT * FROM `'.$search->gettabela().'` WHERE excluido = "0" ';
       }
        return $sql;
  }
}