<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php 
//include_once 'web/backup.php';
include 'validacao/valida_cookies.php';
$acesso = new valida_cookies();
$file = fopen('config/OmieAppAuth.php','w+');
$escreve = fwrite($file, '<?php define("OMIE_APP_KEY","'.$_POST['login'].'"); define("OMIE_APP_SECRET","'.$_POST['senha'].'");');
fclose($file);
        
@$acesso->setLogin($_POST['login']);
@$acesso->setSenha($_POST['senha']);
if (!$acesso->getLogin()){
    $acesso->popup('Você deve entrar com o usuário.',null);
}else{
    $acesso->loginDb(); 
}
?>
</body>
</html>