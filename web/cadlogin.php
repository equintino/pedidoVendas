<meta charset="UTF-8">
<?php
    include '../validacao/valida_cookies.php';
    
    $nome=$_POST['nome'];
    $login=$_POST['login'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    $setor=$_POST['setor'];
    $funcao=$_POST['funcao'];
    
    $criptografia = new valida_cookies(); 
    $dao = new UserDao();
    $user = new User();

    $senha=($criptografia->criptografia($senha));
    
    $user->setNome($nome);
    $user->setLogin($login);
    $user->setSenha($senha);
    $user->setemail($email);
    $user->setSetor($setor);
    $user->setFuncao($funcao);
    
    $dao->save($user);
    
    $string="Location: ../index.html";
    header($string);
?>

