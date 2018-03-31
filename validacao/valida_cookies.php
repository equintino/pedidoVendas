<html>
    <head>
        <?php
            /*if($_GET['pagina']=='atualizando'){
                function redirecionar($tempo,$url, $mensagem){
                    header("Refresh: $tempo; url=$url"); 
                }
                redirecionar('5','../web/index.php?pagina=cliente&act=atualiza&seleciona=1','mensagem a mostrar');        
            }*/
        ?>
    </head>
    <body bgcolor=#4cb1f1>
<?php
    $teste='teste';
    $userdao='dao/UserDao.php';
    $userserachcriteria='dao/UserSearchCriteria.php';
    $config='config/Config.php';
    $user='model/User.php';
    $mapping='mapping/UserMapper.php';
    $diretorios=array($userdao,$userserachcriteria,$config,$user,$mapping);
    foreach($diretorios as $diretorio){
        if(!file_exists($diretorio)){
            $diretorio='../'.$diretorio;
        }
        include $diretorio;
    }
class valida_cookies{
    public $login;
    public $senha;
    public $setor;
    public $index;
    private $OMIE_APP_KEY;
    private $OMIE_APP_SECRET;
    
    function __construct(){
    }
    public function setLogin($login){
            $this->login = $this->maiusculo($login);
    }
    public function getLogin(){
        return $this->login;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSetor($setor){
        $this->setor = $setor;
    }
    public function getSetor(){
        return $this->setor;
    }
    public function setIndex($index){
        $this->index = $index;
    }
    public function getIndex(){
        return $this->index;
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
    public static function limpaCookies(){
	//@setcookie("login"," ", time() + (86400 * 30),"/");
	//@setcookie("senha"," ", time() + (86400 * 30),"/");
        echo '<script>document.cookie="login=;path=/";document.cookie="senha=;path=/";</script>';
    }
    public function semLogin(){
        $this->popup('Você deve entrar com o usuário.','semlogin');
    }
    public function fazerLogin(){
        if(!trim($this->login)){
	echo "<table width=100% height=80% border=0>";
	echo "<tr height=100%>";
	echo "<td width=100% colspan=3 valign=center align=center>";
	echo "<table border=1 bgcolor=#FFFFFF CELLSPACING=3 CELLPADDING=13><tr><td>";
	echo "<center><br><b><font face=tahoma size=2 color=black>Efetuar o login para obter acesso.<p>";
	echo "<center><input type=button autofocus value=\"Entrar\" onclick=\"location.href='../index.html' \">";
	echo "</td></tr></table>";
	echo "</table>";
	echo "</td></tr></table>";
	echo "</html></body>";
	exit;
        }
    }
    public function loginDb(){
        $dao = new UserDao();
        $search = new UserSearchCriteria();
        $search->setLogin($this->login);
        $user = $dao->find($search);
        $senha = self::criptografia($_COOKIE['senha']);
        foreach($user as $key => $item){
            define('OMIE_APP_KEY',$item->getOMIE_APP_KEY());
            define('OMIE_APP_SECRET',$item->getOMIE_APP_SECRET());
            
            $senhaDb = @$item->getSenha();
            $file = fopen('config/OmieAppAuth.php','w+');
            $escreve = fwrite($file, '<?php define("OMIE_APP_KEY","'.OMIE_APP_KEY.'"); define("OMIE_APP_SECRET","'.OMIE_APP_SECRET.'");');
            fclose($file);
            if($senhaDb== $senha){
                $this->popup("Bem-Vindo ".$this->getlogin().".",'sim');
                //exit;
            }else{
                $this->popup('A senha não confere.',null);
                exit;
            }
        }
            
        if(!$user){  
            $this->popup('Usuário não cadastrado.','cad'); 
        }
    }
    public function criptografia($senha){
        $cripto1 = md5($senha);
        $cripto2 = sha1($cripto1);
        
        return $cripto2;
    }
    public function maiusculo($string){
	$string=strtoupper($string);
	$string=str_replace("б", "Б", $string);
	$string=str_replace("й", "Й", $string);
	$string=str_replace("н", "�?", $string);
	$string=str_replace("у", "У", $string);
	$string=str_replace("ъ", "Ъ", $string);
	$string=str_replace("в", "В", $string);
	$string=str_replace("к", "К", $string);
	$string=str_replace("ф", "Ф", $string);
	$string=str_replace("О", "I", $string);
	$string=str_replace("Ы", "U", $string);
	$string=str_replace("г", "Г", $string);
	$string=str_replace("х", "Х", $string);
	$string=str_replace("з", "З", $string);
	$string=str_replace("а", "A", $string);
	return $string;
    }
    public function popup($msg,$ok=null){
       echo "<form action='web/index.php?index=sim' method=POST>";
        echo "<table width=100% height=80% border=0>";
        echo "<tr height=100%>";
        echo "<td width=100% colspan=3 valign=center align=center>";
        echo "<table border=1 bgcolor=#FFFFFF CELLSPACING=3 CELLPADDING=13><tr><td>";
        echo "<center><br><b><font face=tahoma size=2 color=black>$msg<p>";
            if(!$ok && $ok!='semlogin'){
                echo "<center><input autofocus type=button value=\"Voltar\" onclick=history.back()>";
            }elseif($ok=='cad'){
                echo "<center><input type=button value=\"Cadastrar\" onclick=\"location.href='web/cadlogin.html'\">";
                echo '<br>';
                echo "<center><input type=button value='  Cancelar  ' onclick=history.back()>";
            }else{
                echo '<script>window.location.assign("web/index.php?index=sim&pagina=pedido&act=cad")</script>';
                //header('Location:web/index.php?index=sim&pagina=pedido&act=cad');
                //echo "<center><input autofocus type=button value=\"Entrar\" onclick=\"location.href='web/index.php?index=sim&pagina=pedido&act=cad'\">";
            }
        echo "</td></tr></table>";
        echo "</td></tr>";
        echo "</table>";
        echo "</td></tr></table>";
        echo "</form>";
        echo "</body></html>";
        exit;
    }
}
?>
    </body>
</html>