<meta charset="UTF-8">
<?php
    include '../validacao/valida_cookies.php';
    $criptografia = new valida_cookies(); 
    $dao = new UserDao();
    $user = new User();
    foreach($_POST as $key => $item){
        if($key!='senha2'&&$key!='senha'){
            $classe='set'.$key;
            $user->$classe($item);
        }elseif($key=='senha'){
            $classe='set'.$key;
            $user->$classe($criptografia->criptografia($item));            
        }
    }    
    $dao->save($user);
    
    //$string="Location: ../index.html";
    //header($string);
?>
<script>window.location.assign("../index.html")</script>