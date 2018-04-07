<?php
/**
 * Modelo class representando um item USER.
 */
final class User {
    /** @var int */
    private $id;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $loja;
    private $funcao;
    private $OMIE_APP_KEY;
    private $OMIE_APP_SECRET;
    private $empresa;
    private $cnpj;

    public function __construct() {
        $this->setDeleted(false);
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login = $login;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setLoja($loja){
        $this->loja = $loja;
    }
    public function getloja(){
        return $this->loja;
    }
    public function setFuncao($funcao){
        $this->funcao = $funcao;
    }
    public function getFuncao(){
        return $this->funcao;
    }
    public function setOMIE_APP_KEY($OMIE_APP_KEY){
        $this->OMIE_APP_KEY = $OMIE_APP_KEY;
    }
    public function getOMIE_APP_KEY(){
        return $this->OMIE_APP_KEY;
    }
    public function setOMIE_APP_SECRET($OMIE_APP_SECRET){
        $this->OMIE_APP_SECRET = $OMIE_APP_SECRET;
    }
    public function getOMIE_APP_SECRET(){
        return $this->OMIE_APP_SECRET;
    }
    public function setempresa($empresa){
        $this->empresa = $empresa;
    }
    public function getempresa(){
        return $this->empresa;
    }
    public function setcnpj($cnpj){
        $this->cnpj = $cnpj;
    }
    public function getcnpj(){
        return $this->cnpj;
    }
    public function getDeleted() {
        return $this->deleted;
    }
    public function setDeleted($deleted) {
        $this->deleted = (bool) $deleted;
    }
}
?>