<?php 
 class CRUD extends dao{
   public function insert(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date('H'), date('i'), date('s'), date("m")  , date("d"), date("Y"));
                $model->setid(null);
                $model->setexcluido(0);
                $model->setcriado($now);  
                $sql=$this->criaTabela('tb_estoque');
                $this->execute($sql, $model);
                $sql = 'INSERT INTO tb_estoque (`codigo`,`nota`,`descricao`,`entrada`,`loja`,`id`,`excluido`,`criado`) VALUES (:codigo,:nota,:descricao,:entrada,:loja,:id,:excluido,:criado)';
	$search = new ModelSearchCriteria();
                $search->settabela($model->gettabela());
                return $this->execute($sql, $model);
                }
   public function update(Model $model){
                date_default_timezone_set("Brazil/East");
                $now = mktime (date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $model->setmodificado($now);
                $sql = 'UPDATE tb_estoque SET id=:id,criado=:criado,modificado=:modificado, codigo = :codigo, nota = :nota, descricao = :descricao, entrada = :entrada, loja = :loja WHERE id = :id ';
                    return $this->execute($sql, $model);
           }
    public function criaTabela($tabela){
                        $sql="CREATE TABLE IF NOT EXISTS tb_estoque ( `id` INT(5) NOT NULL AUTO_INCREMENT , `criado` INT(100) NULL,`codigo` INT (5) NULL,`nota` varchar(100) NULL,`descricao` TEXT NULL,`entrada` DATETIME DEFAULT NULL,`loja` varchar(100) NULL, `excluido` ENUM('0','1') NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
                return $sql;
                }
  public function getParams(Model $model){
        $params = array(':id'=>$model->getid(),':excluido'=>$model->getexcluido(),':criado'=>$model->getcriado(),':codigo'=>$model->getcodigo(),':nota'=>$model->getnota(),':descricao'=>$model->getdescricao(),':entrada'=>$model->getentrada(),':loja'=>$model->getloja(), );
	 return $params;
   }
}